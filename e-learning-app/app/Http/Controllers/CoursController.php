<?php

namespace App\Http\Controllers;

use App\category;
use App\User;
use Illuminate\Http\Request;
use App\Cour;
use App\QuizResult;
use App\Question;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourRequest;
use App\Http\Requests\StoreCourRequest;
use App\Http\Requests\UpdateCourRequest;
use Gate;
use Auth;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Controllers\Traits\MediaUploadingTrait;

class CoursController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $req)
    {
        $cours = Cour::OrderBy('id', 'desc')->paginate(12);
        $categories = category::all();
        $enseignants = User::whereHas('roles', function ($q) {$q->where('role_id', 2);})->get();


        return view('Client.cours', compact('cours','categories', 'enseignants'));
    }

    public function show(Cour $cour)
    {
        $quizzz = NULL;
       if ($cour->quiz) {
            $quizzz = QuizResult::where('quiz_id', $cour->quiz->id)
                ->where('user_id', \Auth::id())->OrderBy('id','desc')->first();
        }

        $cour->load('enseignants', 'coursChapitres', 'coursQuizzes', 'category');

        return view('Client.cour', compact('cour', 'quizzz'));
    }


    public function edit(Cour $cour){
        $cour->students()->attach(\Auth::id());
        return view('Client.cour', compact('cour'));
    }

 public function test(Request $request, $cour_id){
      $cour = Cour::where('id', $cour_id)->firstOrFail();
      $quiz_score = 0;
      $total = 0;
      foreach ($request->get('questions') as $question_id => $value) {
          $question = Question::find($question_id);
          $corr = 'correct_'.$value;
          $correct = Question::find($question_id)
                  ->where($corr, 1)->count() > 0;

          if ($correct) {
              $quiz_score += $question->score;
          }
          $total+= $question->score;
      }
        $quiz_result = QuizResult::create([
            'quiz_id' => $cour->quiz->id,
            'user_id' => \Auth::id(),
            'quiz_result' => $quiz_score,
            'total' => $total
        ]);
      return redirect()->route('cours.show', $cour->id)->with('message', 'Test score: ' . $quiz_score .'/'. $total);

  }

}

<?php

namespace App\Http\Controllers;

use App\category;
use App\Quiz;
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

class TestController extends Controller
{
    use MediaUploadingTrait;
    public function index(Request $req)
    {
        $cours = Cour::OrderBy('id', 'desc')->paginate(12);
        $categories = category::all();
        $enseignants = User::whereHas('roles', function ($q) {$q->where('role_id', 2);})->get();


        return view('Client.cours', compact('cours','categories', 'enseignants'));
    }

    public function show(Quiz $quiz)
    {
      //  $quiz->load('questions');

        return view('Client.SolutionTest', compact('quiz'));
    }

}

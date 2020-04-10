<?php

namespace App\Http\Controllers;

use App\category;
use App\CoursStudent;
use App\Http\Requests\MassDestroyCourRequest;
use App\User;
use Illuminate\Http\Request;
use App\Cour;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{

    public function index(Request $req)
    {
        $cours = Cour::whereHas('students', function ($q) {$q->where('user_id', \Auth::id());})->paginate(12);
        $categories = category::all();
        $enseignants = User::whereHas('roles', function ($q) {$q->where('role_id', 2);})->get();

        return view('Client.StudentCours', compact('cours','categories', 'enseignants'));
    }





}

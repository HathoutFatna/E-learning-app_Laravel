<?php

namespace App\Http\Controllers;

use App\category;
use App\User;
use Illuminate\Http\Request;
use App\Cour;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{

    public function index(Request $req)
    {
        $cours = Cour::OrderBy('id', 'desc')->take(8)->get();

        return view('Client.home', compact('cours'));
    }

}

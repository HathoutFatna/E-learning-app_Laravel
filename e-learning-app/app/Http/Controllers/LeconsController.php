<?php

namespace App\Http\Controllers;

use App\category;
use App\Lecon;
use Illuminate\Http\Request;
use App\Cour;
use Symfony\Component\HttpFoundation\Response;

class LeconsController extends Controller
{

    public function show(Lecon $lecon)
    {
        $previous_lecon = Lecon::where('chapitre_id', $lecon->chapitre_id)
            ->where('position','<', $lecon->position)
            ->orderBy('position','desc')
            ->first();
        $next_lecon = Lecon::where('chapitre_id', $lecon->chapitre_id)
            ->where('position','>', $lecon->position)
            ->orderBy('position','asc')
            ->first();
        return view('Client.lecon', compact('lecon','previous_lecon','next_lecon'));
    }
}

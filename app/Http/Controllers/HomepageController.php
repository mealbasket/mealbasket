<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Recipe;

class HomepageController extends Controller
{
    public function index()
    {
        //$suggest = ;
        $random = Recipe::all()->random(10);
        $recent = Recipe::all()->sortByDesc('created_at')->take(10);
        $activity = Auth::User()->Activity->take(10);
        return view('index')->with('random', $random)->with('recent', $recent)->with('activity', $activity);
    }
}

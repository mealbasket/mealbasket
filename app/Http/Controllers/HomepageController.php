<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Recipe;

class HomepageController extends Controller
{
    public function index()
    {
        $random = Recipe::approved()->get()->random(10);
        $recent = Recipe::approved()->get()->sortByDesc('created_at')->take(10);
        $activity = null;
        if(Auth::check())
        {
           $activity = Auth::User()->Activity()->orderBy('pivot_updated_at', 'desc')->take(10)->get();
           if($activity->isEmpty())
           {
                $activity = null;
           }
        }
        return view('index')->with('random', $random)->with('recent', $recent)->with('activity', $activity);
    }
}

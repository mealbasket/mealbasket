<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkRole:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the recipe index.
     *
     * @return \Illuminate\Http\Response
     */
    public function recipe()
    {
        $recipes = Recipe::select('id', 'name', 'approved')->paginate(30);
        return view('admin.recipe.index')->with('recipes', $recipes);
    }
}


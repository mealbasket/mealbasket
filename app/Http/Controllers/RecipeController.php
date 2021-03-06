<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Nutrition;
use App\Units;
use App\Ingredient;
use Auth;
use Storage;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('checkRole:admin')->except(['index', 'show']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::approved()->paginate(30);
        return view('recipe.index')->with('recipes', $recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        if(Auth::check())
        {
            Auth::User()->Activity()->syncWithoutDetaching([$recipe->id]);
            Auth::User()->Activity()->find($recipe->id)->pivot->incrVisits();
        }
        return view('recipe.show')->with('recipe', $recipe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $nutrition = Nutrition::select('name')->get();
        $units = Units::select('unit_short')->get();
        $ingredients = Ingredient::select('id', 'name')->get();
        return view('recipe.edit')->with('recipe', $recipe)->with('nutrition', $nutrition)->with('units', $units)->with('ingredients', $ingredients);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        if($request->has('approved'))
        {
            $this->validate($request, [
                'approved' => 'in:0,1'
            ]);            
        }
        else
        {
            $this->validate($request, [
                'name' => 'string',
                'rating' => 'numeric|min:0|nullable',
                'description' => 'string',
                'prep_time' => 'integer|min:1',
                'photo' => 'image'
            ]);
        }
        $data = $request->only($recipe->getFillable());
        $recipe->fill($data);
        if ($request->hasFile('photo')) {
            Storage::disk('s3')->delete($recipe->image_path);
            $recipe->image_path = $request->photo->store('recipe_images', 's3');
        }
        $recipe->save();
        return redirect('/admin/recipes')->with('success', 'Recipe updated');
    }

    public function updateNutrition(Request $request, Recipe $recipe)
    {
        $this->validate($request, [
            'rn' => 'required|array',
            'rn.*.name' => 'required|string',
            'rn.*.unit' => 'required|string',
            'rn.*.amount' => 'required|integer|min:1',
        ]);
        $data = array();
        foreach($request->rn as $rn)
        {
            $nutrId = Nutrition::firstOrCreate(['name' => $rn['name']])->id;
            $unitId = Units::firstOrCreate(['unit_short' => $rn['unit']])->id;
            $data[$nutrId] = ['unit_id' => $unitId, 'value' => $rn['amount']];
        }
        $recipe->Nutrition()->sync($data);
        return back()->with('success', 'Recipe Nutrition updated');
    }

    public function updateSteps(Request $request, Recipe $recipe)
    {
        $this->validate($request, [
            'rs' => 'required|array',
            'rs.*.id' => 'required|integer|min:1|distinct',
            'rs.*.text' => 'required|string',
            'rs.*.photo' => 'image',
        ]);
        $data = array();
        foreach($request->rs as $rs)
        {
            $step = $recipe->Steps()->firstOrNew(['id' => $rs['id']]);
            $step->text =  $rs['text'];
            if(array_key_exists('photo', $rs))
            {
                if($step->image_path)
                {
                    Storage::disk('s3')->delete($step->image_path);
                }
                $step->image_path = $rs['photo']->store('recipe_images', 's3');
            }
            if(!$step->image_path)
                return back()->with('error', 'All steps need images');
            $step->save();
        }
        return back()->with('success', 'Recipe Steps updated');
    }

    public function updateIngredients(Request $request, Recipe $recipe)
    {
        $this->validate($request, [
            'ri' => 'required|array',
            'ri.*.id' => 'required|integer|exists:ingredients,id',
            'ri.*.unit' => 'nullable|string',
            'ri.*.value' => 'nullable|integer',
        ]);
        $data = array();
        foreach($request->ri as $ri)
        {
            $ingId = $ri['id'];
            if($ri['value']!=null)
            {    
                $unitId = Units::firstOrCreate(['unit_short' => $ri['unit']])->id;
            }
            else {
                $ri['value'] = 0;
                $unitId = 14; //undefined unit for 'to taste' value
            }
            $data[$ingId] = ['unit_id' => $unitId, 'value' => $ri['value']];
        }
        $recipe->Ingredients()->sync($data);
        return back()->with('success', 'Recipe Ingredients updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect('/admin/recipes')->with('success', 'Recipe deleted');
    }
}

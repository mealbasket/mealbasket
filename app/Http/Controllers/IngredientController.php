<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Units;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::select('id', 'name', 'base_quantity', 'price', 'unit_id', 'image_path')->paginate(30);
        return view('ingredient.index')->with('ingredients', $ingredients);
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
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        return view('ingredient.edit')->with('ingredient', $ingredient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'photo' => 'image'
        ]);
        $data = $request->only($ingredient->getFillable());
        $ingredient->fill($data);
        if ($request->hasFile('photo')) {
            Storage::disk('s3')->delete($ingredient->image_path);
            $ingredient->image_path = $request->photo->store('ingredient_images', 's3');
        }
        $ingredient->unit_id = Units::firstOrCreate(['unit_short'=> $request->unit])->id;
        $ingredient->save();
        return redirect('/admin/ingredients')->with('success', 'Ingredient updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect('/admin/ingredients')->with('success', 'Ingredient deleted');
    }
}

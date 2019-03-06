<?php

namespace App\Http\Controllers\Api;

use App\Recipe;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $recipe = new Recipe();
        $data = $request->only($recipe->getFillable());
        $recipe->fill($data);
        $recipe->image_path = $request->photo->store('recipe_images', 's3');
        $recipe->save();
        return response()->json(['success' => 'true', 'id' => $recipe->id], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return $recipe;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        //
    }

    public function checkBySiteId($site_id)
    {
        $r = Recipe::where('site_id', $site_id)->first();
        if ($r)
        {
            return response()->json(['exists' => 'true', 'id' => $r->id], 200);
        }
        else
        {
            return response()->json(['exists' => 'false'], 404);
        }
    }

    public function storeTags(Request $request)
    {
        $id = $request->json()->get('id');
        $tags = $request->json()->get('tags');
        $r = Recipe::find($id);
        $t = array();
        foreach ($tags as $tag) {
            $temp = Tag::firstOrCreate(['name' => $tag]);
            $t[] = $temp->id;
        }
        $r->Tags()->sync($t);
        $r->save();
        return response()->json(['success' => 'true', 'id' => $r->id], 200);
    }
}
<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Tag;
use App\Units;
use App\Nutrition;
use App\RecipeStep;
use App\Ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
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

    public function storeRecipe(Request $request)
    {
        $recipe = new Recipe();
        $data = $request->only($recipe->getFillable());
        $recipe->fill($data);
        $recipe->image_path = $request->photo->store('recipe_images', 's3');
        $recipe->save();
        return response()->json(['success' => 'true', 'id' => $recipe->id], 200);
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

    public function storeNutrition(Request $request)
    {
        $id = $request->json()->get('id');
        $nutrition = $request->json()->get('nutrition');
        $r = Recipe::find($id);
        $n = array();
        foreach ($nutrition as $nut) {
            $temp1 = Nutrition::firstOrCreate(['name' => $nut['name']]);
            $temp2 = Units::firstOrCreate(['unit_short' => $nut['unit']]);
            $n[$temp1->id] = ['unit_id'=>$temp2->id, 'value'=>$nut['value']];
        }
        $r->Nutrition()->sync($n);
        $r->save();
        return response()->json(['success' => 'true', 'id' => $r->id], 200);
    }

    public function storeSteps(Request $request)
    {
        $data = $request->all();
        for($i=1; $i<=$data['count']; $i++)
        {
            $step = new RecipeStep;
            $step->id = $i;
            $step->recipe_id = $data['id'];
            $step->text = $data['step_'.$i];
            $step->image_path = $request->file('image_'.$i)->store('step_images', 's3');
            $step->save();
        }
        return response()->json(['success' => 'true', 'id' => $data['id']], 200);
    }

    public function storeIngredients(Request $request)
    {
        $data = $request->all();
        $r = Recipe::find($data['id']);
        $in = array();
        for($i=1; $i<=$data['count']; $i++)
        {
            if(!array_key_exists('unit_'.$i, $data))
                $data['unit_'.$i]='undefined';
            if(!array_key_exists('value_'.$i, $data))
                $data['value_'.$i]=0;
            if(!Ingredient::where('name', $data['ing_'.$i])->exists())
            {
                $ing = new Ingredient;
                $ing->name = $data['ing_'.$i];
                $ing->price = 60;
                $ing->base_quantity = 1;
                $ing->image_path = $request->file('image_'.$i)->store('ingredient_images', 's3');
                $temp = Units::firstOrCreate(['unit_short' => $data['unit_'.$i]]);
                $ing->unit_id = $temp->id;
                $ing->save();
            }
            else
            {
                $ing = Ingredient::where('name', $data['ing_'.$i])->first();
                $temp = Units::firstOrCreate(['unit_short' => $data['unit_'.$i]]);
            }
            $in[$ing->id]=['unit_id'=>$temp->id, 'value'=>$data['value_'.$i]];
        }
        $r->Ingredients()->sync($in);
        $r->save();
        return response()->json(['success' => 'true', 'id' => $r->id], 200);
    }
}
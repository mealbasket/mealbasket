<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Tag;
use App\Units;
use App\Nutrition;
use App\RecipeStep;
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
}
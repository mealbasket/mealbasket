<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Tag;
use App\Ingredient;

class SearchController extends Controller
{
    /**
     * Show the search page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search');
    }

    /**
     * Show the search results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'query' =>'required',
            'type' =>'in:recipe,ingredient'
          ]);
        $query = $request->input('query');
        $type = $request->input('type');
        if ($type=="recipe") {
            $tag = Tag::where('name', $query)->first();
            if($tag != null)
            {
                $tagId = $tag->id;
                $result = Recipe::where('name', 'like', '%'.$query.'%')
                            ->orWhereHas('tags', function ($q) use($tagId) {
                                $q->where('tag_id', $tagId);
                                }
                            )->approved()->paginate(10);
            }
            else {
                $result = Recipe::where('name', 'like', '%'.$query.'%')->approved()->paginate(10);
            }

            return view('recipe.index')->with('recipes', $result);
        }
        if ($type=="ingredient") {
            $result = Ingredient::where('name', 'like', '%'.$query.'%')->paginate(10);
            return view('ingredient.index')->with('ingredients', $result);
        }
    }
}

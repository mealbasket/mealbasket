<?php

namespace App\Http\Controllers;

use App\Review;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addReview(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string',
            'id' => 'required|integer|exists:recipes,id'
        ]);
        $review = new Review;
        $review->message = $request->message;
        $review->recipe_id = $request->id;
        $review->user_id = Auth::User()->id;
        $review->save();
        return back()->with('success', 'Review added');
    }

    public function deleteReview(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:reviews,id'
        ]);
        $review = Review::find($request->id);
        $review->delete();
        return back()->with('success', 'Review deleted');
    }
}

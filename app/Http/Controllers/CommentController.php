<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function show($id){
        $feedbacks= Feedback::where('ad_id', $id)->get();
        // Calculate the new average rating
        $averageRating = Feedback::where('ad_id', $id)->pluck('rating')->avg();
        return view('comments',['feedbacks'=>$feedbacks, 'averageRating'=> $averageRating]);
    }

    public function showEq($id){
        $feedbacks= Feedback::where('ad_id', $id)->get();
        // Calculate the new average rating
        $averageRating = Feedback::where('ad_id', $id)->pluck('rating')->avg();
        return view('comments',['feedbacks'=>$feedbacks, 'averageRating'=> $averageRating, 'id'=>$id]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255'
        ]);

        // Store the rating and comment
        $feedback = new Feedback;
        $feedback->user_id = request()->user()->id; 
        $feedback->rating = $request->rating;
        $feedback->comment = $request->comment;
        $feedback->ad_id = $request->adtype;
        $sess_id = session('equipment');
        if($sess_id == $request->adtype){
            $feedback->ad_type = 'equipment'; 
        }else{
            $feedback->ad_type = 'product'; 
        }

        $feedback->save();

        // Return response
        return response()->json([
            'user' => request()->user()->firstname.' '.request()->user()->lastname,  
            'rating' => $feedback->rating,
            'comment' => $feedback->comment
            
        ]);
    }

}

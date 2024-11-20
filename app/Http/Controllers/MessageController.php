<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //

    public function store(Request $request){

        $validated = $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message'=> 'required|string',
        ]);

        $conversation = Conversation::find($validated['conversation_id']);

        if($conversation->user_1_id !== Auth::id() && $conversation->user_2_id !== Auth::id()){
            return response()-json(['message' => 'Unauthorized'], 403);
        }

        $message = Message::create([
            'conversation_id' => $validated['conversation_id'],
            'message' => $validated['message'],
            'user_id' => Auth::id(),
        ]);

        return response()->json($message, 201);

    }

    public function update(Request $request){
        $validated = $request->validate([
            'conversation_id' =>'required|exists:conversations,id',
        ]);
        $messages = Message::where('conversation_id', $validated['conversation_id'])->get();

        foreach($messages as $message){
            if($message->user_id != Auth::id()){
                $message->is_read = true;
                $message->save();
            }
            
        }
        return response()->json(['status' => 'Messages marked as read'], 200);

    }

    public function getUnreadMessages(){
        $conversations = Conversation::where('user_1_id', Auth::id())
        ->orWhere('user_2_id', Auth::id())->get();

        $totalUnreadCount = 0;
        foreach($conversations as $conversation){
            $unreadCount = Message::where('conversation_id', $conversation->id)
            ->where('is_read', false)
            ->where('user_id', '!=', Auth::id())
            ->count();

            $totalUnreadCount +=  $unreadCount;
        }

        return response()->json(['unreadCount' => $totalUnreadCount]);
    }
}

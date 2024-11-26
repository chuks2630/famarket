<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use App\Http\Controllers\MessageController;

class ConversationController extends Controller
{
    //
    protected $messageController;

    public function __construct(MessageController $messageController)
    {
        $this->messageController = $messageController;
    }

    public function show(){
        $user = Auth::user()->id;
        $conversations = Conversation::where('user_1_id',$user )->orWhere('user_2_id', $user)->with(['user1','user2','messages'])->orderBy('updated_at', 'desc')->get();
        foreach($conversations as $conversation){
            $request = new Request([
                'conversation_id' => $conversation->id
            ]);
            $this->messageController->update($request);
        }
        
        return view('messaging', ['conversations'=> $conversations]);
    }


    public function fetchConversation($id)
    { 
        $conversation = Conversation::findOrFail($id);
        if($conversation->user_1_id !== Auth::id() && $conversation->user_2_id !== Auth::id()){
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($conversation->messages);
    }


    public function index()
    {
        $conversations = Conversation::where('user_1_id', Auth::id())
        ->orWhere('user_2_id', Auth::id())
        ->get();

        return response()->json($conversations);
    }


    public function store(Request $request){
        // validating id to ensure it's a valid user id in DB
        $request->validate([
            'participant' => 'required|exists:users,id',
            'message'=> 'required'
        ]);
        
        $participant = $request->input('participant');
        $user = Auth::user()->id;
        

        //checking if user and participant have an existing conversation in DB
        $existingConversation = Conversation::where(function ($query) use ($user, $participant){
            $query->where('user_1_id', $user)
            ->Where('user_2_id', $participant);
        })
        ->orWhere(function ($query) use ($user, $participant){
            $query->where('user_1_id', $participant)
            ->Where('user_2_id', $user);
        })->first();
        
        //returning existing conversation if it exists
        if($existingConversation){
           $message =  Message::create([
            'conversation_id' => $existingConversation->id,
            'message' => $request->input('message'),
            'user_id' => $user,
            ]);

            return response()->json($message, 201);
        }

        //creating new conversation if no previous conversation exists
        $conversation = Conversation::create([
            'user_1_id' => $user,
            'user_2_id' => $participant,
        ]);

       $message = Message::create([
            'conversation_id' => $conversation->id,
            'message' => $request->input('message'),
            'user_id' => $user,
            ]);

        return response()->json($message, 201);
    }
}

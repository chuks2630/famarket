@extends('layout.messageInterface')

@section('content')

<div class="row my-2 justify-content-center">
    <div class="col-md-3 user_col shadow convolist"  >
        <div class="row message-header p-2 mb-2">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <h5 class="pt-2">My Messages</h5>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col px-0">
                @foreach($conversations as $conversation)
                <div class="chat">
                    <input type="hidden" value="{{$conversation->id}}" id="convoId">

                    @if ($conversation->user1->id == Auth::id())
                        <div class="profile">
                            <img src="/storage/{{$conversation->user2->profile_pic}}">
                        </div>
                        <div class="chat_info">
                        <div class="contact_name"> {{$conversation->user2->firstname.' '.$conversation->user2->lastname}} </div>
                    @else

                        <div class="profile">
                            <img src="/storage/{{$conversation->user1->profile_pic}}">
                        </div>
                        <div class="chat_info">
                        <div class="contact_name"> {{$conversation->user1->firstname.' '.$conversation->user1->lastname}} </div>
                    @endif
                    
                      @php
                          $latestMessage = $conversation->messages->sortByDesc('created_at')->first();
                          $time = $latestMessage->created_at->diffForHumans();
                      @endphp
                      
                      <div class="contact_msg"> {{$latestMessage->message}} </div>
                    </div>
                    <div class="chat_status">
                      <div class="chat_date">{{$time}}</div>
                      {{-- <div class="chat_new grad_pb"> New </div> --}}
                    </div>
                 </div>
                 @endforeach
                

            </div>
        </div>

    </div>
    <div class="col-md-8 chatbox">
        <div class="row">
            @php
               $latestConversation =  $conversations->sortByDesc('timestamp')->first();
            @endphp
            <div class="col-md-12 header-right py-2 mb-2">
                {{-- <div class="me-0"><i class="fa-solid fa-arrow-left-long"></i></div> --}}
                <input type="hidden" id="conversationId" value="{{$latestConversation->id}}">
                @if ($latestConversation->user1->id == Auth::id())
                <div class="header-img profile">
                    <img src="/storage/{{$latestConversation->user2->profile_pic}}">
                </div>
                <h4 class="friend-name" id="receiver">{{$latestConversation->user2->firstname. ' '.$latestConversation->user2->lastname}}</h4>
                @else
                <div class="header-img profile">
                    <img src="/storage/{{$latestConversation->user1->profile_pic}}">
                </div>
                <h4 class="friend-name" id="receiver">{{$latestConversation->user1->firstname. ' '.$latestConversation->user1->lastname}}</h4>
                @endif
                
            </div>
            <div class="col">
                <div class="chat-container">
                    <div class="messages-container" id="messages">
                        @foreach ($latestConversation->messages as $message)
                            @if($message->user_id == Auth::id())
                            <div class="message-container sender-message-container">
                                <div class="message-bubble sender-message-bubble">
                                    {{$message->message}} 
                                </div>
                            </div>
                            @else
                                <div class="message-container reciever-message-container">
                                    <div class="message-bubble2 reciever-message-bubble">
                                        {{$message->message}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <form action="" id="message-box">
                        @csrf
                    <div class="message-input-container">
                      <input type="text" id="messageInput" placeholder="Type a message...">
                      <button type="submit" id="sendButton">Send</button>
                    </form>
                    </div>
                  </div>
            </div>
            </div>
        </div>
       
</div>

@endsection
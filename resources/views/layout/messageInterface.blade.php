<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-logged-in" content="{{ auth()->check() ? 'true' : 'false' }}">
    <title>Famarket</title>

    <!-- Css Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="/assets/FA/css/all.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/main.css" type="text/css">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite('resources/js/app.js')
</head>

<body class="user_bg p-0">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

 <div class="container-fluid px-0">
    <div class="row" id="top"  >
        <div class="col">
               <!--nav start-->
            <nav class="navbar navbar-expand-lg navbg navbar-dark">
                <div class="container-fluid ">
                    <a class="navbar-brand" href="{{route('homepage')}}"><h3>FAMARKET</h3></a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav pe-5">
                      
                      @auth 

                      <li class="nav-item notification-badges mx-1">
                        <a class="navbar-brand" href="{{route('messages.show')}}" data-bs-toggle="tooltip" title="My messages"  id="messageBadge"><img src="/assets/img/chat.svg" class="nav-icon" alt="icon"></a>
                      </li> 

                      <li class="nav-item mt-1">
                        <a class="navbar-brand" href="" data-bs-toggle="tooltip" title="Bookmarks"><img src="/assets/img/bookmark.svg" class="nav-icon" alt="icon"></a>
                      </li>

                      <li class="nav-item mx-1 mt-2">
                        <a class=" btn btn-warning btn-sm" href="{{route('postad')}}">SELL</a>
                      </li> 
                          
                          <li class="nav-item dropdown ms-2 mt-1">
                            
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa-regular fa-circle-user" style="font-size: 1.2em"></i> Account
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a></li>
                              <li><a class="dropdown-item" href="{{route('shop', Auth::user()->id)}}">Shop</a></li>
                              <li><a class="dropdown-item" href="{{route('myads')}}">My ads</a></li>
                              <li>
                                <a href="#" id="logoutBtn" class="dropdown-item">Logout</a>
                                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                  @csrf
                              </form>
                              </li>
                            </ul>
                          </li>
                          
                          
                          @endauth
                          @guest
                              
                          <li class="nav-item">
                            <a class="nav-link" href="{{route('register')}}"> Register</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}"><i class="fa-regular fa-user"></i> Login</a>
                          </li>
                          @endguest
                    </ul>
                  
                  </div>
                  
                </div>
              </nav>
            <!--nav end-->
            
        </div>
    </div>
   
    @yield('content')
   
</div> 
    <!-- Js Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/main.js"></script>
    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK',
            timer: 3000
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    @endif
    <script>

        $(document).ready(function(){

          $(window).scroll(function(){
            if($(window).scrollTop()>0){
              $("nav").css("background-color","#025d346d");
            }else{
             $("nav").css("background-color","#355E3B");
            }
          });
          

        });
      </script>

      <script>

        $(function(){
          

        $('.chat').click(function(){
          //checking for screen size for conditional displays
              if(window.innerWidth <= 768){
            $('.convolist').css('display', 'none');
            $('.chatbox').css('display', 'block');
            }
            
            //selecting the conversation id 
          const convoId = $(this).find('#convoId').val();
          $('#conversationId').val(convoId);
          //passing the convo id to openConversation function
            openConversation(convoId);
          
        });

        function goBack(){
            if(window.innerWidth <= 768){
                $('.convolist').css('display', 'block');
                $('.chatbox').css('display', 'none');
            }
        }
          
          //function that finds the a conversation in the conversations array, and calls the function that will display messages in that conversation
          function openConversation(conversationId){
            const conversations = @json($conversations);
            let selectedConversation = '';
            selectedConversation = conversations.find(convo=> convo.id == conversationId);
          
           
            if(selectedConversation){
              //if the it is a valid conversation, set the chatbox header to display user name
              receiverName1 = selectedConversation.user2.firstname+' '+selectedConversation.user2.lastname;
              receiverName2 = selectedConversation.user1.firstname+' '+selectedConversation.user1.lastname;
              //conditional rendering
              if(selectedConversation.user1.id == {{Auth::id()}}){
                $('#receiver').html(receiverName1);
              }else{
                $('#receiver').html(receiverName2);
              }
              //calling the function that displays message
              displayMessages(selectedConversation.messages);

              //marking the messages as read when the intended user opens it
              
              markAsRead(conversationId);
              
            }else{
              console.error("conversation not found");
              
            }
            
          }

          //function that helps us to loop and  display  each message 
          function displayMessages(messages){
            const userId = {{Auth::id()}};
            $('#messages').html('');

            messages.forEach( message =>{
              const messageSender = "<div class='message-container sender-message-container'><div class='message-bubble sender-message-bubble'>"+message.message+"</div></div>";
              const messageReciever ="<div class='message-container reciever-message-container'><div class='message-bubble2 reciever-message-bubble'>"+message.message+"</div></div>";
              if(message.user_id === userId){
                $('#messages').append(messageSender);
              }else{
                $('#messages').append(messageReciever);
              }
              
            });
          }

       

        });
      </script>

</body>
</html>
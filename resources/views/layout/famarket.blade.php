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
                    <ul class="navbar-nav">
                      
                      @auth 
                      <li class="nav-item notification-badges mx-1">
                        <a class="navbar-brand" href="{{route('messages.show')}}" data-bs-toggle="tooltip" title="My messages"  id="messageBadge"><img src="/assets/img/chat.svg" class="nav-icon" alt="icon"></a>
                      </li> 

                      <li class="nav-item mt-1">
                        <a class="navbar-brand" href="{{route('savedAds.show')}}" data-bs-toggle="tooltip" title="Bookmarks"><img src="/assets/img/bookmark.svg" class="nav-icon" alt="icon"></a>
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
   
    <!-- Footer Section Begin -->
        <div class="footer px-2 mt-5">
            <div class="row">
                <div class=" col-md-4 ">
                    <div>
                        <a href="{{route('homepage')}}" style="text-decoration: none; color: black; font-size:30px; ">Famarket</a>
                    </div>
                </div>
                <div class=" col-md-4">
                  <p><b>Support</b></p>
                  <a href="#" class="shop_link my-3">support@famarket.com</a><br>
                  <a href="#" class="shop_link"><img src="/assets/img/facebook.svg" alt="" class="nav-icon my-1"> Facebook</a><br>
                  <a href="#" class="shop_link"><img src="/assets/img/instagram.svg" alt=""  class="nav-icon my-1"> Instagram</a><br>
                  <a href="#" class="shop_link"><img src="/assets/img/twitter.svg" alt="" class="nav-icon my-1"> Twitter</a><br>
                  <a href="#" class="shop_link"><img src="/assets/img/tiktok.svg" alt="" class="nav-icon my-1"> Tiktok</a>
                </div>
                <div class=" col-md-4">
                    <p><b>About</b></p>
                    <a href="{{route('aboutus')}}" class="shop_link my-2">About Famarket</a><br>
                    <a href="{{route('notice')}}" class="shop_link my-2">Terms and Conditions</a><br>
                    <a href="#" class="shop_link">Privacy Policy</a><br>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p style="font-size: small" class="text-center">Copyright &copy;<script>document.write(new Date().getFullYear());</script> Developed By Bonobo Technology</p>
                            <p style="font-size: smaller" class="text-center mb-0"> <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
&copy;<script>document.write(new Date().getFullYear());</script> <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Footer Section End -->
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

          //setinterval function
          window.onload = function() {
            var iteration = 0;
            setInterval(() => {
             const text = [ ' Our platform connects farmers and buyers together ', ' Find fresh produce, reliable suppliers, and agricultural services all in one place! ',  ' Welcome to Famarket! '];
             $('#intro-text').html(text[iteration]);
             iteration++;
             if(iteration == 3){
                iteration = 0;
             }

            }, 3000); // interval in milliseconds
        };

        });
      </script>
      <script>
        
        $(function(){
        $('#ratingForm').on('submit', function(e) {
            e.preventDefault();
            
            const rating = $('input[name="rating"]:checked').val();
            const comment = $('#comment').val();
            const adtype = $('#adtype').val();
            if (!rating || !comment) {
                alert('Please provide both a rating and a comment.');
                return;
            }

           
            $.ajax({
                url: '{{route('comment.store')}}',  
                type: 'POST',
                data: {
                    rating: rating,
                    comment: comment,
                    adtype: adtype,
                    _token: '{{ csrf_token() }}'  
                },
                success: function(response) {
                    // After successful submission, append the new comment and rating
                    const newComment = `
                        <div class="comment-box">
                            <strong>${response.user}</strong><br>
                            <span class="rating"><i class="fa fa-star" style="color: #f39c12;"></i> ${response.rating}</span>
                            <p>${response.comment}</p>
                        </div>`;
                    $('#commentsSection').append(newComment);

                },
                error: function(error) {
                    console.log(error)
                    alert('There was an error submitting your rating. Please try again.');
                }
            });
        });
        });
      </script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            if(query == ''){
                $('#search-results').html('');
            }
            $.ajax({
                url: "{{ route('search') }}",
                type: "GET",
                data: { 'query': query },
                success: function(data) {
                    $('#search-results').html(data);
                }
            });
        });

        $('#search').change(function(){
            $('#search-results').html('');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#search_cat').on('keyup', function() {
            var query = $(this).val();
            var category = $('#category_id').val();
            $.ajax({
                url: "{{ route('searchcat') }}",
                type: "GET",
                data: { 'query': query, 'category': category },
                success: function(data) {
                    $('#search-result').html(data);
                }
            });
        });
    });
</script>

</body>
</html>
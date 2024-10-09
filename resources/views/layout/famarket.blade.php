<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Famarket</title>

    <!-- Css Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="/assets/FA/css/all.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"> -->
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/slicknav.min.css" type="text/css">
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

 <div class="container-fluid">
    <div class="row" id="top"  >
        <div class="col mx-0 px-0">
               <!--nav start-->
            <nav class="navbar navbar-expand-lg navbg">
                <div class="container-fluid ">
                    <a class="navbar-brand" href="{{route('homepage')}}"><h3>FAMARKET</h3></a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                      
                      @auth
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('postad')}}"><i class="fa-solid fa-bell"></i></a>
                      </li> 
                          <li class="nav-item">
                            <a class="nav-link" href="{{route('postad')}}"><i class="fa-solid fa-display"></i> Post Ad</a>
                          </li> 
                          <li class="nav-item dropdown me-2">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 My Account
                            </a>
                            <ul class="dropdown-menu px-0">
                              <li><a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a></li>
                              <li><a class="dropdown-item" href="{{route('shop', Auth::user()->id)}}">Shop</a></li>
                              <li><a class="dropdown-item" href="{{route('myads')}}">My ads</a></li>
                            </ul>
                          </li>
                          <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                              @csrf
                              <button type="submit" class="mt-1 pt-1 logout_btn">logout</button>
                          </form>
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
    <footer class="footer spad mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div>
                        <h3>Famarket</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="action_btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
</div> 
    <!-- Js Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
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

            $.ajax({
                url: "{{ route('search') }}",
                type: "GET",
                data: { 'query': query },
                success: function(data) {
                    $('#search-results').html(data);
                }
            });
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
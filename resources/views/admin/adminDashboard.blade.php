<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="/assets/FA/css/all.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Admin</title>

</head>
<body class="user_bg">
    <div class="container-fluid ">
        <div class="row" id="top">
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
                              
                          <li class="nav-item dropdown me-5">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 Admin
                            </a>
                            <ul class="dropdown-menu px-0">
                              <li><a class="dropdown-item" href="{{route('approve.show')}}">Ad approval</a></li>
                              <li><a class="dropdown-item" href="{{route('alluser')}}">All users</a></li>
                            </ul>
                          </li>
                          <li class="nav-item">
                            <form method="POST" action="{{ route('admin.logout') }}">
                              @csrf
                              <button type="submit" class="mt-1 pt-1 logout_btn">logout</button>
                          </form>
                          </li>
                          @endauth
                          @guest
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
    
    <div class="row gx-1 p-3  justify-content-around mt-4">
        <div class="col-md-3 user_col" style="height: 100%">
            <div class="row pt-4">
                <div class="col text-center">
                    <img src="/assets/img/default.png" alt="" width="80" style="border-radius: 50%;">
                    <p>Admin</p>
                </div>
                <div class="col-12">
                    <div class="user__menu">
                        <ul>
                            <li><a href="{{route('approve.show')}}"><i class="fa-solid fa-check-double"></i>&nbsp;&nbsp; Ad Approval</a></li>
                            <li><a href="{{route('alluser')}}"><i class="fa-solid fa-user-pen"></i>&nbsp;&nbsp;View Users</a></li>
                            <li><a href="{{route('allcat.show')}}"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Add/Edit Categories</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 user_col px-3">
            @yield('resource')
        </div>
    </div>
   </div> 
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <script src="/assets/js/jquery-3.3.1.min.js"></script>
   <script src="/assets/js/bootstrap.min.js"></script>
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
      })

    });
   
  </script>
</body>
</html>

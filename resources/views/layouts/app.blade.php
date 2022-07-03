<?php 
  $user_auth = Auth::user();
  date_default_timezone_set('Asia/Manila');
  //$datetoday = date('Y-m-d H:i:s');
  $year = date('Y');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>PRODUCTS</title>
    
    <link rel="stylesheet" href="{{asset('assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main/app-dark.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main/irene.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/1093.png')}}" type="image/png">
    
    <link rel="stylesheet" href="{{asset('assets/css/shared/iconly.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pages/fontawesome.css')}}">
    @yield('styles') 
    
    
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center text-center">
                        <div class="">
                            <a href="index.html"><img src="{{asset('assets/images/1093.png')}}" alt="Logo" srcset=""> PRODUCT<br></a>
                        </div>
                        
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-item active ">
                        <p class="text-center" style="font-weight:bold; color:#435ebe; font-size:16px;">{{ $user_auth->name}}</p>    
                    </li>
                    @if($user_auth->is_admin=='1')
                    <li class="sidebar-item">
                        <a href="{{route('users.index')}}" class='sidebar-link'>
                        <i class="fas fa-user-tie"></i>
                            <span style="margin-top: 1px;">USERS</span>
                        </a>
                    </li>
                    @endif

                    
                    <li class="sidebar-item">
                        <a href="{{route('products.index')}}" class='sidebar-link'>
                        <i class="fas fa-shopping-bag"></i>
                            <span style="margin-top: 1px;">PRODUCTS</span>
                        </a>
                    </li> 

                   

                    <li class="sidebar-item">
                        <a href="{{route('category.index')}}" class='sidebar-link'>
                        <i class="fas fa-wrench"></i>
                            <span style="margin-top: 1px;">CATEGORY</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="btn btn-danger btn-block" style="text-align:left;" href="{{url('logout')}}" class='sidebar-link'>
                        <i class="fas fa-sign-out-alt"></i>
                            <span style="margin-top: 1px; margin-left:13px;">Logout</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div id="main" style="background-size: cover !important; background:url('{{asset('assets/images/v822-aew-09.jpg')}}');">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
            
        </header>
        

        <div class="page-content" style="background-color:white; opacity:0.9; padding:30px; max-width:1920px;" >
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3 style="color:black;">@yield('title') </h3>
                        <p class="text-subtitle text-muted">@yield('subtitle')</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section" style="max-width: 1920px;">
                @yield('content')
            </section> 
        </div>

        <footer style=" position: fixed; padding-top:5px; padding-left:10px; right:10; bottom: 0; width:100%; background-color:white;">
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start pt-2">
                    <p><b><?php echo $year ;?></b> &copy; NO COMPANY INC.</p>
                </div>
                <div class="float-end">
                    <p></p>
                </div>
            </div>
        </footer>
    </div>
</div>

    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  
    @yield('scripts') 
    <script>
        // document.addEventListener('contextmenu', function(e) {
        //   e.preventDefault();
        // });
        // $(document).keydown(function (event) {
        //     if((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 67) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
        //             return false;
        //     }
        // });
    </script>
</body>

</html>

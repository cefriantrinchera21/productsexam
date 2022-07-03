<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCTS</title>
    <link rel="stylesheet" href="{{asset('assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pages/auth.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main/irene.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/png">
    
</head>

<body>
    <div id="auth">
        
<div class="row">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="text-center">
              <img class="logo" src="{{asset('assets/images/1093.png')}}" alt="Logo" srcset="">
            </div>
            <div class="row pt-3">         
              @include('includes.form_error')
            </div>
            <h1 class="auth-title pt-5">Log in.</h1>
            <p class="auth-subtitle ">Enter your credentials.</p>

            @yield('content')
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="" style="height:100%;background-color:#ba1ca7;">

        </div>
    </div>
</div>

    </div>
</body>

</html>

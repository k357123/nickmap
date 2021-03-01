<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Modern Business - Start Bootstrap Template</title>

    @section('css')
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/modern-business.css" rel="stylesheet">

    <link href="/css/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="/css/fontawesome/css/font-awesome-animation.min.css" rel="stylesheet">
    @show
</head>

<body style="background:#F5F5F5">
    <!-- Navigation -->
    <nav style="background-color: black;" class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/shop">Shop Demo</a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">最新產品</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#l">Contact</a>
                    </li>
                </ul>
            </div> -->

            <div style="">
                <div class="shopingicons mr-auto">
                    <a href="/shop/car" style="text-decoration: none;">
                        <i class="fa fa-shopping-cart icons-btn d-inline-block bag ml-2 text-white"></i>
                        <span style="display:inline-block;background-color:#fff;border-radius: 50%;width:20px;height:20px;text-align: center;line-height:20px;color:black" class="number">{{ $count }}</span>
                    </a>
                    @if(Auth::check())
                    <a href="/shop/profile" style="display:inline-block" class="mx-2 text-white">
                        <li class="fa fa-user"></li> 會員中心
                    </a>
                    <a href="/shop/logout" style="display:inline-block" class="text-white"><i class="fa fa-sign-out-alt"></i> 登出</a>
                    @else
                    <a href="/shop/login" style="display:inline-block" class="mx-2 text-white">
                        <li class="fa fa-user"></li> 登入會員
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    @section('header')

    @show

    <!-- Page Content -->
    <div class="container">

        @yield('content')

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Website 2021</p>
        </div>
    </footer>


    @section('js')
    <!-- Bootstrap core JavaScript -->
    <script src="/js/jquery/jquery.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    @show
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Modern Business - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
 
  <!-- Custom styles for this template -->
  <link href="{{ asset('css/modern-business.css') }}" rel="stylesheet">
 
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">nickmap.com</a>
      <!-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.html">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Portfolio
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <a class="dropdown-item" href="portfolio-1-col.html">1 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-2-col.html">2 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-3-col.html">3 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-4-col.html">4 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-item.html">Single Portfolio Item</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Blog
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="blog-home-1.html">Blog Home 1</a>
              <a class="dropdown-item" href="blog-home-2.html">Blog Home 2</a>
              <a class="dropdown-item" href="blog-post.html">Blog Post</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Other Pages
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
              <a class="dropdown-item" href="full-width.html">Full Width Page</a>
              <a class="dropdown-item" href="sidebar.html">Sidebar Page</a>
              <a class="dropdown-item" href="faq.html">FAQ</a>
              <a class="dropdown-item" href="404.html">404</a>
              <a class="dropdown-item" href="pricing.html">Pricing Table</a>
            </div>
          </li>
        </ul>
      </div> -->
    </div>
  </nav>

  <header>
    <div style="background: linear-gradient(90deg,rgba(255,255,255,.1) 0,rgba(255,255,255,.1) 100%),url(./img/index.jpg);
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;" class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4 text-white">作品集</h1>
        <hr class="my-4">
      </div>
  </div>
  </header>

  <!-- Page Content -->
  <div class="container">

    <!-- <h1 class="my-4">Welcome to Modern Business</h1> -->

    <!-- Marketing Icons Section -->
    <div class="row">
      <div class="col-lg-4 mb-4">
        <div style="height:350px" class="card">
          <div style="background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.6)),url('./img/speech.jpg');background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;" class="card-body d-flex justify-content-center align-items-center flex-column">
          <h4 class="text-white">語音辨識搜尋Youtube</h4>
            <p class="card-text text-white">Google Web Speech API + Youtub API </p>
            <a href="/speech" class="btn btn-warning">詳細資訊</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div style="height:350px" class="card">
          <div style="background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.6)),url('./img/shop.jpg');background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;" class="card-body d-flex justify-content-center align-items-center flex-column">
          <h4 class="text-white">購物網站demo</h4>
            <p class="card-text text-white">Facebook、google、Line API串接 </p>
            <a href="/shop" class="btn btn-warning">詳細資訊</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div style="height:350px" class="card">
          <div style="background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.6)),url('./img/line.jpg');background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;" class="card-body d-flex justify-content-center align-items-center flex-column">
          <h4 class="text-white">Line機器人</h4>
            <p class="card-text text-white">查詢各縣市36H天氣預報(中央氣象局API)</p>
            <a href="/line" class="btn btn-warning">詳細資訊</a>
          </div>
        </div>
      </div>
      
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Website 2021</p>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
  
  
</body>

</html>

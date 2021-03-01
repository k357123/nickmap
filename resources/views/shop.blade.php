@extends('layout')


@section('css')
@parent
<style>
    .cc {
        border: 1px solid transparent;
    }

    .cc>.car {
        /* display: none; */
    }

    .cc:hover {
        border: 1px black solid;
        /* box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5); */
        /* position: absolute;
            z-index: 1; */
    }

    .cc:hover>.car {
        display: block;

    }

    /* @media (max-width: 1200px) { .asd{width:35%} } */
    @media (max-width: 1024px) {
        .asd {
            width: 60% !important
        }
    }

    @media (max-width: 768px) {
        .asd {
            width: 80% !important
        }
    }

    @media (max-width: 576px) {
        .asd {
            width: 96% !important
        }
    }

    .asd {
        width: 35%;
    }

    button {
        font-family: adiHausBold, Arial, Helvetica, Verdana, microsoft jhenghei, sans-serif;
    }
</style>
@endsection

@section('header')
<header>
    <div style="background: linear-gradient(90deg,rgba(255,255,255,.1) 0,rgba(255,255,255,.1) 100%),url(./img/shop/banner.jpg);
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;" class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4 text-white">shop demo</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        </div>
    </div>
</header>
@endsection
@section('content')
<!-- <h1 class="my-4">Welcome to Modern Business</h1> -->
<!-- <a class="mx-2 text-dark " href="#">全部產品</a> -->
<select onmouseenter="console.log(this)" class="form-control mb-3 w-25 d-inline-block mx-2 col-md-3 col-sm-4" name="" id="">
    <option value="">分類</option>
    <option value="">鞋子</option>
    <option value="">衣服</option>
    <option value="">褲子</option>
</select>

<!-- Marketing Icons Section -->
<div class="row">
    @foreach($product as $p)
    <div class="col-lg-3 col-md-4 col-xs-6 col-6 mb-4">
        <div class="cc">
            <input type="hidden" id="{{$p->id}}">
            <a href="/shop/detail/{{$p->id}}">
                <img style="width: 100%;background-position: center center;
          background-repeat: no-repeat;
          background-size: cover;" src="./img/shop/{{$p->img}}" alt="">
            </a>
            <div class="p-2">
                <input type="hidden" id="{{$p->id}}">
                <!-- <p>Notorious 20 A/W Sportswear</p> -->
                <p>{{$p->name}}</p>
                <p>${{$p->price}}</p>
            </div>
        </div>
    </div>
    @endforeach

</div>
<div class="text-center mb-5">
    <div class="float-left d-inline-block">
        <a class=" ">上一頁</a>
    </div>
    <div class="d-inline-block">
        <select class="" name="" id="">
            <option value="">1</option>
            <option value="">2</option>
            <option value="">3</option>
        </select>
    </div>
    <div class="float-right d-inline-block">
        <a class=" ">下一頁</a>
    </div>
</div>
@endsection

@section('js')
@parent
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    window.onload = function() {
        document.querySelectorAll('img').forEach(function(e) {
            console.log(e.height = e.width)
        })
    }
    window.onresize = function() {
        document.querySelectorAll('img').forEach(function(e) {
            console.log(e.height = e.width)
        })
    }
</script>
@endsection
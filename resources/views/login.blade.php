@extends('layout')


@section('css')
@parent
<style>
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
        width: 40%;
    }

    button {
        font-family: adiHausBold, Arial, Helvetica, Verdana, microsoft jhenghei, sans-serif;
    }
</style>
@endsection

@section('content')
<div style="height:100vh" class="container d-flex justify-content-center align-items-center">
    <div style="margin:0 auto;border:darkgray 1px solid;padding:25px;border-radius:4px" class="asd">
        <h3>會員登入</h3>
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <a href="" class="d-inline-block mb-3">註冊</a>
            <a href="/login/facebook" style="background-color: #1976d2;font-size: .9rem;" type="submit" class="btn btn-primary btn-block rounded-0 py-2"><i class="fab fa-facebook-square mr-2"></i>FACEBOOK登入</a>
            <a href="/login/google" style="background-color: #d32f2f;font-size: .9rem;" type="submit" class="btn btn-danger btn-block rounded-0 py-2"><i class="fab fa-google mr-2"></i>GOOGLE登入</a>
            <a href="#" style="background-color: #00B900;font-size: .9rem;" type="submit" class="btn btn-success btn-block rounded-0 py-2">
                <li class="fab fa-line mr-2"></li>LINE登入
            </a>
        </form>
    </div>
</div>
@endsection

@section('js')
@parent

@endsection
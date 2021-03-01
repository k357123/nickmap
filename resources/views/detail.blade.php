@extends('layout')




@section('content')
<!-- Page Heading/Breadcrumbs -->
<h1 class="mt-4 mb-3">Portfolio Item
    <small>Subheading</small>
</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/shop">Home</a>
    </li>
    <li class="breadcrumb-item active">Portfolio Item</li>
</ol>

<!-- Portfolio Item Row -->
<div class="row">

    <div class="col-md-6">
        <img class="img-fluid w-100" src="/img/shop/{{$product->img}}" alt="">
    </div>

    <div class="col-md-6">
        <h3 class="my-3">{{$product->name}}</h3>
        <h5>${{$product->price}}</h5>
        <div class="row my-5">
            <div class="col-2">
                數量
            </div>
            <div class="col-10">
                <div class="d-flex justify-content-start align-items-center justify-content-sm-cneter">
                    <button onclick="decrease()" class="d-inline-block" style="width:50px;height:32px;border:black 1px solid">-</button>
                    <input id="count" class="d-inline-block text-center" style="width:50px;height:32px;" value="1" maxlength="2" type="text">
                    <button onclick="increase()" class="d-inline-block" style="width:50px;height:32px;border:black 1px solid">+</button>
                </div>
            </div>
        </div>
        <a onclick="car({{$product->id}})" class="car btn btn-danger rounded-0 d-block p-2 w-50"><i class="fa fa-shopping-cart"></i>&nbsp;加入購物車</a>
    </div>

</div>

<!-- Related Projects Row -->
<h3 class="my-4">相關商品</h3>

<div class="row">
    <div class="col-md-3 col-sm-6 mb-4">
        <a href="#">
            <img class="img-fluid" src="/img/shop/s3.jpg" alt="">
        </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <a href="#">
            <img class="img-fluid" src="/img/shop/s4.jpg" alt="">
        </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <a href="#">
            <img class="img-fluid" src="/img/shop/s5.jpg" alt="">
        </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <a href="#">
            <img class="img-fluid" src="/img/shop/s6.jpg" alt="">
        </a>
    </div>
</div>


</div>

@endsection

@section('js')
@parent
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function increase() {
        $('#count').val(Number($('#count').val()) + 1);;
    }

    function decrease() {
        if (Number($('#count').val() > 1)) $('#count').val(Number($('#count').val()) - 1);
    }

    function car(id) {
        var count = $('#count').val();
        if (count === '' || count < 1) {
            alert('請選擇數量');
            return false;
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "https://nickmap.com/addcar",
            data: {
                // '_token': $('meta[name="csrf-token"]').attr('content'),
                'id': id,
                'count': count,
            },
            success: function(result) {
                console.log(result);
                // if(!result)location.href="/shop/login";
                // return false;
                $('.number').text(result);
                swal({
                    // title: "Good job!",
                    text: "成功加入購物車",
                    icon: "success",
                    button: "確定",
                    timer: 1000,
                });
            },
            error: function(e) {
                swal({
                    // title: "Good job!",
                    text: "error",
                    icon: "success",
                    button: "Aww yiss!",
                    timer: 1000,
                });
                console.log(e);
            },
        });
    }
</script>
@endsection
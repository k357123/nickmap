@extends('layout')

@section('content')
<h3 class="mt-5" id="carcount">購物車共{{$carCount}}件</h3>
<hr>
@foreach($carTotal as $car)
<div class="cart-item">
    <div class="row">
        <div class="col-xs-2 col-sm-3 col-md-2">
            <img src="/img/shop/{{$car->img}}" style="width:100%">
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8">
            <div>{{$car->name}}</div>
            <div>${{$car->price}}</div>
            <button onclick="car({{$car->id}},this)" class="btn btn-sm btn-danger mt-4 mb-1"><i class="fas fa-trash-alt"></i>刪除</button>
        </div>
        <div class="col-xs-4 col-sm-2 col-md-2">
            <div class="d-flex justify-content-start align-items-center justify-content-sm-cneter">
                <button onclick="decrease({{$car->id}})" class="d-inline-block" style="width:50px;height:32px;border:black 1px solid">-</button>
                <input data-id="{{$car->id}}" data-price="{{$car->price}}" class="d-inline-block text-center" style="width:50px;height:32px;" value="{{$car->count}}" type="text">
                <button onclick="increase({{$car->id}})" class="d-inline-block" style="width:50px;height:32px;border:black 1px solid">+</button>
            </div>
            <h5 id="single-{{$car->id}}" class="mt-4">${{$car->single_price_total}}</h5>
        </div>
    </div>
    <hr>
</div>
@endforeach
<div class="ml-auto w-100 col-sm-5  col-md-4 col-lg-3 mb-5">
    <div class="row">
        <div class="col-5">
            <h5>商品總計</h5>
        </div>
        <div id="allcount" class="col-7 text-right">${{$allPrice}}</div>
    </div>
    <hr>
    <button class="btn btn-dark btn-block">去買單</button>
</div>

@endsection

@section('js')
@parent
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function increase(id) {
        var allPrice = 0;
        $('input[data-id=' + id + ']').val(Number($('input[data-id=' + id + ']').val()) + 1);

        $('input[data-id]').each(function() {
            var single_price_total = Number($(this).val()) * Number($(this).data('price'));
            $('#single-' + $(this).data('id')).text('$' + single_price_total);
            allPrice += single_price_total;
        });
        $('#allcount').text('$' + allPrice);
    }

    function decrease(id) {
        var allPrice = 0;
        if (Number($('input[data-id=' + id + ']').val() > 1)) $('input[data-id=' + id + ']').val(Number($('input[data-id=' + id + ']').val()) - 1);

        $('input[data-id]').each(function() {
            var single_price_total = Number($(this).val()) * Number($(this).data('price'));
            $('#single-' + $(this).data('id')).text('$' + single_price_total);
            allPrice += single_price_total;
        });
        $('#allcount').text('$' + allPrice);

    }

    function car(id, e) {
        console.log(e);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "https://nickmap.com/editcar",
            data: {
                // '_token': $('meta[name="csrf-token"]').attr('content'),
                'id': id,
            },
            success: function(result) {
                console.log(result);
                var allPrice = 0;
                $(e).parent().parent().parent('.cart-item').remove();
                $('.number').text(result);

                $('input[data-id]').each(function() {
                    var single_price_total = Number($(this).val()) * Number($(this).data('price'));
                    $('#single-' + $(this).data('id')).text('$' + single_price_total);
                    allPrice += single_price_total;
                });
                $('#allcount').text('$' + allPrice);
                $('#carcount').text('購物車共' + $('input[data-id]').length + '件');
            },
            error: function(e) {
                console.log(e);
            },
        });
        console.log(123);
    }
</script>
@endsection
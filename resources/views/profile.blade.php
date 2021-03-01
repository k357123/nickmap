@extends('layout')


@section('css')
@parent
<link href="/css/bootstrap/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('content')

<div style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);" class="container d-flex justify-content-center align-items-center bg-white my-5 py-5">
    <form class="w-75">
        <h4 class="font-weight-bold py-1">會員資料</h4>
        <hr>
        <div class="form-row">
            <div class="col-md-6 my-2">
                <label>Email</label>
                <input type="text" class="form-control" value="{{$user->email}}" disabled>
            </div>
            <div class="col-md-6 my-2">
                <label for="name">姓名</label>
                <input type="text" class="form-control" id="name" value="{{$user->name}}" placeholder="姓名">
            </div>
            <div class="col-md-6 my-2">
                <label>生日</label>
                <input type="text" class="form-control datepicker" placeholder="生日">
            </div>
            <div class="col-md-6 my-2">
                <div class="mb-2">性別</div>
                <label for="male" class="">男</label>
                <input style="width:15px;height:15px" type="radio" id="male" name="gender" value="male">
                <label for="female" class="ml-2">女</label>
                <input style="width:15px;height:15px" type="radio" id="female" name="gender" value="female">
            </div>
            <div class="col-md-6 my-2">
                <label for="phone">手機號碼</label>
                <input type="text" class="form-control" id="phone" placeholder="手機號碼">
            </div>
            <div class="col-md-12 my-2">地址</div>
            <div class="col-md-4 my-2">
                <select class="form-control" name="" id="">
                    <option value="">台灣</option>
                </select>
            </div>
            <div class="col-md-4 my-2">
                <select id="city" onchange="cityName(this.value)" class="form-control" name="city">
                    <option value="0">縣市</option>
                    <option value="基隆市">基隆市</option>
                    <option value="台北市">台北市</option>
                    <option value="新北市">新北市</option>
                    <option value="宜蘭縣">宜蘭縣</option>
                    <option value="新竹市">新竹市</option>
                    <option value="新竹縣">新竹縣</option>
                    <option value="桃園市">桃園市</option>
                    <option value="苗栗縣">苗栗縣</option>
                    <option value="台中市">台中市</option>
                    <option value="彰化縣">彰化縣</option>
                    <option value="南投縣">南投縣</option>
                    <option value="嘉義市">嘉義市</option>
                    <option value="嘉義縣">嘉義縣</option>
                    <option value="雲林縣">雲林縣</option>
                    <option value="台南市">台南市</option>
                    <option value="高雄市">高雄市</option>
                    <option value="屏東縣">屏東縣</option>
                    <option value="台東縣">台東縣</option>
                    <option value="花蓮縣">花蓮縣</option>
                    <option value="金門縣">金門縣</option>
                    <option value="連江縣">連江縣</option>
                    <option value="澎湖縣">澎湖縣</option>
                    <option value="南海諸島">南海諸島</option>
                </select>
            </div>
            <div class="col-md-4 my-2">
                <select id="area" onchange="areaName(this.value)" class="form-control" name="area">
                    <option value="0">鄉鎮市區</option>
                </select>
            </div>
            <div class="col-md-4 my-2">
                <input id="postal_code" type="text" class="form-control" name="postal_code" placeholder="郵遞區號">
            </div>
            <div class="col-md-8 my-2">
                <input class="form-control" type="text" placeholder="詳細地址">
            </div>
        </div>

        <h4 class="font-weight-bold pb-1 pt-4 w-100">變更密碼</h4>
        <hr>
        <div class="form-row mb-3">
            <div class="col-md-7 my-2">
                <input class="form-control" type="text" placeholder="舊密碼">
            </div>
            <div class="col-md-7 my-2">
                <input class="form-control" type="text" placeholder="新密碼">
            </div>
            <div class="col-md-7 my-2">
                <input class="form-control" type="text" placeholder="確認密碼">
            </div>
        </div>
        <button class="btn btn-primary px-5" type="submit">儲存</button>
    </form>
</div>
@endsection

@section('js')
@parent
<script src="/js/bootstrap/bootstrap-datepicker.js"></script>
<script src="/js/bootstrap/bootstrap-datepicker.zh-TW.js"></script>
<script src="/js/city_area_code.js"></script>
<script>
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: 'bottom',
        language: 'zh-TW',
        defaultViewDate: 'today'

    });
</script>
<script>
    function cityName(cityname) {

        if (cityname == 0) {
            $('#area').html('<option value="0">鄉鎮市區</option>');
            return false;
        }

        $('#area').html('<option value="0">鄉鎮市區</option>');
        $.each(city_area_code, function(i, e) {
            // console.log(e);
            if (e[0] == cityname) {
                $('#area').append('<option data-postal-code="' + e[2] + '" value="' + e[1] + '">' + e[1] + '</option>')
            }
        })
    }
</script>
<script>
    function areaName(areaname) {
        var postalCode;
        if (areaname == 0) {
            $('#postal_code').val('');
            return false;
        }

        postalCode = $('#area option:selected').attr('data-postal-code');
        $('#postal_code').val(postalCode);

    }
</script>
@endsection
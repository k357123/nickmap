<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
use App\User;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Shop;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function (Request $request) {
    // $value = cookie('key', 'value', 60);
    // echo '<pre>';
    // print_r($value);
    // echo '</pre>';
    // cookie('cookie_name', 'value', 1);
    // cookie('name', 'cccc');
    // Cookie::make('test', 'hello, world', 1);
    // Cookie::queue('cc', '{Hello:7777}');
    // Cookie::queue(Cookie::forget('cc'));
    // Auth::attempt(['name'=>12,'cccc'=>2222],true);
    // print_r(Cookie::get());
    // session(['username' => 77777777777]);
    return view('index');
    // $user = User::where('email', 'test@gmail.com')->get();
    // $user = User::find('1');
    // print_r($user);
    // Auth::attempt(['email'=>'test@gmail.com','password'=>'12345678']);
    // Auth::login($user);
    // session()->put('adsad',123132);
    // Auth::logout();
    // var_dump($user);
    // var_dump(Auth::attempt(['email'=>'test@gmail.com','password'=>'12345678']));
    // var_dump(Auth::login($user));
    print_r(session()->all());
});

Route::get('/cc', 'cccController@cc');

Route::get('/speech', function () {
    return view('speech');
});

Route::post('/speech', function (Request $request) {
    $text=$request->text;
    $key=env('YOUTUBE_API_KEY');

    $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=".$text."+&maxResults=12&key=".$key."&type=video";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //沒設取不到資料
	$res = curl_exec($ch);
	curl_close($ch);

	print_r($res);
});

Route::get('/shop/login', function () {
    if(Cookie::get('dd')==null){
        $count=0;
    }else{
        $count=count(json_decode(Cookie::get('dd'), true));
    }
    return view('login')->with('count',$count);
});

Route::get('/shop/car', function () {
    // print_r(Shop::whereIn('id',[1,2])->get());
    // print_r(json_decode(Cookie::get('dd'),true));
    // return false;
    // print_r(Cookie::get('dd'));
    // return false;
    // var_dump(Auth::check());
    // return false;
    $car = Cookie::get('dd');
    if ($car == null) {
        return view('car')->with('carTotal', [])->with('allPrice', 0)->with('carCount', 0)->with('count',0);
    } else {
        $carArray = json_decode($car, true);
        $id = array_keys($carArray);
        $carTotal = Shop::whereIn('id', $id)->get();
        $carCount = Shop::whereIn('id', $id)->get()->count();
        $allPrice = 0;
        foreach ($carTotal as $key => $val) {
            $carTotal[$key]['count'] = $carArray[$val->id];
            $carTotal[$key]['single_price_total'] = $carArray[$val->id] * $val->price;
            $allPrice += $carArray[$val->id] * $val->price;
        }
    }

    $count=count(json_decode(Cookie::get('dd'), true));

    // print_r($carTotal);
    // return false;
    return view('car')->with('carTotal', $carTotal)->with('carCount', $carCount)->with('allPrice', $allPrice)->with('count',$count);
});
Route::get('/shop/detail/{productID}', function ($id) {
    $product = Shop::where('id', $id)->get()->first();
    if(Cookie::get('dd')==null){
        $count=0;
    }else{
        $count=count(json_decode(Cookie::get('dd'), true));
    }
    
    return view('detail')->with('product', $product)->with('count',$count);
});
Route::get('/shop', 'ShopController@cc');
Route::post('/addcar', function (Request $request) {
    $car = Cookie::get('dd');
    if ($car == null) {
        $productId = $request->id;
        $productCount = $request->count;
        $carArray[$productId] = $productCount;
        Cookie::queue('dd', json_encode([$productId => $productCount]), 60 * 24);
        print_r(count($carArray));
    } else {
        $productId = $request->id;
        $productCount = $request->count;
        $carArray = json_decode($car, true);
        $carArray[$productId] = $productCount;
        Cookie::queue('dd', json_encode($carArray), 60 * 24);
        count(json_decode(Cookie::get('dd'), true));
        // print_r(Cookie::get('dd'));
        print_r(count($carArray));
    }

    // Cookie::queue('shopping_cart', '{}');
    // var_dump(json_encode(new stdClass()));
    // var_dump(json_decode('{}') === ((object) []));
    // print_r(Cookie::get('dd')==null);

    // print_r($_POST);
    // print_r(Cookie::get('ddd'));
    // Cookie::queue(Cookie::forget('cc'));
    // return redirect('http://127.0.0.1/nickmap/public/speech');
});

Route::post('/editcar', function (Request $request) {
    $id = $request->id;
    $carArray = json_decode(Cookie::get('dd'), true);
    unset($carArray[$id]);
    Cookie::queue('dd', json_encode($carArray), 60 * 24);
    print_r(count($carArray));
});

Route::post('/add', function (Request $request) { });
Route::post('/delete', function (Request $request) { });

Route::get('/login/{socailname}', 'SocailController@redirect');
Route::get('/login/{socailname}/callback', 'SocailController@callback');

Route::get('/shop/logout', function () {
    Auth::logout();
    return redirect('/shop');
});


// register

Route::get('/shop/profile', function () {
    if(Cookie::get('dd')==null){
        $count=0;
    }else{
        $count=count(json_decode(Cookie::get('dd'), true));
    }
    return view('profile')->with('count',$count)->with('user',Auth::user());
});

Route::get('/line', function () {
    return view('line');
});


Route::get('/we', function () {
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, 'https://opendata.cwb.gov.tw/fileapi/v1/opendataapi/F-C0032-001?Authorization=CWB-77F7EF76-6578-458C-ACDF-72ABF4BE7727&downloadType=WEB&format=JSON');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //沒設取不到資料
	$res = curl_exec($ch);
	curl_close($ch);

    $data=json_decode($res,true);
   
    $des['00']='凌晨';
    $des['06']='白天';
    $des['12']='下午';
    $des['18']='晚上';
    
    foreach($data['cwbopendata']['dataset']['location'] as $key=>$val){
        // echo $val['locationName'];
        // echo '<hr>';
        if($val['locationName']=='臺北'){
           

            $time=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][0]['startTime'];
            $time_wx=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][0]['parameter']['parameterName'];
            $time_min=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][2]['time'][0]['parameter']['parameterName'];
            $time_max=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][1]['time'][0]['parameter']['parameterName'];
            $time_des=$des[date('H',strtotime($time))];
            $text= date('Y-m-d',strtotime($time)).' '.$time_des.' '.$time_wx.' | 溫度 '.$time_min.'~'.$time_max."℃\r\n";
            echo '<br>';

            $time=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][1]['startTime'];
            $time_wx=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][1]['parameter']['parameterName'];
            $time_min=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][2]['time'][1]['parameter']['parameterName'];
            $time_max=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][1]['time'][1]['parameter']['parameterName'];
            $time_des=$des[date('H',strtotime($time))];
            $text.= date('Y-m-d',strtotime($time)).' '.$time_des.' '.$time_wx.' | 溫度 '.$time_min.'~'.$time_max."℃\r\n";
            echo '<br>';

            $time=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][2]['startTime'];
            $time_wx=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][2]['parameter']['parameterName'];
            $time_min=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][2]['time'][2]['parameter']['parameterName'];
            $time_max=$data['cwbopendata']['dataset']['location'][0]['weatherElement'][1]['time'][2]['parameter']['parameterName'];
            $time_des=$des[date('H',strtotime($time))];
            $text.= date('Y-m-d',strtotime($time)).' '.$time_des.' '.$time_wx.' | 溫度 '.$time_min.'~'.$time_max."℃";
        }
    }
    // echo $text;
    
    print_r($data['cwbopendata']['dataset']['location']);

    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][0]['startTime']);
    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][0]['parameter']['parameterName']);
    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][2]['time'][0]['parameter']['parameterName']);
    // echo '~';
    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][1]['time'][0]['parameter']['parameterName']);
    // echo '<hr>';

    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][1]['startTime']);
    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][1]['parameter']['parameterName']);
    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][2]['time'][1]['parameter']['parameterName']);
    // echo '~';
    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][1]['time'][1]['parameter']['parameterName']);
    // echo '<hr>';

    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][2]['startTime']);
    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][0]['time'][2]['parameter']['parameterName']);
    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][2]['time'][2]['parameter']['parameterName']);
    // echo '~';
    // print_r($data['cwbopendata']['dataset']['location'][0]['weatherElement'][1]['time'][2]['parameter']['parameterName']);
    
    // echo $a=date('Y-m-d H:i:s',strtotime('2021-02-17T05:55:00+08:00'));
    // echo $des['00']='凌晨';
    // echo $des['06']='白天';
    // echo $des['12']='下午';
    // echo $des['18']='晚上';

    // echo date('H',strtotime('2021-02-17T05:55:00+08:00'));
});


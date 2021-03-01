<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/asd', function (Request $request) {

    $me = $request->all();
    $replyToken = $me['events'][0]['replyToken'];
    $text = $me['events'][0]['message']['text'];
    $headerArray = array("Content-type:application/json", "Authorization: Bearer KGMlH3vujclvAgThY4wkgsGJPPmp0/kmzcWK/fPb5eP+Sm9gO3UrMeFyRkdS3R2ehiIU7MmY/0WgfY7ZpFuVqTKn5ibPL4eeoWl4/9sKDtT16SfCuX9ChJNrThF99QAySmUOHkerot3nQMxDNQmakwdB04t89/1O/w1cDnyilFU=");


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, 'https://opendata.cwb.gov.tw/fileapi/v1/opendataapi/F-C0032-001?Authorization=CWB-77F7EF76-6578-458C-ACDF-72ABF4BE7727&downloadType=WEB&format=JSON');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //沒設取不到資料
    $res = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($res, true);

    $des['00'] = '凌晨';
    $des['06'] = '白天';
    $des['12'] = '下午';
    $des['18'] = '晚上';

    $text = str_replace('台', '臺', $text);

    foreach ($data['cwbopendata']['dataset']['location'] as $key => $val) {
        // echo $val['locationName'];mb_strlen('新北','utf-8')
        // echo '<hr>';
        if ($val['locationName'] == $text || preg_match("/$text/",$val['locationName']) && mb_strlen($text,'utf-8')==2) {
            $time = $val['weatherElement'][0]['time'][0]['startTime'];
            $time_wx = $val['weatherElement'][0]['time'][0]['parameter']['parameterName'];
            $time_min = $val['weatherElement'][2]['time'][0]['parameter']['parameterName'];
            $time_max = $val['weatherElement'][1]['time'][0]['parameter']['parameterName'];
            $time_des = $des[date('H', strtotime($time))];

            $res_text = "$text\r\n\r\n";
            $res_text .= date('Y-m-d', strtotime($time)) . "\r\n" . $time_des . ' ' . $time_wx . ' | 溫度 ' . $time_min . '~' . $time_max . "℃\r\n";
            // echo '<br>';

            $time = $val['weatherElement'][0]['time'][1]['startTime'];
            $time_wx = $val['weatherElement'][0]['time'][1]['parameter']['parameterName'];
            $time_min = $val['weatherElement'][2]['time'][1]['parameter']['parameterName'];
            $time_max = $val['weatherElement'][1]['time'][1]['parameter']['parameterName'];
            $time_des = $des[date('H', strtotime($time))];
            $res_text .= date('Y-m-d', strtotime($time)) . "\r\n" . $time_des . ' ' . $time_wx . ' | 溫度 ' . $time_min . '~' . $time_max . "℃\r\n";
            // echo '<br>';

            $time = $val['weatherElement'][0]['time'][2]['startTime'];
            $time_wx = $val['weatherElement'][0]['time'][2]['parameter']['parameterName'];
            $time_min = $val['weatherElement'][2]['time'][2]['parameter']['parameterName'];
            $time_max = $val['weatherElement'][1]['time'][2]['parameter']['parameterName'];
            $time_des = $des[date('H', strtotime($time))];
            $res_text .= date('Y-m-d', strtotime($time)) . "\r\n" . $time_des . ' ' . $time_wx . ' | 溫度 ' . $time_min . '~' . $time_max . "℃";
        }
    }
    // echo $text;

    if (!isset($res_text)) $res_text = '不存在該縣市';

    $data = [
        "replyToken" => $replyToken,
        "messages" => [["type" => "text", "text" => $res_text]]
    ];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.line.me/v2/bot/message/reply');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
});

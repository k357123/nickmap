<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>nick個人作品</title>

    <!-- Bootstrap Core CSS -->
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="./css/bootstrap/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="./css/fontawesome/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="css/stylish-portfolio.min.css" rel="stylesheet"> -->

    <!-- <link rel="stylesheet" href="./loaders.min.css">
    <link rel="stylesheet" href="./loaders.css.js"> -->
    <style>
        .line-scale-party > div {
  background-color: orange;
}
    </style>

</head>

<body>

    <div class="container">
        <div class="card text-center mt-5">
            <div class="card-header bg-info">
            <h5 class="my-2">Google Web Speech API 語音辨識</h5>       
            </div>
            <div class="card-body">
              <p style="height:150px;line-height:150px;" id="show" class="card-text "></p>
              <span>語言 : </span>
              <select id="lang">
                <option value="zh-TW">中文(台灣)</option>
                <option value="en-US">英語(美國)</option>
                <option value="ja-JP">日語</option>
                <option value="ko-KR">韓語</option>
                <option value="fr-FR">法語</option>
                <option value="vi-VN">越語</option>
                <option value="th-TH">泰語</option>
            </select>
            </div>
            
            <div class="card-footer text-muted">
                <a href="#" id="microphone" onclick="startMicrophone()" class="btn btn-primary btn-lg fa fa-microphone-alt"></a>
                <!-- <a href="#" id="pause" onclick="endMicrophone()" class="d-none btn btn-danger btn-lg icon-control-pause"></a> -->
                <a id="pause" style="color:orange;text-decoration: none;" class="d-none fa-2x fas fa-spinner fa-spin"></a>
            </div>
          </div>
          
        <div class="content-section-heading text-center">
            <h4 class="my-3">Youtube搜尋結果</h4>
        </div>
 
        <div id="video" class="row no-gutters">
      
        </div>
  
        <div id="page" class="d-flex align-items-center justify-content-center">
            
        </div>
    </div>
    
    <script>
        var pause=document.getElementById('pause');
        var microphone= document.getElementById('microphone');
        var show = document.getElementById('show');
        var video = document.getElementById('video');
        var lang= document.getElementById('lang');
        var onStart=false;

        function startMicrophone(){
            // pause.classList.remove("d-none");
            // microphone.classList.add("d-none");
            
            recognition.lang = lang.options[lang.selectedIndex].value;
            recognition.start();
            
        }

        // function endMicrophone(){
        //     microphone.classList.remove("d-none");
        //     pause.classList.add("d-none");
        // }


        if (!('webkitSpeechRecognition' in window)) {
            show.style.color='red';
            show.innerHTML='瀏覽器不支援語音辨識';
            
        } else {
            var recognition = new webkitSpeechRecognition();

            recognition.continuous = false;
            recognition.interimResults = true;
            // recognition.lang = "zh-TW";

            recognition.onerror = function(event) {
                console.log(event.error);
                
                if(event.error!==undefined){
                    show.style.color='red';
                    show.innerHTML=event.error;
                    alert(event.error);
                };
             
            }
 
            recognition.onstart = function () {
                pause.classList.remove("d-none");
                microphone.classList.add("d-none");
                console.log('開始辨識...');
                onStart=true;
               
            };
            recognition.onend = function (event) {
                console.log('停止辨識!');
                if(onStart==false)return false;
            
                microphone.classList.remove("d-none");
                pause.classList.add("d-none");

                var text =show.innerHTML;
                var api =
                    "https://nickmap.com/speech";
                fetch(api, {
                        method: 'POST',
                        headers:  {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'content-type': 'application/json',
                            },
                        body: JSON.stringify({
                            text: text,
                        })
                    })
                    .then(function (response) {
                        console.log(response);
                        response.json().then(
                            function (data) {
                                var changeClass;
                                var vedioString = '';
                                var pageString='';
                                var pageNumber = data.items.length/6;
                                console.log(data.items.length/6);
                                console.log(data);
                                data.items.forEach(function (i, index) {
                                    // console.log(data.items[index].id.videoId);
                                    // console.log(index);
                                    index<6?changeClass='show-control':changeClass='d-none';                            
                                    
                                    vedioString=vedioString+"<div data-ytb-id='"+data.items[index].id.videoId+"' id='a"+(index+1)+"' class='col-lg-4 p-1 "+changeClass+"'><iframe src='https://www.youtube.com/embed/"+data.items[index].id.videoId+"' frameborder='0' width='100%' height='300px'></iframe></div>";
                                    console.log(vedioString);
                                });
                                console.log(video);
                                video.innerHTML=vedioString;
                                
                                if(data.items.length==0){
                                    video.innerHTML='<div class="w-50 alert alert-success" role="alert">video搜尋無結果</div>';
                                }else{
                                    console.log(changeClass);
                                    console.log(pageNumber);
                                    for(var i =1;i<=Math.floor(pageNumber);i++){
                                        var pageColor = i ==1?'btn-primary':'';
                                        pageString=pageString+'<a class="page mt-3 mx-1 btn btn-sm '+pageColor+'" onclick="pageBtn(this)" href="#">'+i+'</a>';
                                    }

                                    page.innerHTML=pageString;
                                }

                            })
                    }).catch(function (err) {
                        console.log('error');
                    })

            };

            recognition.onresult = function (event) {
                var i = event.resultIndex;
                var j = event.results[i].length - 1;
                show.innerHTML = event.results[i][j].transcript;
            };

            // recognition.start();
        }

        function pageBtn(e){
            var clickPage=e.textContent;
            var firstPage=e.textContent*6-6+1;
            var lastPage=e.textContent*6;
            var showControl=document.querySelectorAll('.show-control');
            var page=document.querySelectorAll('.page');
            showControl.forEach(function(i,index){
                i.classList.remove("show-control");
                i.classList.add("d-none");
            })
            for(var i=firstPage;i<=lastPage;i++){
                var selectId = document.getElementById('a'+i);
                selectId.classList.remove("d-none");
                selectId.classList.add("show-control");

                // document.getElementById('a'+i).firstChild.src='https://www.youtube.com/embed/7lCDEYXw3mM';
            }

            page.forEach(function(i,index){
                if(i.classList.contains('btn-primary')){
                    i.classList.remove("btn-primary");
                }
            })

            page.forEach(function(i,index){
                if(i.textContent==clickPage){
                    i.classList.add("btn-primary");
                }
            })
        }

    </script>
</body>

</html>
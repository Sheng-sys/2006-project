<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .photo{
            width: 650px;
            height: 650px;
        }
        .divs{
            width: 150px;
            height: 150px; 
            border: 10px solid gray;
            float: left;
            margin: 5px;
            text-align: center;
            line-height: 150px;
            font-size: 20px;
            font-weight: bold;
        }
        img{
            width: 150px;
            height: 150px;  
        }
        .border{
            border: 10px solid red;
        }
    </style>
</head>
<body>
<?php
      if($_COOKIE = " "){
        echo "无用户登录";
      }else{
        echo "用户名称： $_COOKIE[name]";
      }
      echo "<br>";
      echo "<a href=\"tuichu.php\">退出登录</a>";
      echo "<br>";
      echo "<a href=\"jiudian.php\">酒店</a>";
      echo "<hr>";
      echo "<h1>房间预定</h1>";
      echo "<b id=\"shijian\"></b>";
?>
    <h1 id="shijian">剩余时间</h1>
    <hr>
    <div class="photo">
        <div class="divs"><img src="./images/3.jpg" alt=""></div>
        <div class="divs"><img src="./images/3.jpg" alt=""></div>
        <div class="divs"><img src="./images/3.jpg" alt=""></div>
        <div class="divs"><img src="./images/3.jpg" alt=""></div>
        <div class="divs"><img src="./images/3.jpg" alt=""></div>
        <div class="divs"><img src="./images/3.jpg" alt=""></div>
        <div class="divs"><img src="./images/3.jpg" alt=""></div>
        <div class="divs"><img src="./images/3.jpg" alt=""></div>
        <div class="divs"><img src="./images/3.jpg" alt=""></div>
        
    </div>
    <hr>
    <button id="kaishi">开始</button>
    <button id="jieshu">结束</button>
</body>
<script src="./jquery-3.5.1.min.js"></script>
<script>
    var divs = $('.divs')
    var kaishi = $('#kaishi')
    var jieshu = $('#jieshu')
    var intervar = null
    var timers = []
    kaishi.bind('click',function(){
        // alert(111)
        divs.children('img').show()
        timers.splice(0,timers.length)
        intervar = setInterval(function(){
            divs.removeClass('border')
            var num = parseInt(Math.random()*1000)%9
            // console.log(num)
            divs.eq(num).addClass('border') 
       },50)
       timers.push(intervar)
       console.log(timers)
    })

    jieshu.bind('click',function(){
        clearInterval(intervar)
        timers.splice(0,timers.length)
        $.ajax({
            method:"get",
            url:"prize2.php",
            dataType:'json'
        }).done(function(code){
            // alert(111)
            if(code.errno == 0){
                divs.each(function(num){
                    if($(this).hasClass('border')){
                        divs.eq(num).children('img').hide()
                        $(this).append(code.mgs)
                    }
                })
            }else{
                alert(code.mgs)
                window.location.href = 'u_login.html'
            }
        
        })
    })
</script>
</html>
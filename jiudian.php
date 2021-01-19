<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #box{
            width: 600px;
        }
        .fangjian{
            width: 100px;
            height: 100px;
            background-color: green;
            float: left;
            margin: 10px;
            font-size: 15px;
            text-align: center;
        }
        p{
            margin-top: 1px;
            margin-left: 1px;
            width: 98px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <?php
      if($_COOKIE['name'] = null){
          echo "无用户登录";
      }else{
          echo "用户名称： 王乐$_COOKIE[name]";
      }
      echo "<br>";
      echo "<a href=\"tuichu.php\">退出登录</a>";
      echo "<br>";
      echo "<a href=\"prize.php\">抽奖</a>";
      echo "<hr>";
      echo "<h1>房间预定</h1>";
      echo "<b id=\"shijian\"></b>";

      include('pdo.php');
      $pdo = getPdo(); 
      $sql = "select * from p_room";
      $res = $pdo->query($sql);
      $arr = $res->fetchAll(PDO::FETCH_ASSOC);
    //   print_r($arr);
    
    foreach($arr as $k=>$v){
        $name = $v['room_name'];
        $price = $v['price'];
        $status = $v['status'];
        if($status == 0){
            $status = "可预订";
        }else{
            $status = "以预订";
        }
        echo "<div id=\"box\">
                 <div class=\"fangjian\"><p room_id=\"$name\">$status</p>{$name}<br><span>定价{$price}元</span></div>
              </div>";   
    }
    
    ?>
</body>
<script>
    setInterval(function(){
        var day = new Date()
        var year = day.getFullYear()
        var month = day.getHours()
        if(month<10){month='0'+month}
        var days = day.getDate()
        if(days<10){days='0'+days}
        var hours = day.getHours()
        if(hours<10){hours='0'+hours}
        var minutes = day.getMinutes()
        if(minutes<10){minutes='0'+minutes}
        var seconds = day.getSeconds()
        if(seconds<10){seconds='0'+seconds}
        var shijian = year+"年"+month+"月"+days+"日"+" "+hours+":"+minutes+":"+seconds
        // console.log(shijian)
        document.getElementById('shijian').innerHTML = shijian
    },1000)

    var p = document.querySelectorAll('p')
    // console.log(p)

    for(var i=0;i<p.length;i++){
        if(p[i].innerText == "以预订"){
            p[i].parentNode.style.backgroundColor = "red"
        }
        p[i].addEventListener('click',function(){
            var _this = this 
            var room_name = this.innerText
            var room_id = this.attributes['room_id'].nodeValue //获取自定义属性值
            if(room_name == "可预订"){
                if(window.confirm('是否确认预定')){
                    // alert(111)
                    var xhr = new XMLHttpRequest()
                    xhr.onreadystatechange = function(){
                        if(xhr.readyState == 4 && xhr.status == 200){
                            var json_str = xhr.responseText
                            var code = JSON.parse(json_str)
                            if(code.errno == 0){
                                alert(code.mgs)
                                _this.parentNode.style.backgroundColor = "red"
                            }else{
                                alert(code.mgs)
                                window.location.href = 'ajax3.html'
                            }
                        }
                    }
                    xhr.open('GET','jiudian2.php?room_id='+room_id)
                    xhr.send()

                }
            }else{
                // this.parentNode.style.backgroundColor = "red"
                alert("该房间已被预订")
            }     
        })
    }

</script>
</html>
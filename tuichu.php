<?php

 setcookie("name", '');
 
 if($_COOKIE = ""){
     echo "退出登录成功,2秒后跳转";
     header("refresh:2,url='jiudian.php'");exit;
 }else{
     echo "以无用户登录,2秒后跳转";
     header("refresh:2,url='jiudian.php'");exit;
 }

?>
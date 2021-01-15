<?php
   
   $username = $_POST['username'];
   $tel = $_POST['mobile'];
   $email = $_POST['email'];
   $pwd = $_POST['pwd'];
   $pwd2 = $_POST['pwd2'];
   
   //验证密码是否相同
   if($pwd != $pwd2){
       $response = [
           'errno' => 400001,
           'mgs' => '前后密码输入不一致'
       ];

       die(json_encode($response));
   }

   //验证密码长度 》6
   if(strlen($pwd)<6){
        $response = [
            'errno' => 400002,
            'mgs' => '密码长度不能小于6位'
        ];

        die(json_encode($response));
   }

   //验证手机号
   if(strlen($tel)!=11){
        $response = [
            'errno' => 400003,
            'mgs' => '请输入正确手机号格式'
        ];

        die(json_encode($response));
   }
   
   //连接数据库
   $mysqli = new mysqli('127.0.0.1','root','root','test');

   //验证用户名唯一性
   $sql = "select * from p_users where user_name = '$username'";
   $res = $mysqli->query($sql);
   $data = mysqli_fetch_assoc($res);
   
   if(!empty($data)){
        $response = [
            'errno' => 400004,
            'mgs' => '用户名已存在'
        ];

        die(json_encode($response));
   }

   //验证邮箱唯一性
   $sql2 = "select * from p_users where email = '$email'";
   $res2 = $mysqli->query($sql2);
   $data2 = mysqli_fetch_assoc($res2);
   if(!empty($data2)){
        $response = [
            'errno' => 400005,
            'mgs' => '邮箱已存在'
        ];

        die(json_encode($response));
   }
   
   //生成用户密码
   $pwd = password_hash($pwd,PASSWORD_BCRYPT);
   
   $sql3 = "insert into p_users (user_name,email,mobile,password) values ('$username','$email','$tel','$pwd')"; 
   $res3 = $mysqli->query($sql3);
   if(!empty($res3)){
        $response = [
            'errno' => 0,
            'mgs' => '注册成功'
        ];
   }else{
        $response = [
            'errno' => 400006,
            'mgs' => '注册失败'
        ];
   }

   echo json_encode($response);
?>
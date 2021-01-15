<?php
  
   $username = $_POST['username'];

   $pwd = $_POST['pwd'];
  
   //连接数据库
   $mysqli = new mysqli('127.0.0.1','root','root','test');
    
   $sql = "select * from p_users where user_name = '{$username}' or mobile = '{$username}' or email = '{$username}'";
   $res = $mysqli->query($sql);
   $data = mysqli_fetch_assoc($res);
   if($username == $data['user_name']){
       $pwd2 = password_verify($pwd,$data['password']);
       if($pwd2 = true){
            $response = [
                'errno' => 0,
                'mgs' => '登录成功'
            ];
       }else{
            $response = [
                'errno' => 400008,
                'mgs' => '账号或密码有误'
            ];
       }
   }else{
        $response = [
            'errno' => 400009,
            'mgs' => '账号或密码有误'
        ];
   }

   
   echo json_encode($response);

?>
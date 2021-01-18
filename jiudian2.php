<?php

  $name = $_GET['room_id'];

  include('pdo.php');
  $pdo = getPdo(); 

  $sql = "update p_room set status = 1 where room_name = '$name'";
  $res = $pdo->query($sql);
  

  

  if(!empty($_COOKIE['name'])){
    if($res != " "){
      $response = [
        'errno' => '0',
        'mgs' => '恭喜客户预定成功'
      ];
    }
}else{
  $response = [
    'errno' => '400006',
    'mgs' => '未登录即将跳转登录页面'
  ];
}

echo json_encode($response);
?>
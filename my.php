<?php
   
  $name = $_POST["name"];

  include('pdo1.php');

  $sql = "select * from users where user_name = '$name'";

  $res = $pdo->query($sql);

  $data = $res->fetch(PDO::FETCH_ASSOC);
  
  echo json_encode($data);

?>
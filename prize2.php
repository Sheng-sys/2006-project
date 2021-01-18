<?php

   if(!empty($_COOKIE['name'])){
        $num = mt_rand(1,10);
        if($num == 1){
                $reponse = [
                    'errno' => '0',
                    'mgs' => '一等奖'
                ];
        }else if($num == 2){
                $reponse = [
                    'errno' => '0',
                    'mgs' => '二等奖'
                ];
        }else if($num == 3){
                $reponse = [
                    'errno' => '0',
                    'mgs' => '三等奖'
                ];
        }else{
                $reponse = [
                    'errno' => '0',
                    'mgs' => '再接再厉'
                ];
        }
    }else{
        $reponse = [
            'errno' => '400006',
            'mgs' => '未登录即将跳转登录页面'
        ];
    }

   echo json_encode($reponse);
?>
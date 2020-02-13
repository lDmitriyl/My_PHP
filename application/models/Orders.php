<?php

namespace application\models;

use application\core\Model;

class Orders extends Model {
    function makeNewOrder($name,$phone,$address){
        $userId=$_SESSION['user']['id'];
        $comment="id пользователя {$userId}</br>
                    Имя:{$name}</br>
                    Телефон:{$phone}</br>
                    Адрес:{$address}</br>";
        $dataCreated=date('Y.m.d H:i:s');
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $sql="INSERT INTO `orders` (`user_id`,`date_created`,`date_payment`,`status`,`comment`,`user_ip`)
              VALUES (:userId,:dataCreated,null,0,:comment,:user_ip)";
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':userId',$userId);
        $stmt->bindParam(':dataCreated',$dataCreated);
        $stmt->bindParam(':comment',$comment);
        $stmt->bindParam(':user_ip',$user_ip);
        if($stmt->execute()){
            $statement = $this->db->query("SELECT `id` FROM `orders` ORDER BY id DESC LIMIT 1");
            $result=$statement->fetchAll();
            if(isset($result[0])){
                return $result['0']['id'];
            }
        }
        return false;
    }
}

<?php

namespace application\models;

use application\core\Model;

class Comment extends Model {
    public function checkParams($body){
        $rs=null;
        if(!$body){
            return $rs['message']="Введите коментарий";
        }
        return $rs;
    }

    public function comment($param, $comment){
        $sql = "INSERT INTO `comments`(`com_id`,`comment`) VALUES (:comid,:comment)";
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':comid', $param);
        $stmt->bindParam(':comment', $comment);
        if($stmt->execute()) {
            $_SESSION['success'] = 'Коментарий добавлен';
            header("location:/comment/index/num/$param");
            exit();
        }
    }
    public function selectComments($comid){
        $comment=[];
        $sql="SELECT `id`,`com_id`,`comment`,`dtime` FROM `comments` WHERE com_id='$comid' ORDER BY `dtime` DESC";
        $res=$this->db->query($sql);
        $i=0;
        while($result = $res->fetch()){
            $comment[$i]['id']=$result['id'];
            $comment[$i]['com_id']=$result['com_id'];
            $comment[$i]['comment']=$result['comment'];
            $comment[$i]['dtime']=$result['dtime'];
            $i++;
        }
        return $comment;
    }
}

<?php

namespace application\models;

use application\core\Model;
use PDO;
class Goods extends Model {

    public function selectGoods(){
        $goods = [];
        $stmt = $this->db->prepare('SELECT `id`,`title`,`price` FROM `catalog`');
        if ($stmt->execute()) {
            $i=0;
            while ($good = $stmt->fetch()) {
                $goods[$i]['id'] = $good['id'];
                $goods[$i]['title'] = $good['title'];
                $goods[$i]['price'] = $good['price'];
                $i++;
            }
            return $goods;
        }
    }

    public function addGoods($name,$price){
        $sql='INSERT INTO `catalog`(`title`,`price`) VALUES(:title,:price)';
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':title',$name,PDO::PARAM_STR);
        $stmt->bindParam(':price',$price,PDO::PARAM_STR);
        if($stmt->execute()){
            $_SESSION['success']='Товар добавлен';
            header('location:/admin/goods/index');
            exit();
        }
    }

    public function deleteGoods($id){
        $sql='DELETE FROM `catalog` WHERE `id`=:id';
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        if($stmt->execute()){
            $_SESSION['success']='Товар удалён';
            header('location:/admin/goods/index');
            exit();
        }
    }

    public function editGoods($id,$title,$price){
        $stmt = $this->db->prepare('UPDATE `catalog` SET `title`=:title,`price`=:price WHERE `id`=:id');
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->bindParam(':title',$title,PDO::PARAM_STR);
        $stmt->bindParam('price',$price,PDO::PARAM_STR);
        if($stmt->execute()){
            $_SESSION['success']='Товар отредактирован';
            header('location:/admin/goods/index');
            exit();
        }
    }

    public function Goods($id){
        $menu=[];
        $stmt = $this->db->prepare('SELECT `id`,`title`,`price` FROM `catalog` WHERE `id`=:id ');
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        if($stmt->execute()){
            return $menu = $stmt->fetch();
        }
        return $menu;
    }
}

<?php

namespace application\models;

use application\core\Model;
use PDO;

class Menu extends Model
{
    public function selectMenu(){
        $menus = [];
        $stmt = $this->db->prepare('SELECT `id`,`title`,`path` FROM `menus`');
        if ($stmt->execute()) {
            $i=0;
            while ($menu = $stmt->fetch()) {
                $menus[$i]['id'] = $menu['id'];
                $menus[$i]['title'] = $menu['title'];
                $menus[$i]['path'] = $menu['path'];
                $i++;
            }
            return $menus;
        }
    }

    public function addMenu($name,$path){
    $sql='INSERT INTO `menus`(`title`,`path`) VALUES(:title,:path)';
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':title',$name,PDO::PARAM_STR);
        $stmt->bindParam(':path',$path,PDO::PARAM_STR);
        if($stmt->execute()){
            $_SESSION['success']='Пункт меню добавлен';
            header('location:/admin/menu/index');
            exit();
        }
    }

    public function deleteMenu($id){
        $sql='DELETE FROM `menus` WHERE `id`=:id';
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        if($stmt->execute()){
            $_SESSION['success']='Пункт меню удалён';
            header('location:/admin/menu/index');
            exit();
        }
    }

    public function editMenu($id,$title,$path){
        $stmt = $this->db->prepare('UPDATE `menus` SET `title`=:title,`path`=:path WHERE `id`=:id');
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->bindParam(':title',$title,PDO::PARAM_STR);
        $stmt->bindParam('path',$path,PDO::PARAM_STR);
        if($stmt->execute()){
            $_SESSION['success']='Пункт меню отредактирован';
            header('location:/admin/menu/index');
            exit();
        }
    }
    public function Menu($id){
        $menu=[];
        $stmt = $this->db->prepare('SELECT `id`,`title`,`path` FROM `menus` WHERE `id`=:id ');
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        if($stmt->execute()){
            return $menu = $stmt->fetch();
        }
        return $menu;
    }
}


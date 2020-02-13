<?php

namespace application\models;

use application\core\Model;

class Shop extends Model {

    public function catalog(){
        $goods=[];
        $sql = "SELECT `id`, `title`, `price` FROM catalog";
        $res=$this->db->query($sql);
        $i=0;
        while($shop = $res->fetch()){
            $goods[$i]['id']=$shop['id'];
            $goods[$i]['title']=$shop['title'];
            $goods[$i]['price']=$shop['price'];
            $i++;
        }
        return $goods;
    }
}


<?php

namespace application\models;

use application\core\Model;

class Cart extends Model{

    public function showCart(array $itemsid){
        $goods=[];
        if(count($itemsid) < 1)
            return $goods;
        $strid=implode($itemsid,',');
        $sql = "SELECT `id`, `title`, `price` FROM catalog WHERE `id` in ({$strid})";
        $res=$this->db->query($sql);
        if($res) {
            $i = 0;
            while ($shop = $res->fetch()) {
                $goods[$i]['id'] = $shop['id'];
                $goods[$i]['title'] = $shop['title'];
                $goods[$i]['price'] = $shop['price'];
                $i++;
            }
        }
        return $goods;
    }

    function getProducts(array $itemsid){
        $products=array();
        if(count($itemsid)<1)
            return $products;
        $strid=implode($itemsid,',');

        $sql = "SELECT `id`, `title`, `price` FROM catalog WHERE `id` in ({$strid})";
        $res=$this->db->query($sql);
        if($res) {
            $i = 0;
            while ($shop = $res->fetch()) {
                $products[$i]['id'] = $shop['id'];
                $products[$i]['title'] = $shop['title'];
                $products[$i]['price'] = $shop['price'];
                $i++;
            }
        }
        return $products;
    }
}
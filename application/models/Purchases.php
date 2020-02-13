<?php

namespace application\models;

use application\core\Model;
use PDO;
class Purchases extends Model {
    function addPurchases($orderId,$cart){
        $sql = "INSERT INTO `purchase` (`order_id`, `product_id`,`price`,`amount`) VALUES(:order_id, :product_id,:price,:amount)";
        $stmt=$this->db->prepare($sql);

        foreach ($cart as $item){
            $stmt->bindParam(':order_id', $orderId,PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $item['id'],PDO::PARAM_INT);
            $stmt->bindParam(':price', $item['price'],PDO::PARAM_INT);
            $stmt->bindParam(':amount', $item['cnt'],PDO::PARAM_INT);
            $stmt->execute();
        }
        return true;
    }
}
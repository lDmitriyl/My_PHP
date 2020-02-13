<?php

namespace application\models;

use application\core\Model;
use PDO;

class Insta extends Model{
    public function inst($error, $from, $fullPath, $message){
        if (!$error) {
            if (move_uploaded_file($from, $fullPath)) {
                $sql = "INSERT INTO `insta` (`body`, `path`) VALUES(:message, :fullPath)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':message', $message, PDO::PARAM_STR);
                $stmt->bindParam(':fullPath', $fullPath);
                if($stmt->execute()) {
                    $_SESSION['success']='Пост добавлен';
                    header('location:/insta/index');
                    exit();
                }
            }
        }
    }

    function content($limit, $notesofpage){
        $images=[];
        $stmt = $this->db->prepare('SELECT `id`,`body`,`path`,`time` FROM insta  ORDER BY `id` DESC LIMIT :limit,:notesofpage');
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':notesofpage', $notesofpage, PDO::PARAM_INT);
        if($stmt->execute()) {
            $i = 0;
            while ($img = $stmt->fetch()) {
                $images[$i]['id'] = $img['id'];
                $images[$i]['body'] = $img['body'];
                $images[$i]['path'] = $img['path'];
                $images[$i]['time'] = $img['time'];
                $i++;
            }
        }
        return $images;
    }

    function comment(){
        $arr = [];
        $stmt = $this->db->prepare("SELECT insta.id, COUNT(comments.id) as comment FROM insta LEFT JOIN comments ON insta.id=comments.com_id GROUP BY insta.id");

        if($stmt->execute()) {
            while ($res = $stmt->fetch())
                $arr[] = $res;
        }
        return $arr;
    }

    function countContent(){
        $sql = "SELECT COUNT(*) as count FROM insta";
        $res = $this->db->query($sql);
        return $result = $res->fetch()['count'];
    }
}
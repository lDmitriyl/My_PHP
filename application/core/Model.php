<?php

namespace application\core;

use application\config\Db;

class Model
{
    public $db;

    public function __construct() {
        $this->db = Db::dbconnect();
    }

    public function loadFile($filename,$localPath){
        $maxSize=2*1024*1024;

        $extenstion=pathinfo($_FILES['filename']['name'],PATHINFO_EXTENSION);
        $file=pathinfo($filename);
        if($extenstion != $file['extension']) return false;

        $newFileName=$file['filename'].'_'.time().'.'.$file['extension'];

        if($_FILES['filename']['size']>$maxSize) return false;

        $path=$_SERVER['DOCUMENT_ROOT'].$localPath;
        if(!file_exists($path)){
            mkdir($path);
        }

        if(is_uploaded_file($_FILES['filename']['tmp_name'])){
            $res=move_uploaded_file($_FILES['filename']['tmp_name'],$path.$newFileName);
            return ($res == true)?$newFileName:false;
        }else{
            return false;
        }
    }

}
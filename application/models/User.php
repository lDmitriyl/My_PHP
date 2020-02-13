<?php

namespace application\models;

use application\core\Model;
use PDO;

class User extends Model {
    public $title="Ваши регистрационные данные";
    function checkParams($email,$pwd1,$pwd2){
        $rs=null;
        if(!$email){
            $rs['success']=false;
            $rs['message']='Введите email';
            return $rs;
        }
        if(!$pwd1){
            $rs['success']=false;
            $rs['message']='Введите пароль';
            return $rs;
        }
        if(!$pwd2){
            $rs['success']=false;
            $rs['message']='Введите повтор пароля';
            return $rs;
        }
        if($pwd1 != $pwd2){
            $rs['success']=false;
            $rs['message']='Пароли не совпадают';
            return $rs;
        }
        return $rs;

    }
    function checkEmail($email)
    {
        $statement = $this->db->prepare('SELECT `id` FROM `users` WHERE email = :email LIMIT 1');
        $statement->bindParam(':email',$email);
        $statement->execute();
        $result = $statement->fetchAll();
        if($result){
            return 1;
        }else{
            return false;
        }
    }
    function registerNewUser($email,$pwd,$name,$phone,$address){
        $sql="INSERT INTO `users` (`email`,`pwd`,`name`,`phone`,`address`)
              VALUES (:email,:pwd,:name,:phone,:address)";
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':pwd',$pwd,PDO::PARAM_STR);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
        $stmt->bindParam(':address',$address,PDO::PARAM_STR);
        if($stmt->execute()){
         $statement = $this->db->prepare("SELECT `id`,`email`,`pwd`,`name`,`phone`,`address` FROM `users`
                  WHERE `email` = :email and `pwd`=:pwd");
            $statement->bindParam(':email' , $email);
            $statement->bindParam(':pwd' , $pwd);
            $statement->execute();
            $result=$statement->fetchAll();
            if(isset($result[0])){
                $result['success']=1;
            }else{
                $result['success']=0;
            }
        }else{
            $result['success']=0;
        }
        return $result;
    }

    function checkLogin($email,$pwd){
        $pwd=md5($pwd);
        $stmt=$this->db->prepare('SELECT `id`,`email`,`pwd`,`name`,`phone`,`address` FROM `users`
                                      WHERE email = :email and pwd=:pwd');
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':pwd',$pwd,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(isset($result[0])){
            $result['success']=1;
        }else{
            $result['success']=0;
        }
        return $result;
    }

    function updateUser($name,$phone,$address,$pwd1,$pwd2,$curPwd){
        $email=$_SESSION['user']['email'];
        $pwd1=trim($pwd1);
        $pwd2=trim($pwd2);
        $newPwd=null;
        if($pwd1 && $pwd1==$pwd2){
            $newPwd=md5($pwd1);
        }
        if(!$pwd1 || !$pwd2){
            $newPwd=$curPwd;
        }
        $stmt = $this->db->prepare("UPDATE users SET name = :name,phone=:phone,address=:address,pwd=:pwd 
                                        WHERE email=:email and pwd=:curPwd LIMIT 1");
        $stmt->bindParam(':name', $name,PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone,PDO::PARAM_STR);
        $stmt->bindParam(':address', $address,PDO::PARAM_STR);
        $stmt->bindParam(':pwd', $newPwd,PDO::PARAM_STR);
        $stmt->bindParam(':email', $email,PDO::PARAM_STR);
        $stmt->bindParam(':curPwd', $curPwd,PDO::PARAM_STR);
        $res=$stmt->execute();
        if($res){
            return 1;
        }else{
            return false;
        }
    }
}
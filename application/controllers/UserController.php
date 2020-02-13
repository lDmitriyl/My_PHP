<?php

namespace application\controllers;

use application\core\Controller;

class UserController extends Controller {


    function registerAction() {

        $email=isset($_POST['email'])?$_POST['email']:null;
        $email=trim($email);

        $pwd1=isset($_POST['pwd1'])?$_POST['pwd1']:null;
        $pwd2=isset($_POST['pwd2'])?$_POST['pwd2']:null;

        $phone=isset($_POST['phone'])?$_POST['phone']:null;
        $address=isset($_POST['address'])?$_POST['address']:null;
        $name=isset($_POST['name'])?$_POST['name']:null;

        $resData=null;

        $resData=$this->view->checkParams($email,$pwd1,$pwd2);

        if(!$resData&&$this->view->checkEmail($email)){
            $resData['success']=false;
            $resData['message']="Пользователь с таким $email уже зарегестрирован";
        }

        if(!$resData){
            $pwdMD5=md5($pwd1);

            $userData=$this->view->registerNewUser($email,$pwdMD5,$name,$phone,$address);

            if($userData['success']){
                $resData['message']="Пользователь успешно зарегестрирован";
                $resData['success']=1;
                $userData=$userData[0];
                $resData['userName']= $userData['name']?$userData['name']:$userData['email'];
                $resData['userEmail']=$userData['email'];

                $_SESSION['user']=$userData;
                $_SESSION['user']['displayName']=$resData['userName'];
            }else{
                $resData['message']="Ошибка при регистрации";
                $resData['success']=0;
            }
        }
        echo json_encode($resData);

    }

    function logoutAction(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
            unset($_SESSION['cart']);
            header("Location:/");
            exit;
        }
    }

    function loginAction(){
        $email=isset($_POST['loginEmail'])?$_POST['loginEmail']:null;
        $email=trim($email);

        $pwd1=isset($_POST['loginPwd'])?$_POST['loginPwd']:null;
        $pwd1=trim($pwd1);

        $userData=$this->view->checkLogin($email,$pwd1);
        if($userData['success']){

            $userData=$userData[0];
            $resData['userName']= $userData['name']?$userData['name']:$userData['email'];
            $_SESSION['user']=$userData;
            $_SESSION['user']['displayName']=$resData['userName'];
            $resData['success']=1;
        }else{
            $resData['success']=0;
            $resData['message']="Неверный логин или пароль";
        }
        echo json_encode($resData);
    }

    function updateAction(){
        $resData=array();
        $name=isset($_POST['newName'])?$_POST['newName']:null;
        $address=isset($_POST['newAddress'])?$_POST['newAddress']:null;
        $phone=isset($_POST['newPhone'])?$_POST['newPhone']:null;
        $pwd1=isset($_POST['newPwd1'])?$_POST['newPwd1']:null;
        $pwd2=isset($_POST['newPwd2'])?$_POST['newPwd2']:null;
        $curPwd=isset($_POST['curPwd'])?$_POST['curPwd']:null;

        $curPwdMD5=md5($curPwd);
        if(!$curPwd || $_SESSION['user']['pwd'] !=$curPwdMD5){
            $resData['success']=0;
            $resData['message']='Текущий пароль не верный';
            echo json_encode($resData);
            return false;
        }
        $res=$this->view->updateUser($name,$phone,$address,$pwd1,$pwd2,$curPwdMD5);
        if($res){
            $resData['success']=1;
            $resData['message']='Данные сохранены';
            $resData['name']=$name;

            $_SESSION['user']['name']=$name;
            $_SESSION['user']['phone']=$phone;
            $_SESSION['user']['address']=$address;
            $newPwd=$_SESSION['user']['pwd'];
            if($pwd1 && $pwd1==$pwd2){
                $newPwd=md5($pwd1);
            }
            $_SESSION['user']['pwd']=$newPwd;
            $_SESSION['user']['displayName']=$name?$name:$_SESSION['user']['email'];
        }else{
            $resData['success']=0;
            $resData['message']='Ошибка сохранения данных';
        }
        echo json_encode($resData);
    }
    
    public function indexAction() {

        echo $this->render('user_view.php', 'template_view.php');
    }
}

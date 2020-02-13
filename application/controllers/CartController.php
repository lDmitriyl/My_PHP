<?php

namespace application\controllers;

use application\core\Controller;
use application\models\Orders;
use application\models\Purchases;

class CartController extends Controller{

    //добавление в корзину
    public function addtocartAction() {
        $params=$this->params['prod'];

        $itemId=isset($params)?intval($params):null;
        if(!$itemId) return false;
        if(isset($_SESSION['cart'])&&array_search($itemId,$_SESSION['cart'])===false){
            $_SESSION['cart'][]=$itemId;
            $resData['cntItems']=count($_SESSION['cart']);
            $resData['success']=1;
        }else{
            $resData['success']=0;
        }
        echo json_encode($resData);
    }
    //удаление из корзины
    public function removetocartAction() {
        $this->params=$this->params['prod'];
        $itemId=isset($this->params)?intval($this->params):null;
        if(!$itemId) return false;
        $key=array_search($itemId,$_SESSION['cart']);
        if($key!==false){
            unset($_SESSION['cart'][$key]);
            $resData['cntItems']=count($_SESSION['cart']);
            $resData['success']=1;
        }else{
            $resData['success']=0;
        }
        echo json_encode($resData);
    }
    //отображение корзины
    public function indexAction() {
        $itemsId=isset($_SESSION['cart'])?$_SESSION['cart']:array();


        $goods=$this->view->showCart($itemsId);

        echo $this->render('cart_view.php', 'template_view.php',['goods'=>$goods]);
    }

    public function orderAction() {
        $itemsId=isset($_SESSION['cart'])?$_SESSION['cart']:null;
        if(!$itemsId){
            header("Location:/cart/");
            exit;
        }
        // получаем  массив из id товара и его количество
        $itemsCnt=array();
        foreach ($itemsId as $item){
            $postItem='item_'.$item;
            $itemsCnt[$item]=isset($_POST[$postItem])?$_POST[$postItem]:null;
        }
        $rsProducts=$this->view->getProducts($itemsId);
        // добавляем каждому продукту 2 поля кол-во и общую цену
        $i=0;
        foreach ($rsProducts as &$item){
            $item['cnt']=isset($itemsCnt[$item['id']])?$itemsCnt[$item['id']]:0;
            if($item['cnt']){
                $item['realPrice']=$item['cnt']*$item['price'];
            }else{
                unset ($rsProducts[$i]);
            }
            $i++;
        }
        if(!$rsProducts){
            echo "Корзина пустая";
            return;
        }
        $_SESSION['saleCart']=$rsProducts;

        echo $this->render('cart_order_view.php', 'template_view.php',$rsProducts);
    }
    
    public function saveorderAction() {
        $resData=array();
        $resData['success']=1;
        $view = new Orders();
        $view1=new Purchases();
        $cart=isset($_SESSION['saleCart'])?$_SESSION['saleCart']:null;

        if(!$cart){
            $resData['success']=0;
            $resData['message']="Нет товаро для заказа";
            echo json_encode($resData);
            return;
        }
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];

        $orderId=$view->makeNewOrder($name,$phone,$address);

        if(!$orderId){
            $resData['success']=0;
            $resData['message']="Ошибка создания заказа";
            echo json_encode($resData);
            return;
        }

        $res=$view1->addPurchases($orderId,$cart);

        if($res){
            $resData['success']=1;
            $resData['message']="Заказ сохранён";
            unset($_SESSION['cart']);
            unset($_SESSION['saleCart']);
        }else{
            $resData['success']=0;
            $resData['message']="Ошибка внесения данных для заказа №".$orderId;
        }
        echo json_encode($resData);
    }
}

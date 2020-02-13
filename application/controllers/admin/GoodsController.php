<?php
namespace application\controllers\admin;

use application\core\Controller;

class GoodsController extends Controller
{
    public function indexAction(){
        $title='Раздел товаров';
        $goods=$this->view->selectGoods();

        echo $this->render('goods_view.php', 'adminka_view.php',['title'=>$title,'goods'=>$goods]);
    }

    public function addAction(){
        $title = 'Добавлене товара';
        if ($this->isPost()) {
            $name = !empty($_POST['title']) ? $_POST['title'] : null;
            $price = !empty($_POST['price']) ? $_POST['price'] : null;
            $this->view->addGoods($name, $price);
        }
        echo $this->render('addGoods_view.php', 'adminka_view.php', ['title' => $title]);
    }

    public function deleteAction(){
        if ($this->isPost()) {
            $id = !empty($_POST['id']) ? $_POST['id'] : null;
            $this->view->deleteGoods($id);
        }
    }

    public function editAction(){
        $title='Редактирование товара';
        $id=$this->params['id'];
        $good=$this->view->goods($id);
        if($this->isPost()){
            $id = !empty($_POST['id']) ? $_POST['id'] : null;
            $name = !empty($_POST['title']) ? $_POST['title'] : null;
            $price = !empty($_POST['price']) ? $_POST['price'] : null;
            $this->view->editGoods($id,$name,$price);
        }
        echo $this->render('editGoods_view.php', 'adminka_view.php',['title'=>$title,'goods'=>$good]);
    }

    public function saveInXMLAction(){
        $goods=$this->view->selectGoods();

        $xml=new \DOMDocument('1.0','utf-8');

        $xmlGoods=$xml->appendChild($xml->createElement('Goods'));
        foreach ($goods as $good){
            $xmlGood=$xmlGoods->appendChild($xml->createElement('Good'));
            foreach($good as $key=>$value){
                $XMLName=$xmlGood->appendChild($xml->createElement($key));
                $XMLName->appendChild($xml->createTextNode($value));
            }
        }
        $xml->save('xml/products.xml');
        echo 'ok';
    }

}
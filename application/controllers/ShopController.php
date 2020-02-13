<?php

namespace application\controllers;

use application\core\Controller;

class ShopController extends Controller {


    public function indexAction() {

        $title='Магазин';
        $goods=$this->view->catalog();
        echo $this->render('shop_view.php', 'template_view.php',['goods'=>$goods,'title'=>$title]);
        
    }
}

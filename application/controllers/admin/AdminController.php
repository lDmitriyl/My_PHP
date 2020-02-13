<?php
namespace application\controllers\admin;

use application\core\Controller;

class AdminController extends Controller{
    
    public function indexAction() {
        $title='Админка';
        echo $this->render('admin_view.php', 'adminka_view.php',['title'=>$title]);
    }
}
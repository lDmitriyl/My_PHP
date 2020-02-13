<?php
namespace application\controllers\admin;

use application\core\Controller;

class MenuController extends Controller
{
    public function indexAction() {
        $title='Раздел меню';
        $menu=$this->view->selectMenu();

        echo $this->render('menu_view.php', 'adminka_view.php',['title'=>$title,'menus'=>$menu]);
    }

    public function addAction(){
        $title='Добавлене пункта меню';
        if($this->isPost()) {
            $name = !empty($_POST['title']) ? $_POST['title'] : null;
            $path = !empty($_POST['path']) ? $_POST['path'] : null;
            $this->view->addMenu($name,$path);
        }
        echo $this->render('addMenu_view.php', 'adminka_view.php',['title'=>$title]);

    }

    public function deleteAction(){
        if($this->isPost()) {
            $id = !empty($_POST['id']) ? $_POST['id'] : null;
            $this->view->deleteMenu($id);
        }

    }
    public function editAction(){
        $title='Редактирование пункта меню';
        $id=$this->params['id'];
        $menu=$this->view->Menu($id);
        if($this->isPost()){
            $id = !empty($_POST['id']) ? $_POST['id'] : null;
            $name = !empty($_POST['title']) ? $_POST['title'] : null;
            $path = !empty($_POST['path']) ? $_POST['path'] : null;
            $this->view->editMenu($id,$name,$path);
        }
        echo $this->render('editMenu_view.php', 'adminka_view.php',['title'=>$title,'menu'=>$menu]);
    }
}
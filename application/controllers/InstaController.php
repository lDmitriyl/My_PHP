<?php

namespace application\controllers;

use application\core\Controller;

class InstaController extends Controller {

    public function indexAction() {
        $title = "Инстаграмм";
        $page=isset($this->params['page'])?$this->params['page']:1;
        if($this->isPost()){
            $message    = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
            $fileName   = uniqid().$_FILES['img']['name'];
            $from       = $_FILES['img']['tmp_name'];
            $error      = $_FILES['img']['error'];
            $instaFolder='insta';
            $fullPath   = $instaFolder. '/' . $fileName;
            $this->view->Inst($error, $from ,$fullPath , $message);
        }

        //отображение контента с пагинацией
        $notesOfPage=3;
        $limit=($page-1)*$notesOfPage;
        $content=$this->view->content($limit,$notesOfPage);
        $count=$this->view->countContent();
        $pagesCount=ceil($count/$notesOfPage);

        $comment=$this->view->comment();//отображение коментариев

        echo $this->render('insta_view.php', 'template_view.php',['content'=>$content,'page'=>$page,'pagesCount'=>$pagesCount,'comment'=>$comment,'title'=>$title]);
    }
}
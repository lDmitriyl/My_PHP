<?php

namespace application\controllers;

use application\core\Controller;

class CommentController extends Controller {

    public function indexAction() {
        $error=null;
        $title='Комментарии';
        $params=$this->params['num'];

        if($this->isPost()){
            $comment = !empty($_POST['body']) ? $_POST['body'] : null;
            $id=$_POST['id'];
            $error=$this->view->checkParams($comment);
            if(!$error) {
                $this->view->comment($id, $comment);
            }
        }

        $comments=$this->view->selectComments($params);
        echo $this->render('comment_view.php', 'template_view.php',  ['params'=>$params,'title'=>$title,'comments'=>$comments,'error'=>$error]);

    }
}

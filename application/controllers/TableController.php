<?php

namespace application\controllers;

use application\core\Controller;

class TableController extends Controller {
    public $cols;
    public $rows;
    public $color;
public function indexAction() {
    $title = "Таблица умножения";
    if($this->isPost()){
        $this->cols=(int)filter_input(INPUT_POST, 'cols', FILTER_SANITIZE_NUMBER_INT);
        $this->rows=(int)filter_input(INPUT_POST, 'rows', FILTER_SANITIZE_NUMBER_INT);
        $this->color=$_POST['color'];
    }

    $table=$this->view->drawTable($this->rows, $this->cols, $this->color);
    echo $this->render('table_view.php', 'template_view.php',['table'=>$table,'title'=>$title]);
    }
}

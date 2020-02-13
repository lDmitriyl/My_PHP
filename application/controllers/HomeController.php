<?php

namespace application\controllers;

use application\core\Controller;

class HomeController extends Controller {


  public function indexAction() {

    echo $this->render('index_view.php', 'template_view.php',['slider'=>1]);

  }
}

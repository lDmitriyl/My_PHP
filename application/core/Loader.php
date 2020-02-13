<?php

class Loader
{
    public $i=4;

 public function loadClass($class){
    $arr=explode('\\',$class);
    print_r($arr);exit;
 }

}
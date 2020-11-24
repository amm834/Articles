<?php
/**
* @BaseController extends this from all child controllers
*/
class BaseController
{
  // Not Allow To Override From Other Class
  final protected function view($file,$data = []) {
    $path = realpath(__DIR__.'/../../');
    require_once $path.'/app/views/'.$file.'.php';
  }

  final protected function model($model) {
    $path = realpath(__DIR__.'/../../');
    require_once $path.'/app/models/'.ucfirst($model).'.php';
    return new $model;
  }

}
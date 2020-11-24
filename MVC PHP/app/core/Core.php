<?php

/**
* Core PHP Route
*/
class Core
{
  private $class_name = "Home";
  private $method_name = "index";
  private $params = [];

  public function __construct() {
    $this->getRoute();
  }
  public function getRoute() {

    // Root Path Of Project
    $path = realpath(__DIR__.'/../../');
    $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : "";
    $url = explode('/', $url);
    if (!empty($url[0])) {
      if (file_exists($path.'/app/controllers/'.ucfirst($url[0]).'.php')) {
        $this->class_name = ucfirst($url[0]);
        unset($url[0]);
      }
    }
    require_once $path.'/app/controllers/'.$this->class_name.".php";
    
  //  $this->class_name = new $this->class_name;

    if (!empty($url[1])) {
      if (method_exists($this->class_name, strtolower($url[1]))) {
        $this->method_name = strtolower($url[1]);
        unset($url[1]);
      }
    }
    $this->params = array_values($url) ?? [];
    call_user_func_array([new $this->class_name, $this->method_name], $this->params);
  }
} dell
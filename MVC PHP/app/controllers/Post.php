<?php

class Post extends BaseController
{

  public function index() {
   $db = $this->model("PostModel");
   $data['users'] = $db->getUsers();
    $this->view('Post',$data);
  }
  
}
<?php

/**
* Home Controller @default
* @extends app/libs/BaseController.php
*/
class Home extends BaseController
{

  /**
  *@default index 
  */
  public function index() {
    $data['names'] = ['Aung Myat Moe','Noose Si'];
      $this->view('Home',$data);
  }

}
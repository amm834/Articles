<?php

/**
 * Post Model
 */
class PostModel extends DB
{
  public function getUsers(){
    $this->query("select * from users");
    return $this->multiSet();
  }
}
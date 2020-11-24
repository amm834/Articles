<?php
ob_start();// Start Output Buffering To Prevent Session And Cookies Conflicts
session_start();

// Get Root Of Project Path
define("URL_ROOT",realpath(__DIR__.'/../'));

// Autoload File By ClassName
spl_autoload_register(function ($className){
  require_once URL_ROOT.'/app/core/'.$className.'.php';
});

// Invoke Class Core
new Core();
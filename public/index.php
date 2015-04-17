<?php

//定义Root path
define("ROOT_PATH",str_replace("\\","/",dirname(dirname(__FILE__))));

define("BASE_PATH",ROOT_PATH.'/public');

define("APP_PATH",ROOT_PATH.'/App/');



require_once ROOT_PATH . '/vendor/autoload.php';

$App = new \Elegant\Core\App();

$App->Run();

$App->Dispatch();
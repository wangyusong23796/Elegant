<?php

require_once __DIR__ . '/../vendor/autoload.php';

$App = new \Elegant\Core\App();
$App->Run();
$App->Dispatch();
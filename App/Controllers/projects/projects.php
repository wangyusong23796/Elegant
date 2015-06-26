<?php

use App\Model\Article;
use Elegant\Model\DB;
use Elegant\Cache\Cache;
use Elegant\Core\App;


$this->respond('GET',function ($request, $response) {
	
        echo '相当于get的构造函数';
});

$this->respond('GET', '/index', function ($request, $response) {
	
        echo 'index';
});


$this->respond('GET', '/say', function ($request, $response, $service, $app){

	//注册db
	App::RegDb();
	
	// Show a single user
	$service->title = 'foo';
	

	$service->article = DB::table('articles')->find(5);
	

	$service->escape = function ($str) {
		return htmlentities($str); // Assign view helpers
	};
	
	
	$service->render('test.php');
});

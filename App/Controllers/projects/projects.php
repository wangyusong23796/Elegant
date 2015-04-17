<?php

use App\Model\Article;
use Elegant\Model\DB;
use Elegant\Cache\Cache;


$this->respond('GET', '/index', function ($request, $response) {
	
        echo 'index';
});


$this->respond('GET', '/say', function ($request, $response, $service, $app){
	
	
	// Show a single user
	$service->title = 'foo';
	

	$service->article = DB::table('articles')->find(5);
	

	$service->escape = function ($str) {
		return htmlentities($str); // Assign view helpers
	};
	
	
	$service->render('test.php');
});

<?php

use App\Models\Article;
use Eg\Model\DB;
use Eg\Cache\Cache;
use Eg\Core\App;
use Eg\View\View;


$this->respond('GET', '/index', function ($request, $response) {

        echo 'index';
});
$this->respond('POST', '/index', function ($request, $response) {

     echo "ok";
});

$this->respond('GET', '/say', function ($request, $response, $service, $app){

	//注册db
	App::RegDb();
	Cache::Run('File');
	if(!Cache::Get("article"))
		Cache::Set("article",DB::table('articles')->get(),3600);





	return View::make('test',['article'=>Cache::Get("article")]);
});

<?php

use App\Models\Article;
use Elegant\Model\DB;
use Elegant\Cache\Cache;
use Elegant\Core\App;
use Elegant\View\View;


$this->respond('GET', '/index', function ($request, $response) {
	
        echo 'index';
});


$this->respond('GET', '/say', function ($request, $response, $service, $app){

	//注册db
	App::RegDb();
	Cache::Run('File');
	if(!Cache::Get("article"))
		Cache::Set("article",DB::table('articles')->get(),3600);





	return View::make('test',['article'=>Cache::Get("article")]);
});

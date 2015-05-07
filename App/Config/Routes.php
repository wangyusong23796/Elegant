<?php


$Mid->pipe('/', function ($req, $res, $next) {
	if ($req->getUri()->getPath() !== '/') {
	    return $next($req, $res);
	}
    return $res->end('Hello world!');
});

$Route->get('/',function(){

	//new test();
	die('hi');
});


foreach(['projects'] as $controller) {
	
	//TODO 读取配置文件,判断controller 目录是否修改
	$Route->with("/$controller", APP_PATH."/Controllers/".$controller."/".$controller.".php");
};


$Route->onHttpError(function(){
	 	throw new Exception("路由无匹配项 404 Not Found");
});
<?php





$Route->get('/',function($request, $response, $service, $app){



	return Elegant\View\View::make('index');
});
$Route->post('/',function($request, $response, $service, $app){


	
	
});


foreach(['projects'] as $controller) {
	
	//TODO 读取配置文件,判断controller 目录是否修改
	$Route->with("/$controller", APP_PATH."/Controllers/".$controller."/".$controller.".php");
};



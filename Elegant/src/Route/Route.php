<?php  namespace Elegant\Route;



class Route extends \Klein\Klein{

	public function __construct(){
		parent::__construct();
	}


	public function middleware($middleware)
	{
		//use Symfony\Component\HttpFoundation\Request;
		$class = new $middleware(\Symfony\Component\HttpFoundation\Request::createFromGlobals());
		$class->call();
	}


	public function DispatchRoute()
	{
		$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
		//TODO 判断是否开启缓存

		//TODO 读取缓存时间 判断是否过期..

		$filename = base64_encode($request->getPathInfo().'/'.$request->getMethod());
		$filepath = ROOT_PATH.'/Cache/views/'.$filename.".html";
		if(is_file($filepath))
		{
			$html = fopen($filepath, "r") or die("Unable to open file!");
			$text = fread($html,filesize($filepath));
			echo $text;
			fclose($html);
			
		}else{
			ob_start();
			$this->dispatch();
			$file =  ob_get_contents();
			$html = fopen($filepath, "w") or die("Unable to open file!");
			fwrite($html, $file);
			fclose($html);

		}
				// ob_start(),ob_get_contents(),flush()或ob_flush()
		//TODO 加密pathinfo  判断本地文件是否过期,如果过期执行方法.未过期显示本地文件.

		

	}




	public function cache()
	{
		$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
		//TODO 判断是否开启缓存

		//TODO 读取缓存时间 判断是否过期..

		$filename = base64_encode($request->getPathInfo().'/'.$request->getMethod());
		$filepath = ROOT_PATH.'/Cache/views/'.$filename.".html";
		if(is_file($filepath))
		{
			$html = fopen($filepath, "r") or die("Unable to open file!");
			$text = fread($html,filesize($filepath));
			fclose($html);
			echo $text;
			die();
			
		}
	}

}
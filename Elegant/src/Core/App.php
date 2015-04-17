<?php  namespace Elegant\Core;

use Illuminate\Database\Capsule\Manager as database;


class App{


	protected $Route;



	function __construct(){
		//TODO 构造其他方法.
		$this->Route = new \Elegant\Route\Route();
		
		//注册构造函数
		//TODO 判断是否是调试模式.调试模式注册异常类
		$whoops = new \Whoops\Run;
		$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
		$whoops->register();
		
		//TODO 读取公共配置文件目录及目录名称
		
		$capsule = new database;
		$capsule->addConnection(require APP_PATH.'/Config/Database.php');
		$capsule->bootEloquent();
		$capsule->setAsGlobal();
		
		$this->Route->onHttpError(function(){
// 			throw new Exception("路由无匹配项 404 Not Found");
		});
		//TODO 读取控制器之前的钩子
	}




	public function Run()
	{
		// TODO 读取配置 判断当前routes.php 文件路径
		//TODO 读取钩子.

		//将Route改变别名..引用
		$Route = & $this->Route;

		include APP_PATH.'/Config/Routes.php';
		
		

	}



	public function Dispatch()
	{
		// TODO 读取当前Route并display
		//TODO 读取钩子.
		
		

		$this->Route->dispatch();
		//TODO 读取控制器之后的钩子.
	}
}



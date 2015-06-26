<?php  namespace Elegant\Core;

use Illuminate\Database\Capsule\Manager as database;
use Elegant\Helper\Helper;

class App{


	protected $Route;
	static $classMap;


	function __construct(){
		//TODO 构造其他方法.
		$this->Route = new \Elegant\Route\Route();



		
		//根据配置文件判断是否开启调试
		if(Helper::config('debug')==true)
			self::RegViewError();
		if(Helper::config('autoload')==true){
			self::$classMap = include(APP_PATH.'/Config/autoload.php');
			spl_autoload_register([$this,"Regautoload"], true, true);
		}

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



	public static function RegDb($configpath=NULL)
	{
		$path = '';
		if($configpath == NULL)
		{
			$path = APP_PATH.'/Config/Database.php';
		}else{
			$path = ROOT_PATH.$configpath;
		}
		 $capsule = new database;
		 $capsule->addConnection(require $path);
		 $capsule->bootEloquent();
		 $capsule->setAsGlobal();
	}




	public static function RegViewError()
	{
		//注册构造函数
		//TODO 判断是否是调试模式.调试模式注册异常类
		$whoops = new \Whoops\Run;
		$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
		$whoops->register();
	}



	public function Regautoload($className)
	{

		if (isset(static::$classMap[$className])){
			$classFile = static::$classMap[$className];
		}else{
			return;
		}

		include($classFile);
		if (YII_DEBUG && !class_exists($className, false) &&
			!interface_exists($className, false) && !trait_exists($className,
			false)) {
			throw new UnknownClassException("Unable to find '$className' in file: $classFile. Namespace missing?");
		}
	}



}



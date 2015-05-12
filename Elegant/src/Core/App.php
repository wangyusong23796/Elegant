<?php  namespace Eg\Core;

use Illuminate\Database\Capsule\Manager as database;
use Eg\Helper\Helper;
use Phly\Http\Server;
class App{


	protected $Route;
	protected $server;
	static $classMap;
	static $Middleware;
	function __construct(){
		//TODO 构造其他方法.
		//判断是否存在缓存

		$this->Route = new \Eg\Route\Route();

		//TODO 缓存
		//$this->Route->cache();

		//TODO 优化配置只取一次.
		$config = Helper::config(NULL,"App");
		
		//根据配置文件判断是否开启调试
		if($config['debug']==true)
			self::RegViewError();
		//注册自动加载类
		if($config['autoload']==true){
			self::$classMap = include(APP_PATH.'/Config/autoload.php');
			self::$classMap = include(APP_PATH.'/Config/Middleware.php');

			spl_autoload_register([$this,"Regautoload"], true, true);
		}
		//注册自动加载中间件
		 if($config['automiddleware']==true)
		 	$this->RegMiddleware();

		
		//注册视图路径
		if($config['view']==true)
			\duncan3dc\Helpers\Env::usePath(ROOT_PATH);
		
	}




	public function Run()
	{
		// TODO 读取配置 判断当前routes.php 文件路径
		//TODO 读取钩子.

		//将Route改变别名..引用
		$Route = & $this->Route;


		include APP_PATH.'/Config/Routes.php';

		$Route->onHttpError(function(){
	 		throw new \Exception("路由无匹配项 404 Not Found");
		});

	}



	public function Dispatch()
	{
		// TODO 读取当前Route并display
		//TODO 读取钩子.
		//TODO 判断页面是否已经缓存.
		//TODO 缓存则显示缓存不然pispathc

		$this->Route->dispatch();

		// ob_get_contents(),flush()或ob_flush()
		//TODO 读取控制器之后的钩子.
		//将缓冲区保存为文件

		
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
		if (!class_exists($className, false) &&
			!interface_exists($className, false) && !trait_exists($className,
			false)) {
			throw new UnknownClassException("Unable to find '$className' in file: $classFile. Namespace missing?");
		}
	}

	//自动加载中间件
	public function RegMiddleware()
	{
		//开启中间件

		@session_start();
		$middleware = Helper::config(NULL,'automiddleware');
		foreach ($middleware as $key) {
			# code...
			$this->Route->middleware($key);
		}

		
	}

	//TODO 注册其他视图的实现
	public function RegView()
	{
		

	}

}



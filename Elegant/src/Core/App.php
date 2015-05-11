<?php  namespace Elegant\Core;

use Illuminate\Database\Capsule\Manager as database;
use Elegant\Helper\Helper;
use Phly\Http\Server;
class App{


	protected $Route;
	protected $server;
	static $classMap;
	static $Middleware;
	function __construct(){
		//TODO 构造其他方法.
		$this->Route = new \Elegant\Route\Route();


		//TODO 优化配置只取一次.
		
		//根据配置文件判断是否开启调试
		if(Helper::config('debug')==true)
			self::RegViewError();
		//注册自动加载类
		if(Helper::config('autoload')==true){
			self::$classMap = include(APP_PATH.'/Config/autoload.php');
			self::$classMap = include(APP_PATH.'/Config/Middleware.php');
			spl_autoload_register([$this,"Regautoload"], true, true);
		}
		//注册中间件
		if(Helper::config('middleware')==true)
			$this->RegMiddleware();
		//注册视图路径
		if(Helper::config('view')==true)
			\duncan3dc\Helpers\Env::usePath(ROOT_PATH);
		
	}




	public function Run()
	{
		// TODO 读取配置 判断当前routes.php 文件路径
		//TODO 读取钩子.

		//将Route改变别名..引用
		$Route = & $this->Route;

		//        self::$Middleware->add(new \Slim\Middleware\ContentNegotiation());
		include APP_PATH.'/Config/Routes.php';

	}



	public function Dispatch()
	{
		// TODO 读取当前Route并display
		//TODO 读取钩子.
		//读取中间件
		if(!empty(self::$Middleware))
			self::$Middleware->run();
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

	public function RegMiddleware()
	{
		//开启中间件

      	
	}

	//TODO 注册其他视图的实现
	public function RegView()
	{
		

	}

}



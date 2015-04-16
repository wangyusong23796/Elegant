<?php  namespace Elegant\Core;


class App{


	protected $Route;



	function __construct(){
		//TODO 构造其他方法.
		$this->Route = new \Elegant\Route\Route();
	}




	public function Run()
	{
		// TODO 读取配置 判断当前routes.php 文件路径
		//TODO 读取钩子.

		//将Route改变别名..引用
		$Route = & $this->Route;

		include 'routes.php';
	}



	public function Dispatch()
	{
		// TODO 读取当前Route并display
		//TODO 读取钩子.
		$this->Route->dispatch();
	}
}



<?php  namespace Elegant\Route;



class Route extends \Klein\Klein{

	public function __construct(){
		parent::__construct();
	}


	public function middleware($middleware)
	{
		$class = new $middleware();

		$class->call(new \Klein\Request());
	}

}
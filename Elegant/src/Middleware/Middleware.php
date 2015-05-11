<?php namespace Elegant\Middleware;


class Middleware{
	protected $Request;

	//TODO 完成中间件相应的功能.
	public function __construct($Request){

		$this->Request = $Request;

		// if(\Elegant\Helper\Helper::config('csrf')==true)
		// {	
		// 	$csrf = new \App\Middleware\Csrf();
		// 	$csrf->call();
		// }

	}


}

?>
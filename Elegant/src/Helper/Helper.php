<?php namespace Elegant\Helper;

class Helper{
	


	public static function config($key,$default=NULL)
	{
		$config = require APP_PATH."/Config/App.php";
		return $config[$key];
	}

}
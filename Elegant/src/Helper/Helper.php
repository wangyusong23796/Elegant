<?php namespace Eg\Helper;

class Helper{
	


	public static function config($key,$default=NULL)
	{
		if($key == NULL)
		{
			$name = $default?$default:"App";
			$config = require APP_PATH."/Config/".$name.".php";
			return $config;
		}else{
			$name = $default?$default:"App";
			$config = require APP_PATH."/Config/".$name.".php";
			return $config[$key];
		}

	}

}
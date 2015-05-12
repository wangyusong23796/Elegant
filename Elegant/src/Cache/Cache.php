<?php namespace Eg\Cache;

use Desarrolla2\Cache\Cache as Desarrolla;
use Desarrolla2\Cache\Adapter\NotCache;
use Desarrolla2\Cache\Adapter\Apc;
use Desarrolla2\Cache\Adapter\Memory;
use Desarrolla2\Cache\Adapter\Mongo;
use Desarrolla2\Cache\Adapter\MySQL;
use Desarrolla2\Cache\Adapter\Redis;
use Desarrolla2\Cache\Adapter\MemCache;



class Cache{
	
	static $che = NULL;
	/**
	*  运行cache 写入配置.
	* @date: 2015-4-17
	* @author: 王玉松 admin@wangyusong.com
	* @return:
	*/
	
	public static function Run($model = NULL,$name = NULL)
	{
		switch ($model){
			case 'File':
				if($name == NULL)
					$name=ROOT_PATH."/Cache/datas";
				$file =new \Desarrolla2\Cache\Adapter\File($name);
				$file->setOption('ttl', 3600);
				self::$che = new Desarrolla($file);
				break;
		}
		
	}
	
	
	
	/**
	*  获取缓存数据
	* @date: 2015-4-17
	* @author: 王玉松 admin@wangyusong.com
	* @return:
	*/
	
	public static function Get($key)
	{
		return self::$che->get($key);
	}
	
	
	
	/**
	*  设置缓存数据
	* @date: 2015-4-17
	* @author: 王玉松 admin@wangyusong.com
	*  $value  == NULL 取消缓存,$time = 0 永久缓存
	* @return: true
	*/
	
	public static function Set($key,$value,$time)
	{
		return self::$che->set($key,$value,$time);
	}
	
	
	
}
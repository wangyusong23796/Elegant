<?php namespace Eg\View;

use duncan3dc\Laravel\Blade;




class View extends Blade
{
	/**
     * @var BladeInstance $instance The internal cache of the BladeInstance to only instantiate it once
     */
    protected static $instance;

    /**
     * Get the BladeInstance object.
     *
     * @return BladeInstance
     */
    protected static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new \Eg\View\BladeInstance();
        }

        return static::$instance;
    }

}



?>
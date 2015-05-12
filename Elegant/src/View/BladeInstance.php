<?php namespace Eg\View;

use duncan3dc\Laravel\Blade;
use duncan3dc\Laravel\BladeInstance as BladeInstanceOld;

class BladeInstance extends BladeInstanceOld{

	public function __construct($path = null, $cache = null)
    {
    	parent::__construct();
        if ($path === null) {
            $path = APP_PATH."/View";
        }
        $this->path = $path;

        if ($cache === null) {
            $cache = ROOT_PATH."/Cache/views";
        }
        $this->cache = $cache;
    }
}
?>
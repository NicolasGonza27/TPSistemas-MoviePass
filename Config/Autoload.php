<?php namespace Config;
	
    class Autoload {
        
        public static function Start() {
            spl_autoload_register(function($className)
			{
                $classPath = ucwords(str_replace("\\", "/", ROOT.$className).".php");
                
                if(explode("\\", $className)[0] != 'MercadoPago')
                {
                    include_once($classPath);
                }
			});
        }
    }
?>
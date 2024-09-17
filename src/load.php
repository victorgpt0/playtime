<?php
function AutoLoad($class){
    $directories=['forms','structure'];
    foreach($directories as $dir){
        $file=dirname(__FILE__).DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$class.'.php';

        if(file_exists($file) and is_readable($file)){
            require $file;
        }
        }
}
spl_autoload_register('AutoLoad');

$ObjLayout = new Layout();
$ObjBody = new Body();
<?php

require 'database/constants.php';
require 'database/dbconnection.php';

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

//db object
//$ObjDbConnection = new Dbconnection(DB_HOSTNAME, DB_PORT, DB_USER, DB_PASS, DB_NAME);

//Use instance below to run queries in your forms
//$conn= $ObjDbConnection->getConnection();

//HTML objects 
$ObjLayout = new Layout();
$ObjBody = new Body();
$ObjForms = new forms();
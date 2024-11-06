<?php
session_start();
require 'database/config.php';
require 'database/constants.php';
require 'database/dbconnection.php';

function AutoLoad($class){
    $directories=['forms','structure','processes','globals','plugins'];
    foreach($directories as $dir){
        $file=dirname(__FILE__).DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$class.'.php';

        if(file_exists($file) and is_readable($file)){
            require $file;
        }
        }
}
spl_autoload_register('AutoLoad');

//google tokens
$google_oauth=new google();

//db object
//$conn = new Dbconnection(DB_HOSTNAME, DB_PORT, DB_USER, DB_PASS, DB_NAME);
$conn=new Dbconnection(DB_HOSTNAME_ALT,DB_PORT_ALT,DB_USER_ALT,DB_PASS_ALT,DB_NAME_ALT);
//HTML objects 
$ObjLayout = new Layout();
$ObjBody = new Body();
$ObjForms = new forms();

//form inputs
$statuses=$conn->select_and('tbl_status',[]);
$facilityType= $conn->select_and('tbl_f_types', []);


//Backend Objects
$ObjGlobal= new globals();
$err=$ObjGlobal->getMsg('f_error');


//processes
$ObjAuth= new auth();
$ObjAuth->signup($conn, $ObjGlobal, $conf);
$ObjAuth->login($conn,$ObjGlobal);
$ObjAuth->role($conn);

$ObjOwner= new owner();
$ObjOwner->facilities($conn,$ObjGlobal);

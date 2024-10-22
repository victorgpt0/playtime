<?php
require 'load.php';

$ObjLayout->head('Login');
$ObjForms->login($ObjGlobal, $client);
$ObjLayout->close_js();
<?php
require 'load.php';

$ObjLayout->head('Login');
$ObjForms->login($ObjGlobal, $google_oauth);
$ObjLayout->close_js();
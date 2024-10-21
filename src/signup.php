<?php
require 'load.php';
$ObjLayout->head('Sign Up');
$ObjForms->signup_form($ObjGlobal, $client);
$ObjLayout->close_js();
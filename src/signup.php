<?php
require 'load.php';
$ObjLayout->head('Sign Up');
$ObjForms->signup_form($ObjGlobal, $google_oauth);
$ObjLayout->close_js();
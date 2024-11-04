<?php
require 'load.php';
$ObjLayout->head_ownerdash('Dashboard');
$ObjLayout->navbar_userdash();
$ObjBody->searchbar();
$ObjBody->captain();
$ObjLayout->close_js();
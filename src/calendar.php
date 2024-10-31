<?php
require 'load.php';
$ObjLayout->head_ownerdash('Calendar');
$ObjLayout->navbar_userdash();
$ObjBody->calendar($client);
$ObjLayout->close_js();
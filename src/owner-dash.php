<?php
   require 'load.php';
    $ObjLayout->head_ownerdash('Dashboard');
    $ObjLayout->navbar_ownerdash();
    $ObjBody->dashboard();
    $ObjBody->analytics();
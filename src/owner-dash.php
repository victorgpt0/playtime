<?php
    include 'load.php';
    $ObjLayout->head_ownerdash('dashboard');
    $ObjLayout->navbar_ownerdash();
    $ObjBody->dashboard();
    $ObjBody->analytics();
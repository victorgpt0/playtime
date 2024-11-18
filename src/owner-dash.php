<?php
   require 'load.php';
    $ObjLayout->head_ownerdash('Dashboard');
    $ObjLayout->navbar_ownerdash();
    
    $ObjBody->dashboard($facilityCard,$bookings);
    $ObjBody->analytics();
    $ObjBody->displayBookingsSection($conn);
    
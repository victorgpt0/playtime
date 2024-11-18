<?php
require_once 'load.php';
$ObjLayout->head_ownerdash('Booking');
$ObjLayout->navbar_userdash();
?>
<div class="container" id="main-content">
    <?php
    $ObjCaptain->book($conn,$ObjGlobal);
    $ObjCaptain->processPayment($conn);
    $ObjCaptain->bookFacility($conn,$ObjGlobal);

    ?>

<div class="footer" style="min-height: 40vh;"></div>
</div>
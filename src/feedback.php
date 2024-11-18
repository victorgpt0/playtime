<?php
require 'load.php';


$ObjLayout->head_ownerdash('Feedback');
$ObjLayout->navbar_ownerdash();
?>

<head><link rel="stylesheet" href="owner.css"></head>

<div class="container" id="main-content">
<div class="form-section">
            <h2>Customer Feedback</h2>
            <p>View feedback and ratings from customers.</p>
            <button type="button" onclick="viewCustomerFeedback()">View Feedback</button>
            <div id="feedbackResult"></div>
        </div>
        </div>
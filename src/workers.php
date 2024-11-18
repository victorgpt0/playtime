<?php
require 'load.php';
$ObjLayout->head_ownerdash('Staff');
$ObjLayout->navbar_ownerdash();
?>

<head>
    <link rel="stylesheet" href="owner.css">
</head>
<div class="container" id="main-content">
    <div class="form-section">
        <h2>Add New Staff</h2>
        <form method="POST" action="owner_module.php">
            <label for="staffName">Staff Name:</label>
            <input type="text" id="staffName" name="staffName" required>

            <label for="staffContact">Contact Number:</label>
            <input type="text" id="staffContact" name="staffContact" required>

            <button type="submit" name="addStaff">Add Staff</button>
        </form>
    </div>
    
    <!-- Remove Staff -->
    <div class="form-section">
        <h2>Remove Staff</h2>
        <form method="POST" action="owner_module.php">
            <label for="staffID">Staff ID:</label>
            <input type="number" id="staffID" name="staffID" required>
            <button type="submit" name="removeStaff">Remove Staff</button>
        </form>
    </div>
</div>
</div>

<!-- Staff Table -->
<div class="form-section">
    <div id="staff-table-container">
    <?php include 'viewstaff.php'; ?>
    </div>
</div>
</div>
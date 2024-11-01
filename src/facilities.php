<?php
require 'load.php';
$ObjLayout->head_ownerdash('Facilities');
$ObjLayout->navbar_ownerdash();
?>

<head>
    <link rel="stylesheet" href="owner.css">
</head>
<div class="container" id="main-content">

    <div class="form-section">
        <h2>Add New Sports Facility</h2>
        <form method="POST" action="">
            <label for="facilityName">Facility Name:</label>
            <input type="text" id="facilityName" name="facilityName" required>

            <label for="facilityType">Facility Type:</label>
            <select id="facilityType" name="facilityType">
                <option value="Tennis Court">Tennis Court</option>
                <option value="Football Field">Football Field</option>
                <option value="Basketball Court">Basketball Court</option>
                <option value="Golf Course">Golf Course</option>
                <option value="Bowling Alley">Bowling Alley</option>
            </select>

            <label for="facilityPrice">Price per Hour:</label>
            <input type="number" id="facilityPrice" name="facilityPrice" required>

            <button type="submit">Add Facility</button>
        </form>
    </div>
</div>
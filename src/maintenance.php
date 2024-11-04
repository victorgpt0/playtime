<?php
require 'load.php';
$ObjLayout->head_ownerdash('Maintenance');
$ObjLayout->navbar_ownerdash();
?>

<link rel="stylesheet" href="owner.css">
<div class="container" id="main-content">
<div class="form-section">
            <h2>Submit a Maintenance Request</h2>
            <form method="POST" action="">
                <label for="facilityMaintenance">Select Facility:</label>
                <select id="facilityMaintenance" name="facilityMaintenance">
                    <option value="Tennis Court">Tennis Court</option>
                    <option value="Football Field">Football Field</option>
                    <option value="Basketball Court">Basketball Court</option>
                    <option value="Golf Course">Golf Course</option>
                    <option value="Bowling Alley">Bowling Alley</option>
                </select>

                <label for="issueDescription">Issue Description:</label>
                <textarea id="issueDescription" name="issueDescription" rows="4" required></textarea>

                <button type="submit">Submit Request</button>
            </form>
        </div>
        </div>
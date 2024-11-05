<?php
require 'load.php';
$ObjLayout->head_ownerdash('Facilities');
$ObjLayout->navbar_ownerdash();
?>

<head>
    <link rel="stylesheet" href="owner.css">
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js"></script>
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

    <!-- Map Container -->
    <div id="map"></div>
</div>

<style>
    /* Add CSS for the map container */
    #map {
        height: 400px;
        width: 100%;
        margin-top: 20px;
    }
</style>
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoicGlyY2hlZCIsImEiOiJjbTJ6eG9xc2cwZm90MmtzODFzZnVuNnc0In0._Fxiv422MdSiTQ20Kr4R2g';
    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [36.8, -1.3], // starting position [lng, lat]. Note that lat must be set between -90 and 90
        zoom: 9 // starting zoom
    });
</script>



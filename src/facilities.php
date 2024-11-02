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

<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChdlJVekeSwybcGWJ1XpXaLK6Z31_thKs&libraries=places&callback=initMap">
</script>

<script>
// JavaScript for initializing the Google Map
let map;
let service;
let infowindow;

function initMap() {
  const sydney = new google.maps.LatLng(-33.867, 151.195);

  infowindow = new google.maps.InfoWindow();
  map = new google.maps.Map(document.getElementById("map"), {
    center: sydney,
    zoom: 15,
  });

  const request = {
    query: "Museum of Contemporary Art Australia",
    fields: ["name", "geometry"],
  };

  service = new google.maps.places.PlacesService(map);
  service.findPlaceFromQuery(request, (results, status) => {
    if (status === google.maps.places.PlacesServiceStatus.OK && results) {
      for (let i = 0; i < results.length; i++) {
        createMarker(results[i]);
      }

      map.setCenter(results[0].geometry.location);
    }
  });
}

function createMarker(place) {
  if (!place.geometry || !place.geometry.location) return;

  const marker = new google.maps.Marker({
    map,
    position: place.geometry.location,
  });

  google.maps.event.addListener(marker, "click", () => {
    infowindow.setContent(place.name || "");
    infowindow.open(map);
  });
}

window.initMap = initMap;
</script>

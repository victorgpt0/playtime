<?php
require_once 'load.php';
$ObjLayout->head('Dashboard');
$ObjLayout->navbar();

// Class to handle booking functionality
class BookFacility
{
    private $db;

    public function __construct($DB_HOST, $DB_PORT, $DB_USER, $DB_PASS, $DB_NAME)
    {
        $this->db = new Dbconnection($DB_HOST, $DB_PORT, $DB_USER, $DB_PASS, $DB_NAME);
    }

    public function getFacilities()
    {
        // Retrieve all available facilities
        return $this->db->select_and('tbl_facilities', ['statusId' => 1]);
    }

    public function bookFacility($facilityId, $userId, $startTime, $endTime)
    {
        $facility = $this->db->select_and('tbl_facilities', ['facilityId' => $facilityId]);
        if (!empty($facility)) {
            $pricePerHour = $facility[0]['price_per_hour'];
            $duration = (strtotime($endTime) - strtotime($startTime)) / 3600;
            $totalPrice = $pricePerHour * $duration;

            // Insert booking into the database
            $bookingData = [
                'facilityId' => $facilityId,
                'userid' => $userId,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'totalprice' => $totalPrice,
                'statusId' => 1 // Assuming 1 means confirmed
            ];

            return $this->db->insert('tbl_bookings', $bookingData);
        } else {
            return "Facility not found.";
        }
    }
}

// Initialize booking class and retrieve facilities
$booking = new BookFacility('localhost', '3308', 'root', 'password', 'railway');
$facilities = $booking->getFacilities();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Facility</title>
    <link rel="stylesheet" href="owner.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.css">
</head>
<body>

<h2>Book a Facility</h2>
<form method="POST">
    <label for="facilityType">Facility Type:</label>
            <select id="facilityType" name="facilityType">
                <option value="Tennis Court">Tennis Court</option>
                <option value="Football Field">Football Field</option>
                <option value="Basketball Court">Basketball Court</option>
                <option value="Golf Course">Golf Course</option>
                <option value="Bowling Alley">Bowling Alley</option>
            </select>

    <label for="startTime">Start Time:</label>
<input type="time" id="startTime" name="startTime" required>

<label for="endTime">End Time:</label>
<input type="time" id="endTime" name="endTime" required>

<button type="submit">Book Now</button>


    <!-- Map Container -->
    <div id="map"></div>

  
</form>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet@3.0.12/dist/esri-leaflet.js"></script>
<script src="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.js"></script>
<script>
    // Initialize map and set a default view
    const map = L.map('map').setView([0.0, 0.0], 2);

    // Add the tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Add a search control to the map
    const geocoder = L.esri.Geocoding.geosearch().addTo(map);

    // Handle the search result event
    geocoder.on('results', function(data) {
        map.setView(data.results[0].latlng, 15);

        const marker = L.marker(data.results[0].latlng).addTo(map);
        document.getElementById('facilityAddress').value = data.results[0].text;
    });
</script>

<style>
    #map {
        height: 400px;
        width: 100%;
        margin-top: 20px;
    }
</style>
</body>
</html>

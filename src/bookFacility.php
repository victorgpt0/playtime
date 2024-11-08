<<?php
require_once 'load.php';
$ObjLayout->head('Dashboard');
$ObjLayout->navbar();

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
        // Calculate total price based on duration and facility rate
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

// Example usage
$booking = new BookFacility('localhost', '3308', 'root', 'password', 'railway');

// Fetch facilities
$facilities = $booking->getFacilities();
foreach ($facilities as $facility) {
    echo "Facility: " . $facility['name'] . ", Price per hour: " . $facility['price_per_hour'] . "<br>";
}

// Book a facility
$response = $booking->bookFacility(1, 2, '2024-11-06 09:00:00', '2024-11-06 11:00:00');
echo is_string($response) ? $response : "Booking successful!";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Facility</title>
</head>
<body>

<br> <br>  <br> <br> 
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
    </form>
</body>
</html>

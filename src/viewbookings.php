<?php
require_once 'C:\xampp\htdocs\Playtime\playtime\src\database\dbconnection.php'; // Adjust path if necessary

// Create an instance of Dbconnection
$db = new Dbconnection('localhost', 3306, 'root', 'Njorogez#17', 'railway'); // Replace with your DB credentials

// SQL query to fetch the required data
$query = "
    SELECT 
        f.name AS facility_name, 
        b.booked_at, 
        b.totalprice, 
        b.statusId 
    FROM 
        tbl_bookings b
    LEFT JOIN 
        tbl_facilities f ON b.facilityId = f.facilityId
";


$bookings = $db->select_custom($query); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bookings</title>
  
    <link rel="stylesheet" href="owner.css">
</head>
<body>
    <h1> Bookings</h1>
    <div id="staff-table-container">
        <table>
            <thead>
                <tr>
                    <th>Facility Name</th>
                    <th>Booked At</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookings)): ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['facility_name']); ?></td>
                            <td><?= htmlspecialchars($booking['booked_at']); ?></td>
                            <td>Ksh <?= htmlspecialchars(number_format($booking['totalprice'], 2)); ?></td>
                            <td>
                                <?= $booking['statusId'] == 1 ? 'Confirmed' : ($booking['statusId'] == 2 ? 'Pending' : 'Cancelled'); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

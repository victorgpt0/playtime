<?php
// Backend logic (PHP and database connections) can be added here
?>

<html>

<head>
    <title>Owner's Module</title>
    <link rel="stylesheet" href="owner.css">
    <style>
       
    </style>
</head>

<body>
    <h1 id="ownerh1">Welcome BOSS</h1>
    <h2>Functionalities</h2>
    
    <div class="container">
        <!-- Add New Sports Facility -->
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
        <!-- Add New Staff -->
<div class="form-section">
    <h2>Add New Staff</h2>
    <form method="POST" action="owner_module.php">
        <label for="staffName">Staff Name:</label>
        <input type="text" id="staffName" name="staffName" required>

        <label for="staffPosition">Position:</label>
        <input type="text" id="staffPosition" name="staffPosition" required>

        <label for="staffSalary">Salary:</label>
        <input type="number" id="staffSalary" name="staffSalary" required>

        <label for="staffContact">Contact:</label>
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



        <?php
// Backend logic (PHP and database connections) can be added here to fetch data dynamically.
?>

<html>

<head>
    <title>Owner's Module</title>
    <link rel="stylesheet" href="style.css">
    <style>
       
       

    </style>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1 id="ownerh1">Welcome to the Owner's Module</h1>
    
    <div class="container">
        <!-- Usage Analytics and Peak Seasons -->
        <div class="form-section">
            <h2>Usage Analytics: Income and Peak Seasons</h2>
            <div class="chart-container">
                <canvas id="incomeChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="bookingsChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Sample data: You can fetch these values dynamically from your backend in PHP
        var incomeData = [5000, 7000, 8000, 10000, 6000, 11000, 9500, 12000, 13000, 9000, 8000, 14000]; // Monthly income
        var bookingData = [50, 65, 70, 80, 55, 85, 75, 90, 100, 60, 70, 95]; // Number of bookings for each month
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        // Income Chart
        var ctx1 = document.getElementById('incomeChart').getContext('2d');
        var incomeChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Income Generated ($)',
                    data: incomeData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Income ($)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                }
            }
        });

        // Bookings Chart
        var ctx2 = document.getElementById('bookingsChart').getContext('2d');
        var bookingsChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Number of Bookings',
                    data: bookingData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Bookings'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>


        <!-- Check Availability -->
        <div class="form-section">
            <h2>Check Facility Availability</h2>
            <form method="GET" action="">
                <label for="facilitySelect">Select Facility:</label>
                <select id="facilitySelect" name="facilitySelect">
                    <option value="Tennis Court">Tennis Court</option>
                    <option value="Football Field">Football Field</option>
                    <option value="Basketball Court">Basketball Court</option>
                    <option value="Golf Course">Golf Course</option>
                    <option value="Bowling Alley">Bowling Alley</option>
                </select>

                <button type="submit">Check Availability</button>
            </form>
        </div>

        <!-- Income Report for Different Months -->
        <div class="form-section">
            <h2>Income for Different Months</h2>
            <form method="GET" action="">
                <label for="incomeMonth">Select Month:</label>
                <select id="incomeMonth" name="incomeMonth">
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>

                <button type="submit">View Income</button>
            </form>
        </div>

        <!-- Maintenance Requests -->
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

        <!-- Customer Feedback -->
        <div class="form-section">
            <h2>Customer Feedback</h2>
            <p>View feedback and ratings from customers.</p>
            <button type="button" onclick="viewCustomerFeedback()">View Feedback</button>
            <div id="feedbackResult"></div>
        </div>
    </div>

    <script>
        function viewUsageAnalytics() {
            // Placeholder for future analytics logic
            document.getElementById('analyticsResult').innerHTML = "Analytics data would be shown here.";
        }

        function viewCustomerFeedback() {
            // Placeholder for future customer feedback logic
            document.getElementById('feedbackResult').innerHTML = "Customer feedback would be shown here.";
        }
    </script>

</body>

</html>
<?php
$servername = "localhost"; // Update with your server name
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "DB_NAME"; // Database name (update with your actual database name)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Staff
if (isset($_POST['addStaff'])) {
    $staffName = $_POST['staffName'];
    $staffPosition = $_POST['staffPosition'];
    $staffSalary = $_POST['staffSalary'];
    $staffContact = $_POST['staffContact'];

    $sql = "INSERT INTO staff (staffName, staffPosition, staffSalary, staffContact) VALUES ('$staffName', '$staffPosition', '$staffSalary', '$staffContact')";

    if ($conn->query($sql) === TRUE) {
        echo "New staff added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Remove Staff
if (isset($_POST['removeStaff'])) {
    $staffID = $_POST['staffID'];

    $sql = "DELETE FROM staff WHERE staffID = '$staffID'";

    if ($conn->query($sql) === TRUE) {
        echo "Staff removed successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch and Display Staff
$sql = "SELECT staffID, staffName, staffPosition FROM staff";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Staff List:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li> ID: " . $row["staffID"] . " - Name: " . $row["staffName"] . " - Position: " . $row["staffPosition"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No staff found.";
}

$conn->close();
?>


<?php
require 'load.php'; // Assuming you have a file for loading common resources
$ObjLayout->head_ownerdash('Equipment Release');
$ObjLayout->navbar_staffdash();

?>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h2 class="mb-0">Equipment Release Form</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="process_equipment_release.php">
                    <!-- Staff Name -->
                    <div class="form-group">
                        <label for="staffName">Staff Name:</label>
                        <input type="text" class="form-control" id="staffName" name="staffName" required>
                    </div>

                    <div class="form-group">
                        <label for="BorrowerName">Borrower Name:</label>
                        <input type="text" class="form-control" id="borrowerName" name="borrowerName" required>
                    </div>

                    <!-- Equipment Name -->
                    <div class="form-group">
                        <label for="equipmentName">Equipment Name:</label>
                        <input type="text" class="form-control" id="equipmentName" name="equipmentName" required>
                    </div>

                    <!-- Release Date -->
                    <div class="form-group">
                        <label for="releaseDate">Release Date:</label>
                        <input type="date" class="form-control" id="releaseDate" name="releaseDate" required>
                    </div>

                    <!-- Notes (Optional) -->
                    <div class="form-group">
                        <label for="notes">Notes:</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter any additional details (optional)"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success" name="releaseEquipment">Release Equipment</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and dependencies (optional, for better interactivity) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<style>
    .card{
        margin-left: 250px;
        padding: 25px;
    }

    .form-group{
        padding: 15px;
    }
</style>
</html>
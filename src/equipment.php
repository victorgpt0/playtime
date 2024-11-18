<?php
require 'load.php'; // Assuming you have a file for loading common resources
$ObjLayout->head_ownerdash('Equipment Release');
$ObjLayout->navbar_staffdash();


try {
    // Handle equipment logging
    $connn = $conn->getConnection();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['log_equipment'])) {
        $equipment_id = htmlspecialchars($_POST['equipment_id']);
        $captain_id = htmlspecialchars($_POST['captain_id']);
        $rental_date = htmlspecialchars($_POST['rental_date']);

        $ObjStaff->logRentedEquipment($conn, [
            'equipment_id' => $equipment_id,
            'captain_id' => $captain_id,
            'rental_date' => $rental_date
        ]);
        echo "<p>Equipment logged successfully!</p>";
    }

    // Handle equipment return
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout_equipment'])) {
        $rented_id = htmlspecialchars($_POST['rented_id']);
        $ObjStaff->checkoutEquipment($conn, $rented_id);
        echo "<p>Equipment checked out successfully!</p>";
    }
} catch (Exception $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>

<div class="container mt-5" style="color:Black;">
    <form method="POST" class="form-log-equipment border p-4 rounded bg-light" style="margin-left:200px">
        <h2 class="text-center mb-4">Log Rented Equipment</h2>
        <div class="form-group" >
            <label for="equipment_id">Equipment:</label>
            <select class="form-control" name="equipment_id" id="equipment_id" required>
                <?php
                foreach ($equipment as $item) {
                    echo "<option value='{$item['id']}'>" . htmlspecialchars($item['name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group" style="color:Black;">
            <label for="captain_id">Captain:</label>
            <select class="form-control" name="captain_id" id="captain_id" required>
                <?php
                foreach ($captains as $captain) {
                    echo "<option value='{$captain['id']}'>" . htmlspecialchars($captain['username']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="rental_date">Rental Date:</label>
            <input type="datetime-local" class="form-control" name="rental_date" id="rental_date" required>
        </div>
        <button type="submit" name="log_equipment" class="btn btn-primary btn-block">Log Equipment</button>
    </form>
</div>

    <!-- Table to Display Rented Equipment -->
    <div class="container mt-5"style="margin-left:200px">
    <h2 class="text-center mb-4">Rented Equipment</h2>
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Equipment Name</th>
                <th>Captain Name</th>
                <th>Rental Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($rentedEquipment as $row) {
                echo "<tr>
                    <td>" . htmlspecialchars($row['equipment_name']) . "</td>
                    <td>" . htmlspecialchars($row['captain_name']) . "</td>
                    <td>" . htmlspecialchars($row['rent_date']) . "</td>
                    <td>
                        <form method='POST' class='d-inline'>
                            <input type='hidden' name='rented_id' value='" . htmlspecialchars($row['id']) . "'>
                            <button type='submit' name='checkout_equipment' class='btn btn-success btn-sm'>Checkout</button>
                        </form>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<head><link rel="stylesheet" href="owner.css"></head>

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
<?php
require 'load.php';
$ObjLayout->head_ownerdash('Staff');
$ObjLayout->navbar_ownerdash();
$conditions = ['roleId' => 3];

$staff = $conn->select_and('tbl_users', $conditions);
?>

<head>
    <link rel="stylesheet" href="owner.css">
</head>
<div class="container" id="main-content">
    <div class="form-section">
        <h2>Add New Staff</h2>
        <form method="POST" action="owner_module.php">
            <label for="staffName">Staff Name:</label>
            <input type="text" id="staffName" name="staffName" required>

            <label for="staffContact">Contact Number:</label>
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
</div>
</div>

<!-- Staff Table -->
<div class="form-section">
    <div id="staff-table-container">
    <h1>Staff Members</h1>
    <div id="staff-table-container">
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Username</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($staff)): ?>
                    <?php foreach ($staff as $member): ?>
                        <tr>
                            <td><?= htmlspecialchars($member['fullname']); ?></td>
                            <td><?= htmlspecialchars($member['email']); ?></td>
                            <td><?= htmlspecialchars($member['phone_number']); ?></td>
                            <td><?= htmlspecialchars($member['username']); ?></td>
                            <td>
                                <?= $member['genderId'] == 1 ? 'Male' : ($member['genderId'] == 2 ? 'Female' : 'Other'); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No staff members found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
</div>
<?php
require_once 'C:\xampp\htdocs\Playtime\playtime\src\database\dbconnection.php'; 

// Create an instance of Dbconnection
$db = new dbconnection('localhost', 3306, 'root', 'Njorogez#17', 'railway'); // Replace with your DB credentials

// Fetch data where roleId = 3
$conditions = ['roleId' => 3];
$staff = $db->select_and('tbl_users', $conditions);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Members</title>
   <!-- Link to the external CSS -->
</head>
<body>
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
</body>
</html>

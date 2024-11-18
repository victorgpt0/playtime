<?php
require 'load.php'; 

$conditions = ['roleId' => 3];

$staff = $conn->select_and('tbl_users', $conditions);

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
    
</body>
</html>

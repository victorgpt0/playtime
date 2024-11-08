
<?php
// db.php
$servername = "localhost";
$username = "root";
$password = "";
$database = "railway";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// create_user.php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
    $roleId = $_POST['roleId'];
    $genderId = $_POST['genderId'];

    $sql = "INSERT INTO tbl_users (fullname, email, username, password, roleId, genderId) 
            VALUES ('$fullname', '$email', '$username', '$password', $roleId, $genderId)";
    if ($conn->query($sql) === TRUE) {
        echo "User created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>





<!-- create_user.html -->
<form action="create_user.php" method="post">
    <label>Full Name:</label><input type="text" name="fullname" required><br>
    <label>Email:</label><input type="email" name="email" required><br>
    <label>Username:</label><input type="text" name="username" required><br>
    <label>Password:</label><input type="password" name="password" required><br>
    <label>Role ID:</label><input type="number" name="roleId" required><br>
    <label>Gender ID:</label><input type="number" name="genderId" required><br>
    <input type="submit" value="Add User">
</form>




<?php
// read_users.php
include 'db.php';

$sql = "SELECT * FROM tbl_users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>UserID</th><th>Full Name</th><th>Email</th><th>Username</th><th>Role ID</th><th>Gender ID</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["userid"]."</td><td>".$row["fullname"]."</td><td>".$row["email"]."</td><td>".$row["username"]."</td><td>".$row["roleId"]."</td><td>".$row["genderId"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>




<?php
// update_user.php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $roleId = $_POST['roleId'];
    $genderId = $_POST['genderId'];

    $sql = "UPDATE tbl_users SET fullname='$fullname', email='$email', username='$username', roleId=$roleId, genderId=$genderId WHERE userid=$userid";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}
$conn->close();
?>

<!-- update_user.html -->
<form action="update_user.php" method="post">
    <label>User ID:</label><input type="number" name="userid" required><br>
    <label>Full Name:</label><input type="text" name="fullname" required><br>
    <label>Email:</label><input type="email" name="email" required><br>
    <label>Username:</label><input type="text" name="username" required><br>
    <label>Role ID:</label><input type="number" name="roleId" required><br>
    <label>Gender ID:</label><input type="number" name="genderId" required><br>
    <input type="submit" value="Update User">
</form>




<?php
// delete_user.php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];

    $sql = "DELETE FROM tbl_users WHERE userid=$userid";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}
$conn->close();
?>

<!-- delete_user.html -->
<form action="delete_user.php" method="post">
    <label>User ID to Delete:</label><input type="number" name="userid" required><br>
    <input type="submit" value="Delete User">
</form>

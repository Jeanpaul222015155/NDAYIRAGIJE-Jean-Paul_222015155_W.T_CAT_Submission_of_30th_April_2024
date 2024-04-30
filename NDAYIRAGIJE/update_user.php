<?php
// Database connection
include('database_connection.php');

// Fetch user data based on the provided user_id
if (isset($_REQUEST['user_id'])) {
    $userid = $_REQUEST['user_id'];
    
    $stmt = $connection->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Assign fetched values to variables

        $userid = $row['user_id'];
        $username = $row['username'];
        $password = $row['password'];
        $role = $row['role'];
    } else {
        echo "User not found.";
    }
}

// Handle form submission for updating user data
if (isset($_POST['up'])) {
    $userid = $_POST['userid'];
    $username = $_POST['usern'];
    $password = $_POST['password'];
    $role = $_POST['rol'];

    // Prepare a SQL UPDATE statement to update the user data
   
    $stmt = $connection->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE user_id = ?");
    $stmt->bind_param("sssi", $username, $password, $role, $userid);
    $stmt->execute();
    
    header('Location: user.php');
    exit(); // Stop further code execution after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <style>
        body {
            background-color: yellowgreen;
          
        }
    </style>
    <script>
        // Toggle password visibility
        function togglePassword(inputId) {
            var input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }

        // Confirm update action
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>

<body>
     <!-- Heading for the update form -->

    <h2><u>Update User Form</u></h2>

     <!-- Form for updating user data with JavaScript confirmation on submission -->

    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="userid">User ID:</label>
        <input type="number" id="userid" name="userid" value="<?php echo isset($userid) ? $userid : ''; ?>" readonly>
        <br>

        <label for="usern">Username:</label>
        <input type="text" id="usern" name="usern" value="<?php echo isset($username) ? $username : ''; ?>">
        <br>

        <label for="password">Password:</label>
        <div class="password-toggle">
            <input type="password" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
            <span class="toggle-password" onclick="togglePassword('password')">Show/Hide</span>
        </div>
        <br>

        <label for="rol">Role:</label>
        <input type="text" id="rol" name="rol" value="<?php echo isset($role) ? $role : ''; ?>">
        <br>

        <input type="submit" name="up" value="Update">
        <!-- Link to navigate back to the user page -->
        <a href="./user.php">Go Back to Form</a>
    </form>
</body>
</html>

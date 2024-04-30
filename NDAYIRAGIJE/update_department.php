<?php

// Ensure proper database connection setup


include('database_connection.php'); 
$department_id = null;
$department_name = '';

// Handle POST requests to update the department

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $department_id = $_POST['department_id']; 
    $department_name = $_POST['department_name']; 

    // Prepare SQL statement to update department name based on department ID


    $stmt = $connection->prepare("UPDATE departments SET department_name = ? WHERE department_id = ?");
    $stmt->bind_param("si", $department_name, $department_id); 

    if ($stmt->execute()) {
        echo "Department updated successfully."; 
    } else {
        echo "Error updating department: " . $stmt->error; 
    }

    $stmt->close(); 
}

// Handle GET requests to retrieve department details for updating

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];

    // Prepare SQL statement to get department details by ID

    $stmt = $connection->prepare("SELECT * FROM departments WHERE department_id = ?");
    $stmt->bind_param("i", $department_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $department_name = $row['department_name']; // Assign the department name
    } else {
        echo "No department found with the given ID."; 
        $department_name = ""; // Ensure a default value for the form
    }

    $stmt->close(); // Close the statement
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    
    header("Location: department.php");

    exit(); // Ensure script stops executing after redirect
}
?>

<!DOCTYPE html>
<html>
<head>
    <body style="background-color: orange;"> 
    <title>Update Department</title>

 <!-- JavaScript validation and content load for update or modify data-->

    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body style="background-color: yellowgreen;"><center>
    
    <h2><u>Update Form of Department</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

    <h1>Update Department</h1>

    <form method="post" action="update_department.php"> <!-- Form for updating the department -->
        <input type="hidden" name="department_id" value="<?php echo $department_id; ?>"> 

        <label for="department_name">Department Name:</label>
        <input type="text" id="department_name" name="department_name" required value="<?php echo $department_name; ?>"><br><br> 
        <input type="submit" name="update" value="Update Department"> 
        <a href="department.php">Go back to Department List</a> <!-- Link to return to the department list -->
    </form>

</body>
</html>

<?php
include('database_connection.php'); 

if (isset($_REQUEST['project_id'])) {
    $projid = $_REQUEST['project_id']; 
    
    // Prepare the SELECT statement to fetch project data


    $stmt = $connection->prepare("SELECT * FROM projects WHERE project_id = ?");
    $stmt->bind_param("i", $projid);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Get the result
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $projid = $row['project_id'];
        $projn = $row['project_name'];
    } else {
        echo "Project not found."; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8"> 
 <title>Update Products</title> 

    <!-- JavaScript validation for update confirmation -->
    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update this record?"); // JavaScript confirmation
        }
    </script>
</head>
<body style="background-color: yellowgreen;"> 
    <center>
     <h2><u>Update Form of Project</u></h2>
     <form method="POST" onsubmit="return confirmUpdate();"> 
        <label for="projid">Project Id:</label>
        <input type="number" id="projid" name="projid" value="<?php echo isset($projid) ? $projid : ''; ?>">
        <br><br>

        <label for="projn">Project Name:</label>
        <input type="text" id="projn" name="projn" value="<?php echo isset($projn) ? $projn : ''; ?>">
        <br><br>
            
        <input type="submit" name="up" value="Update">
            <a href="./project.php">Go Back to Form</a> 
        </form>
    </center>
    </body>
    </html>

<?php

// Check if POST request and 'up' parameter is set


if (isset($_POST['up'])) {
    $projid = $_POST['projid'];
    $projn = $_POST['projn'];
   
    // Prepare the UPDATE statement to modify the project data

    $stmt = $connection->prepare("UPDATE projects SET project_id = ?, project_name = ? WHERE project_id = ?");
    $stmt->bind_param("ssi", $projid, $projn, $projid);
    $stmt->execute(); 
    header("Location: project.php");
    exit(); 
}
?>

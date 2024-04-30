<?php
include('database_connection.php');

if(isset($_REQUEST['assignment_id'])) {
    $Assignment_id = $_REQUEST['assignment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM assignments WHERE assignment_id=?");
    $stmt->bind_param("i", $Assignment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Assignment_id = $row['assignment_id'];
        $assignment_name = $row['assignment_name'];
        $wokid = $row['worker_id'];
        $proid = $row['project_id'];
        $stdate = $row['start_date'];
        $endate = $row['end_date'];
        
    } else {
        echo "Assignment not found.";
    }
}
?>

<<!DOCTYPE html>
<html>
<head>
    <body style="background-color: green;"> 
    <title>Update products</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>

    <!-- Heading for the update form -->
    
    <h2><u>Update Form of Assignment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="Assignment_id">Assignment Id:</label>
        <input type="number" id="Assignment_id" name="Assignment_id" value="<?php echo isset($Assignment_id) ? $Assignment_id : ''; ?>">
        <br><br>

        <label for="assignment_name">Assignment Name:</label>
        <input type="text" id="assignment_name" name="assignment_name" value="<?php echo isset($assignment_name) ? $assignment_name : ''; ?>">
        <br><br>

         <label for="wokid">Worker Id:</label>
        <input type="number" id="wokid" name="wokid" value="<?php echo isset($wokid) ? $wokid : ''; ?>">
        <br><br>

        <label for="proid">Project Id:</label>
        <input type="number" id="proid" name="proid" value="<?php echo isset($proid) ? $proid : ''; ?>">
        <br><br>

        <label for="stdate">Start Date:</label>
        <input type="date" id="stdate" name="stdate" value="<?php echo isset($stdate) ? $stdate : ''; ?>">
        <br><br>

        <label for="endate">End Date:</label>
        <input type="date" id="endate" name="endate" value="<?php echo isset($endate) ? $endate : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        <a href="./assignment.php">Go Back to Form</a>
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    $Assignment_id = $_POST['Assignment_id'];
    $assignment_name = $_POST['assignment_name'];
    $wokid = $_POST['wokid'];
    $proid = $_POST['proid'];
    $stdate = $_POST['stdate'];
    $endate = $_POST['endate'];
   
    $stmt = $connection->prepare("UPDATE assignments SET assignment_id=?, assignment_name=?, worker_id=?, project_id=?, start_date=?, end_date=? WHERE assignment_id=?");
    $stmt->bind_param("sssissi", $Assignment_id, $assignment_name, $wokid, $proid, $stdate, $endate, $Assignment_id);

    // Execute the update statement
    $stmt->execute();
    
    header('Location:assignment.php');
    exit(); // Ensure no further code is executed after redirect
}
}
?>

<?php
include('database_connection.php');
if(isset($_REQUEST['worker_id'])) {
    $workid = $_REQUEST['worker_id'];
    
    $stmt = $connection->prepare("SELECT * FROM workersinfo WHERE worker_id=?");
    $stmt->bind_param("i", $workid); // Corrected variable name from $work_id to $workid
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $worker_id = $row['worker_id']; 
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $dob = $row['date_of_birth'];
        $gend = $row['gender'];
        $con = $row['contact_number'];
        $eml = $row['email'];
        $Adrs = $row['address'];
        $skls = $row['skills'];
    } else {
        echo "Worker info not found."; // Corrected typo from 'workerinfo' to 'Worker info'
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <body style="background-color: yellowgreen;"> 
    <title>Update products</title>

 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }

    </script>
</head>
<body><center>
    <h2><u>Update Form of Workerinfo</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="worker_id">Worker Id:</label>
        <input type="text" name="worker_id" value="<?php echo isset($worker_id) ? $worker_id : ''; ?>">
        <br><br>

        <label for="fname">First Name:</label>
        <input type="text" name="fname" value="<?php echo isset($fname) ? $fname : ''; ?>">
        <br><br>

        <label for="lname">Last Name:</label>
        <input type="text" name="lname" value="<?php echo isset($lname) ? $lname : ''; ?>">
        <br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" value="<?php echo isset($dob) ? $dob : ''; ?>">
        <br><br>
        
        <label for="gend">Gender:</label>
        <select name="gend" id="gend">
            <option value="Male" <?php if(isset($gend) && $gend == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if(isset($gend) && $gend == 'Female') echo 'selected'; ?>>Female</option>
        </select>
        <br><br>

        <label for="con">Contact Number:</label>
        <input type="text" name="con" value="<?php echo isset($con) ? $con : ''; ?>">
        <br><br> 

        <label for="eml">Email:</label>
        <input type="email" name="eml" value="<?php echo isset($eml) ? $eml : ''; ?>">
        <br><br> 

        <label for="Adrs">Address:</label>
        <input type="text" name="Adrs" value="<?php echo isset($Adrs) ? $Adrs : ''; ?>">
        <br><br> 

        <label for="skls">Skills:</label>
        <input type="text" name="skls" value="<?php echo isset($skls) ? $skls : ''; ?>">
        <br><br> 

        <input type="submit" name="up" value="Update">
        <a href="./workerinfo.php">Go Back to Form</a>
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    $worker_id = $_POST['worker_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gend = $_POST['gend'];
    $con = $_POST['con'];
    $eml = $_POST['eml'];
    $Adrs = $_POST['Adrs'];
    $skls = $_POST['skls'];

    $stmt = $connection->prepare("UPDATE workersinfo SET first_name=?, last_name=?, date_of_birth=?, gender=?, contact_number=?, email=?, address=?, skills=? WHERE worker_id=?");
    $stmt->bind_param("ssssssssi", $fname, $lname, $dob, $gend, $con, $eml, $Adrs, $skls, $worker_id); // Corrected variable name from $work_id to $worker_id
    $stmt->execute();
    
    header('Location:workerinfo.php');
    exit(); 
}
?>

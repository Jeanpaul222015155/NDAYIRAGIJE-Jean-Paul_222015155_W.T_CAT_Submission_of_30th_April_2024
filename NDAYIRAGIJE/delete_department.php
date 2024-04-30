<?php
include('database_connection.php');

if(isset($_REQUEST['department_id'])) {
    $dpartid = $_REQUEST['department_id'];
    
    $stmt = $connection->prepare("DELETE FROM departments WHERE department_id=?");
    $stmt->bind_param("i", $dpartid);
     ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="dpartid" value="<?php echo $dpartid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?></body>
</html>
<?php
    $stmt->close();
} else {
    echo "Department is not set.";
}
?>
<body bgcolor="pineapplesky">
<button onclick="window.location.href='./department.php'">Back to Form</button>
<?php
$connection->close();
?>

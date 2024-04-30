<?php
include('database_connection.php');
if(isset($_REQUEST['worker_id'])) {
    $worker_id = $_REQUEST['worker_id'];
    
    $stmt = $connection->prepare("DELETE FROM workersinfo WHERE worker_id=?");
    $stmt->bind_param("i", $worker_id); 
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
            <input type="hidden" name="worker_id" value="<?php echo $worker_id; ?>">
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
    echo "worker_id is not set.";
}
?>
<body bgcolor="pineapplesky">
<button onclick="window.location.href='./workerinfo.php'">Back to Form</button>
<?php
$connection->close();
?>

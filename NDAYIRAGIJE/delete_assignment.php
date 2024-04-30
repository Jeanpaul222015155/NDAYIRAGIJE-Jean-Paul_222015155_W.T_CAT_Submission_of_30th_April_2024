<?php
include('database_connection.php');

if(isset($_REQUEST['assignment_id'])) {
    $assignment_id = $_REQUEST['assignment_id'];
    
    $stmt = $connection->prepare("DELETE FROM assignments WHERE assignment_id=?");
    $stmt->bind_param("i", $assignment_id);
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
            <input type="hidden" name="assignment_id" value="<?php echo $assignment_id; ?>">
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
    echo "Assignment is not set.";
}
?>
<body bgcolor="pineapplesky">
<button onclick="window.location.href='./assignment.php'">Back to Form</button>
<?php
$connection->close();
?>

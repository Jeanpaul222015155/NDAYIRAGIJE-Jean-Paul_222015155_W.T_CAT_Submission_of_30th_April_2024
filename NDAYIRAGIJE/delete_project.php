<?php
include('database_connection.php');

if(isset($_REQUEST['project_id'])) {
    $projid = $_REQUEST['project_id'];
    
    $stmt = $connection->prepare("DELETE FROM projects WHERE project_id=?");
    $stmt->bind_param("i", $projid);
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
            <input type="hidden" name="projid" value="<?php echo $projid; ?>">
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
    echo "Project is not set.";
}
?>
<body bgcolor="pineapplesky">
<button onclick="window.location.href='./project.php'">Back to Form</button>
<?php
$connection->close();
?>

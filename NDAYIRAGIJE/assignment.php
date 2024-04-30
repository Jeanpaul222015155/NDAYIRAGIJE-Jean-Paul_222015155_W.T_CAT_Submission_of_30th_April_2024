<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"> <!-- Proper character encoding -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
  <title>Workerinfo</title>
  <link rel="stylesheet" type="text/css" href="style.css"> <!-- External CSS -->
  <style>
    /* CSS styles for consistent styling */
    a {
      padding: 15px;
      color: white;
      background-color: orange;
      text-decoration: none;
      margin-right: 15px;
    }

    a:visited {
      color: green;
    }

    a:link {
      color: brown;
    }

    a:hover {
      background-color: white;
    }

    a:active {
      background-color: red;
    }

    button.btn {
      margin-left: 20px; 
      margin-top: 7px;
    }

    input.form-control {
      padding: 10px;
    }

    table {
      width: 100%; /* Set table to full width */
      border-collapse: collapse; /* Merge borders */
    }

    th, td {
      border: 2px solid black; /* Table borders */
      padding: 10px; /* Padding for readability */
      text-align: left;
    }

    th {
      background-color: blue; /* Header row color */
    }

    section {
      padding: 20px; 
      border-bottom: 3px solid #ddd; /* Bottom border for section */
    }

    footer {
      text-align: center; 
      padding: 20px; 
      background-color: orange; /* Footer background color */
    }
  </style>
  <!-- JavaScript function for insert confirmation -->
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</head>

<body style="background-color: lightblue;"> <!-- Corrected placement of body tag -->
  <header>
    <ul style="list-style-type: none; padding: 0;"> <!-- No list-style -->
      <li style="display: inline; margin-right: 10px;">
        <img src="./Images/d.jpg" width="90" height="60" alt="Logo">
      </li>
      <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
      <!-- Additional links for navigation -->
      <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./workerinfo.php">WORKERINFO</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./department.php">DEPARTMENT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./assignment.php">ASSIGNMENT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./project.php">PROJECT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./user.php">USER</a></li>

      <li class="dropdown" style="display: inline; margin-right: 10px;">
        <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none;">Settings</a>
        <div class="dropdown-contents">
          <a href="login.html">Login</a>
          <a href="register.html">Register</a>
          <a href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </header>
<body>
    <h1>Assignment Form</h1>
     <form method="post" onsubmit="return confirmInsert();">
        <label for="Assignment_id">Assignment Id:</label>
        <input type="number" id="Assignment_id" name="Assignment_id" required><br><br>
        <label for="assignment_name">Assignment Name:</label>
        <input type="text" id="assignment_name" name="assignment_name" required><br><br>
        <label for="wokid">Worker Id:</label>
        <input type="number" id="wokid" name="wokid" required><br><br>
        <label for="proid">Project Id:</label>
        <input type="number" id="proid" name="proid" required><br><br>
        <label for="stdate">Start Date:</label>
        <input type="date" id="stdate" name="stdate" required><br><br>
        <label for="endate">End Date:</label>
        <input type="date" id="endate" name="endate" required><br><br>
        <input type="submit" name="add" value="Insert"><br><br>
        <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
    include('database_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        $stmt = $connection->prepare("INSERT INTO assignments (Assignment_id, assignment_name, worker_id, project_id, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isiiii", $Assignment_id, $assignment_name, $wokid, $proid, $stdate, $endate);

        $Assignment_id = $_POST['Assignment_id'];
        $assignment_name = $_POST['assignment_name'];
        $wokid = $_POST['wokid'];
        $proid = $_POST['proid'];
        $stdate = $_POST['stdate'];
        $endate = $_POST['endate'];

        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br><a href='assignment.php'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    }
    ?>
  
    <section>
        <h2>Table of Assignments</h2>
        <table>
            <tr>
                <th>Assignment Id</th>
                <th>Assignment Name</th>
                <th>Worker Id</th>
                <th>Project Id</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            $sql = "SELECT * FROM assignments";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['assignment_id']}</td>
                            <td>{$row['assignment_name']}</td>
                            <td>{$row['worker_id']}</td>
                            <td>{$row['project_id']}</td>
                            <td>{$row['start_date']}</td>
                            <td>{$row['end_date']}</td>
                            <td><a style='padding:4px' href='delete_assignment.php?assignment_id={$row['assignment_id']}'>Delete</a></td> 
                            <td><a style='padding:4px' href='update_assignment.php?assignment_id={$row['assignment_id']}'>Update</a></td> 
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No data found</td></tr>";
            }
            ?>
        </table>
    </section>

    <footer>
        <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Jean Paul NDAYIRAGIJE</h2>
    </footer>
</body>
</html>

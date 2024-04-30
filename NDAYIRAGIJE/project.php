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
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    a:visited {
      color: purple;
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
      background-color: orange; /* Header row color */
    }

    section {
      padding: 20px; 
      border-bottom: 3px solid #ddd; /* Bottom border for section */
    }

    footer {
      text-align: center; 
      padding: 20px; 
      background-color: darkgray; /* Footer background color */
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
    <!-- Main heading for the project form -->
    <h1>Project Form</h1>
    <!-- Form to input project data, with confirmation on submission -->
    <form method="post" onsubmit="return confirmInsert();">
        <label for="projid">Project Id:</label>
        <input type="number" id="projid" name="projid" required><br><br>
        <label for="projn">Project Name:</label>
        <input type="text" id="projn" name="projn" required><br><br>
        <input type="submit" name="add" value="Insert"><br><br>
        <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
    // Include the database connection script
    include('database_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        // Sanitize the input using mysqli_real_escape_string
        $projid = $connection->real_escape_string($_POST['projid']);
        $projn = $connection->real_escape_string($_POST['projn']);

        // Prepare and execute the INSERT statement
        $stmt = $connection->prepare("INSERT INTO projects (project_id, project_name) VALUES (?, ?)");
        $stmt->bind_param("is", $projid, $projn);

        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    }

    $sql = "SELECT * FROM projects";
    $result = $connection->query($sql);
    ?>

    <h2>Table of Projects</h2>
    <table>
        <!-- Table headers for the projects table -->
        <tr>
            <th>Project id</th>
            <th>Project name</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $projid = $row["project_id"];
                echo "<tr>
                        <td>{$row['project_id']}</td>
                        <td>{$row['project_name']}</td>
                        <td><a style='padding:4px' href='delete_project.php?project_id=$projid'>Delete</a></td> 
                        <td><a style='padding:4px' href='update_project.php?project_id=$projid'>Update</a></td> 
                      </tr>"; /* Links to delete or update a project */
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        ?>
    </table>

    <footer>
        <center>
            <b>UR CBE BIT &copy; 2024 &reg;, Designed by: @Jean Paul NDAYIRAGIJE</b>
        </center>
    </footer>

    <?php
     // Close the database connection to release resources

    $connection->close();
    ?>
</body>
</html>

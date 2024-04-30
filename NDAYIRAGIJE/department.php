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
      background-color: green; /* Header row color */
    }

    section {
      padding: 20px; 
      border-bottom: 3px solid #ddd; /* Bottom border for section */
    }

    footer {
      text-align: center; 
      padding: 20px; 
      background-color: yellow; /* Footer background color */
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
<body style="background-color: yellowgreen;">

    <h1>Department Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="department_id">Department ID:</label>
        <input type="number" id="department_id" name="department_id" required><br><br>

        <label for="department_name">Department Name:</label>
        <input type="text" id="department_name" name="department_name" required><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a> <!-- Corrected the path to start with "./" -->
    </form>

    <?php
    include('database_connection.php'); // Include the database connection

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        // Retrieve input values from POST request
        $department_id = $_POST['department_id'];
        $department_name = $_POST['department_name'];

        // Prepare SQL statement for insertion
        $stmt = $connection->prepare("INSERT INTO departments (department_id, department_name) VALUES (?, ?)");
        $stmt->bind_param("is", $department_id, $department_name); // Bind parameters

        // Execute the statement and check for success
        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br><a href='department.php'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
    ?>

    <section>
        <h2>Table of Departments</h2>
        <table>
            <tr>
                <th>Department ID</th>
                <th>Department Name</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Select all departments from the database
            $sql = "SELECT * FROM departments";
            $result = $connection->query($sql); // Execute the query

            if ($result->num_rows > 0) {
                // Loop through the results and generate table rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['department_id']}</td>
                            <td>{$row['department_name']}</td>
                            <td><a style='padding:4px' href='delete_department.php?department_id={$row['department_id']}'>Delete</a></td> 
                            <td><a style='padding:4px' href='update_department.php?department_id={$row['department_id']}'>Update</a></td> 
                          </tr>";
                }
            } else {
                // If no data is found, display a message in the table
                echo "<tr><td colspan='4'>No data found</td></tr>";
            }
            ?>
        </table>
    </section>

    <footer>
        <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Jean Paul NDAYIRAGIJE</h2> <!-- Corrected "Designer" to "Designed" -->
    </footer>

</body>
</html>

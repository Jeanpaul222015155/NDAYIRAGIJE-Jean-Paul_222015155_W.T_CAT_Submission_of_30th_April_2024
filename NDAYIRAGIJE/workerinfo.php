<?php
// Ensure the database connection is included
include('database_connection.php'); 

// Check for POST request and insert data into the database
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add'])) {
    // Assign form data to variables
    $worker_id = $_POST['worker_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gend = $_POST['gend'];
    $con = $_POST['con'];
    $eml = $_POST['eml'];
    $Adrs = $_POST['Adrs'];
    $skls = $_POST['skls'];

    // Prepare the INSERT statement
    $stmt = $connection->prepare("INSERT INTO workersinfo (worker_id, first_name, last_name, date_of_birth, gender, contact_number, email, address, skills) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $worker_id, $fname, $lname, $dob, $gend, $con, $eml, $Adrs, $skls);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        header("Location: workerinfo.php"); // Redirect after successful insert
        exit(); // Ensure script stops after redirect
    } else {
        echo "Error inserting data: " . $stmt->error; // Handle errors during insertion
    }

    $stmt->close(); // Close the prepared statement
}

?>

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

  <section>
    <h1><u>Workerinfo Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();"> <!-- JavaScript confirmation on insert -->
      <!-- Form content -->
       <!-- Form fields for various worker information -->
      <label for="worker_id">Worker Id:</label>
      <input type="number" id="worker_id" name="worker_id"><br><br>
      <label for="fname">First Name:</label>
      <input type="text" id="fname" name="fname" required><br><br>
      <label for="lname">Last Name:</label>
      <input type="text" id="lname" name="lname" required><br><br>
      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob" required><br><br>
      <label for="gend">Gender:</label>
      <select name="gend" id="gend">
        <option>Male</option>
        <option>Female</option>
      </select><br><br>
      <label for="con">Contact Number:</label>
      <input type="text" id="con" name="con" required><br><br>
      <label for="eml">Email:</label>
      <input type="email" id="eml" name="eml" required><br><br>
      <label for="Adrs">Address:</label>
      <input type="text" id="Adrs" name="Adrs" required><br><br>
      <label for="skls">Skills:</label>
      <input type="text" id="skls" name="skls" required><br><br>
      <input type="submit" name="add" value="Insert"> <!-- Insert button -->
      <a href="./home.html">Go Back to Home</a> <!-- Navigation link -->
    </form>
  </section>

  <section>
    <h2>Table of Workerinfo</h2><!-- Section heading for worker information table -->
    <table>
      <tr>
        <th>Worker Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Contact Number</th>
        <th>Email</th>
        <th>Address</th>
        <th>Skills</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      include('database_connection.php'); // Ensure database connection is included

      $sql = "SELECT * FROM workersinfo"; // Query to fetch data
      $result = $connection->query($sql); // Execute the query

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>{$row['worker_id']}</td>
                      <td>{$row['first_name']}</td>
                      <td>{$row['last_name']}</td>
                      <td>{$row['date_of_birth']}</td>
                      <td>{$row['gender']}</td>
                      <td>{$row['contact_number']}</td>
                      <td>{$row['email']}</td>
                      <td>{$row['address']}</td>
                      <td>{$row['skills']}</td>
                      <td><a style='padding:4px' href='delete_workerinfo.php?worker_id={$row['worker_id']}'>Delete</a></td> 
                      <td><a style='padding:4px' href='update_workerinfo.php?worker_id={$row['worker_id']}'>Update</a></td> 
                    </tr>"; /* Links for delete and update actions */
          }
      } else {
          echo "<tr><td colspan='11'>No data found</td></tr>"; // Handle no data scenario
      }
      ?>
    </table>
  </section>

  <footer>
    <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Jean Paul NDAYIRAGIJE</h2> z
  </footer>
</body>
</html>

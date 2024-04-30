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
      background-color: yellowgreen; /* Header row color */
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
    <h1>User Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="userid">User Id:</label>
        <input type="number" id="userid" name="userid" required><br><br>

        <label for="usern">Username:</label>
        <input type="text" id="usern" name="usern" required><br><br>

        <div class="password-toggle">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <span class="toggle-password" onclick="togglePassword('password')">
        </div><br><br>

        <div class="password-toggle">
            <label for="repassword">Re-enter Password:</label>
            <input type="password" id="repassword" name="repassword">
            <span class="toggle-password" onclick="togglePassword('repassword')">
        </div><br><br>

        <label for="rol">Role:</label>
        <input type="text" id="rol" name="rol" required><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
    include('database_connection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        $stmt = $connection->prepare("INSERT INTO users(user_id, username, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userid, $usern, $password, $rol);

        $userid = $_POST['userid'];
        $usern = $_POST['usern'];
        $password = $_POST['password'];
        $rol = $_POST['rol'];

        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br><a href='user.php'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    }
    ?>

    <section>
        <h2>Table of Users</h2>
        <table>
            <tr>
                <th>User Id</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            $sql = "SELECT * FROM users";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['user_id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['password']}</td> <!-- Note: Displaying password is for demo purposes only, in real application, never display or store plain text passwords -->
                            <td>{$row['role']}</td>
                            <td><a style='padding:4px' href='delete_user.php?user_id={$row['user_id']}'>Delete</a></td> 
                            <td><a style='padding:4px' href='update_user.php?user_id={$row['user_id']}'>Update</a></td> 
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
            ?>
        </table>
    </section>

    <footer>
        <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Jean Paul NDAYIRAGIJE</h2>
    </footer>

    <

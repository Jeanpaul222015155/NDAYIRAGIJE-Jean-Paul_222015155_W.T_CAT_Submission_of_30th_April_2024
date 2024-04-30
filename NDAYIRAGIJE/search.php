<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
</head>
<body style="background-color: yellowgreen;;">

<?php
include('database_connection.php');

     // Check if 'query' key exists in the $_GET array
if (isset($_GET['query'])) {

    // Sanitize the input to avoid SQL injection
  
    $searchTerm = $connection->real_escape_string($_GET['query']);

    $queries = [
        'workersinfo' => "SELECT worker_id, CONCAT(first_name, ' ', last_name) AS full_name, address 
                          FROM workersinfo 
                          WHERE worker_id LIKE '%$searchTerm%' 
                          OR CONCAT(first_name, ' ', last_name) LIKE '%$searchTerm%'",
        'departments' => "SELECT department_id, department_name 
                          FROM departments 
                          WHERE department_id LIKE '%$searchTerm%' 
                          OR department_name LIKE '%$searchTerm%'",
        'assignments' => "SELECT assignment_id, assignment_name 
                          FROM assignments 
                          WHERE assignment_id LIKE '%$searchTerm%' 
                          OR assignment_name LIKE '%$searchTerm%'",
        'projects' => "SELECT project_id, project_name 
                       FROM projects 
                       WHERE project_id LIKE '%$searchTerm%' 
                       OR project_name LIKE '%$searchTerm%'",
        'users' => "SELECT user_id, username 
                    FROM users 
                    WHERE user_id LIKE '%$searchTerm%' 
                    OR username LIKE '%$searchTerm%'",
    ];

    echo "<h2><u>Search Results:</u></h2>";

    // Display search results from each query

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table: " . ucfirst($table) . "</h3>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>";
                foreach ($row as $key => $value) {
                    echo "<strong>$key</strong>: $value ";
                }
                echo "</p>";
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}

// Place the "Back to home" button at the bottom of the results

echo '<a href="home.html"><button>&larr; Back to home</button></a>';
?>

</body>
</html>

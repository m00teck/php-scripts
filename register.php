<?php
// Enable MySQLi error reporting to throw exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection details
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "test";

try {
    // Create a new MySQLi connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Only process the form if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and (optionally) sanitize POST data
        $login = $_POST["login"];
        $pass  = $_POST["password"];
        $email = $_POST["email"];

        // Prepare an SQL statement to insert the data into the users table
        $stmt = $conn->prepare("INSERT INTO users (login, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $login, $pass, $email);
        $stmt->execute();

        echo "New record created successfully.";

        echo $_POST;

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
} catch (mysqli_sql_exception $e) {
    // Catch and display any errors
    echo "Error: " . $e->getMessage();
}
?>
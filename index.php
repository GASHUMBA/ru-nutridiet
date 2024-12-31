<?php
// Step 1: Parse the ClearDB MySQL URL from Heroku Environment Variables
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// Step 2: Extract database connection details
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

// Step 3: Create a new connection to the MySQL database
$conn = new mysqli($server, $username, $password, $db);

// Step 4: Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to the database!";

// Step 5: Query the database (example)
$sql = "SELECT * FROM your_table_name";  // Replace with your table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}

// Step 6: Close the connection
$conn->close();
?>


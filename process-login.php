<?php
$host = "localhost";
$database = "jamborowdb";
$username = "jamborow";
$password = "securep@wd";

$conn = pg_connect("host=$host dbname=$database user=$username password=$password");

if (!$conn) {
    echo "Connection failed.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = $1 AND password = $2";
    $result = pg_query_params($conn, $query, [$username, $password]);

    if ($row = pg_fetch_assoc($result)) {
        echo "Login successful!";
    } else {
        echo "Invalid credentials.";
    }
}

pg_close($conn);
?>

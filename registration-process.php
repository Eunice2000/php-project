<?php
$host = "localhost";
$database = "userdb";
$username = "your_postgres_username";
$password = "your_postgres_password";

$conn = pg_connect("host=$host dbname=$database user=$username password=$password");

if (!$conn) {
    echo "Connection failed.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $occupation = $_POST["occupation"];

    $query = "INSERT INTO users (username, password) VALUES ($1, $2)";
    $result = pg_query_params($conn, $query, [$name, $mobile, $address, $gender, $occupation]);

    if ($result) {
        echo "Registration successful!";
    } else {
        echo "Registration failed.";
    }
}

pg_close($conn);
?>

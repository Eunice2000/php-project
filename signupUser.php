<?php
session_start();

// Handle login logic here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $occupation = $_POST["occupation"];
    $gender = $_POST["gender"];
    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Establish a connection to the PostgreSQL database
    $conn = pg_connect("host=localhost dbname=jamborowdb user=jamborow password=secret123");
    // Check if the username already exists
    $query = "SELECT id FROM users WHERE username = $1";
    $result = pg_query_params($conn, $query, [$email]);
    if (pg_num_rows($result) > 0) {
        echo "email already exists. Please choose a different email.";
    } else {
        // Insert new user into the database
        $insertQuery = "INSERT INTO users (username, password, email, address, occupation, phone, gender) VALUES ($1, $2,$3,$4,$5,$6,$7)";
        $insertResult = pg_query_params($conn, $insertQuery, [$username, $hashedPassword, $email, $address, $occupation, $phone, $gender]);
        if ($insertResult) {
            echo "User registered successfully!";
            header("Location: profile.php");


        } else {
            echo "Error registering user.";

        }
    }
    pg_close($conn);
}
?>
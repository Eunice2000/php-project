<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Establish a connection to the PostgreSQL database
    $conn = pg_connect("host=localhost dbname=jamborowdb user=jamborow password=secret123");
    $query = "SELECT email FROM users WHERE email = $1";
    // Query the database for the provided email and password
    $result = pg_query_params($conn, $query, array($email));
    $row = pg_fetch_assoc($result);

    if ($row) {
        $_SESSION['email'] = $email;
         header("Location: profile.php");

        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
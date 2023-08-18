<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Establish a connection to the PostgreSQL database
    //  $conn = pg_connect("host=localhost dbname=jamborowdb user=jamborow password=secret123");
     $conn = pg_connect("host=localhost dbname=loginData user=postgres password=postgres");

     if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }



    $query = "SELECT * FROM users WHERE email = $1";
    // Query the database for the provided email and password
    $result = pg_query_params($conn, $query, array($email));
    $row = pg_fetch_assoc($result);

    // var_dump( $row);

    if ($row["email"]==$email && password_verify($password, $row['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['login_success'] = true;
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid email or password";
        header("Location: index.php");
        exit(); // Add this exit to stop further execution
    }
}
?>
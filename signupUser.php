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


    // $conn = pg_connect("host=localhost dbname=jamborowdb user=jamborow password=secret123");

    $conn = pg_connect("host=localhost dbname=loginData user=postgres password=postgres");
    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }


    $emailCheckQuery = "SELECT email FROM users WHERE email = $1";
    $emailCheckResult = pg_query_params($conn, $emailCheckQuery, [$email]);
    if (pg_num_rows($emailCheckResult) > 0) {
        $_SESSION['signup_error'] = "Email already exists. Please choose a different email.";

       
    
          header("Location: signup.php"); // Redirect to signup page with error message
        exit();
    }    
    
        else {
            // Insert new user into the database
            $insertQuery = "INSERT INTO users (username, password, email, address, occupation, phone, gender) VALUES ($1, $2, $3, $4, $5, $6, $7)";
            $insertResult = pg_query_params($conn, $insertQuery, [$username, $hashedPassword, $email, $address, $occupation, $phone, $gender]);
            
            if ($insertResult) {
                $_SESSION['signup_success'] = "User registered successfully!";
                header("Location: profile.php"); // Redirect to profile page on success
                exit();
            } else {
                $_SESSION['signup_error'] = "Error registering user.";

                
                header("Location: signup.php"); // Redirect to signup page with error message
                var_dump($_SESSION);
                exit();
            }
        }
        
     
}
?>
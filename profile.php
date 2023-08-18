
<!DOCTYPE html>
<html>
<head>
    <title>jamborow Data Table</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>


<?php 
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// $host = "localhost";
// $port = "5432";
// $dbname = "jamborowdb";
// $user = "jamborow";
// $password = "secret123";

// $connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");





$host = "localhost";
$port = "5432";
$dbname = "loginData";
$user = "postgres";
$password = "postgres";

$connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$connection) {
    die("Connection failed: " . pg_last_error());
}

$query = "SELECT * FROM users";
$result = pg_query($connection, $query);
if (!$result) {
    die("Query execution failed: " . pg_last_error($connection));
}


?>


<body>
    <style>
        .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    text-align: center;
}

.success {
    color: green;
}

.error {
    color: red;
}
    </style>

<div class="container">
<h2>Welcome to your profile</h2>
    <p>Email: <?php echo $_SESSION['email']; ?></p>

</div>





<div class="container mt-4">
    <form action="search.php" method="GET" class="form-inline justify-content-center">
        <div class="form-group mb-2">
            <label for="searchEmail" class="mr-2">Search by Email:</label>
            <input type="text" class="form-control" id="searchEmail" name="searchEmail" placeholder="Enter email">
        </div>
        <button type="submit" class="btn btn-primary mb-2 ml-2">Search</button>
    </form>
</div>

<div id="modal" class="modal">
        <div class="modal-content">
            <?php


if (isset($_SESSION['signup_success'])) {
    echo '<p class="success">' . $_SESSION['signup_success'] . '</p>';
    unset($_SESSION['signup_success']);
} elseif (isset($_SESSION['signup_error'])) {
    echo '<p class="error">' . $_SESSION['signup_error'] . '</p>';
    unset($_SESSION['signup_error']);
}

         
            ?>
        </div>
    </div>


    <div id="signupModal" class="modal">
        <div class="modal-content">
            <?php
            if (isset($_SESSION['signup_success'])) {
                echo '<p class="success">' . $_SESSION['signup_success'] . '</p>';
                unset($_SESSION['signup_success']);
            } elseif (isset($_SESSION['signup_error'])) {
                echo '<p class="error">' . $_SESSION['signup_error'] . '</p>';
                unset($_SESSION['signup_error']);
            }
            ?>
        </div>
    </div>
    
    <script>
        var modal = document.getElementById('modal');
        setTimeout(function() {
            modal.style.display = 'none';
        }, 3000); // Hide modal after 3 seconds


        var signupModal = document.getElementById('signupModal');
        setTimeout(function() {
            signupModal.style.display = 'none';
        }, 3000); // Hide modal after 3 seconds
    </script>



    <div class="container mt-4">


<table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>occupation</th>
                </tr>
            </thead>
            <tbody>

            <?php
$htmlTable = '';

while ($row = pg_fetch_assoc($result)) {
    // echo "ID: " . $row['id'] . ", Name: " . $row['username'] .", phone: " . $row['phone'] .", occupation: " . $row['occupation'] .", email: " . $row['email'] .", address: " . $row['address'] .", gender: " . $row['gender'] . "<br>";

$htmlTable .= '<tr>
    <td>' . $row['id'] . '</td>
    <td>' . $row['username'] . '</td>
    <td>' . $row['email'] . '</td>
    <td>' . $row['phone'] . '</td>
    <td>' . $row['occupation'] . '</td>
   </tr>';
  
}


// Display the HTML table
echo $htmlTable;


pg_close($connection);


?>

</tbody>
        </table>
    </div>
      <!-- Include Bootstrap JS and jQuery -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



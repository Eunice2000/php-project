
<!DOCTYPE html>
<html>
<head>
    <title>jamborow Data Table</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">


<?php 

$host = "localhost";
$port = "5432";
$dbname = "jamborowdb";
$user = "jamborow";
$password = "secret123";

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


<table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
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



<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['searchEmail'])) {
    $searchEmail = $_GET['searchEmail'];

    $host = "localhost";
    $port = "5432";
    $dbname = "loginData";
    $user = "postgres";
    $password = "postgres";

    $connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    if (!$connection) {
        die("Connection failed: " . pg_last_error());
    }

    $query = "SELECT * FROM users WHERE email = $1";
    $result = pg_query_params($connection, $query, array($searchEmail));
    if (!$result) {
        die("Query execution failed: " . pg_last_error($connection));
    }

    $htmlTable = '';
    while ($row = pg_fetch_assoc($result)) {
        $htmlTable .= '<tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['username'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['phone'] . '</td>
            <td>' . $row['occupation'] . '</td>
        </tr>';
    }

    pg_close($connection);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Search Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div>

    <a href="./profile.php" class="btn btn-secondary">Back to Profile</a>
    </div>
    <div class="container mt-4">
        <h2>User Search Results</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Phone</th>
                    <th>Occupation</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $htmlTable; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

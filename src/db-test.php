<?php
$server = "mysql-container";
$username = "testuser";
$password = "mysecret";

try {
    // Connect to the testdb database
    $dbname = "testdb";
    $conn = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database test</title>
</head>
<body>
    <h1>Database test</h1>
    <?php
        echo "<p>Connected to database '$dbname' successfully.</p>";
    ?>
</body>
</html>
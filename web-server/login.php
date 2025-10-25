<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // VULNERABLE CODE - SQL Injection
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $pdo->query($sql);
    
    if ($result->rowCount() > 0) {
        $user = $result->fetch(PDO::FETCH_ASSOC);
        echo "<h1>Login Successful!</h1>";
        echo "<p>Welcome, {$user['username']}</p>";
        echo "<p>Email: {$user['email']}</p>";
    } else {
        echo "<h1>Login Failed</h1>";
        echo "<p>Invalid username or password</p>";
    }
    
    echo "<p>SQL Query: $sql</p>";
    echo "<a href='/'>Back to Home</a>";
}
?>

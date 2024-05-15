<?php

// Database connection settings
$host = 'localhost'; 
$dbname = 'magic_spoon';
$username = 'root'; 
$password = ''; 

// Get user input (e.g., from a form)
$email = $_POST['email'];
$password = $_POST['password'];

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions for error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare the SQL statement
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    
    // Bind parameters
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch the user record
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if a user with the given email and password exists
    if ($user) {
        // User authenticated, do something (e.g., set session variables)
        // Redirect to the user's dashboard or any other page
        header('Location: dashboard.php');
        exit();
    } else {
        // Invalid credentials, redirect back to the login page
        header('Location: login.php?error=invalid_credentials');
        exit();
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}

?>

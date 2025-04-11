<?php
session_start(); // Start the session

// Database configuration
$host = 'localhost'; // Database host
$db_name = 'opti'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

// Function to get the database connection
function getDBConnection() {
    global $host, $db_name, $username, $password;
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Function to register a user
function registerUser ($username, $password, $role) {
    $pdo = getDBConnection();
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
    
    // Execute the statement
    return $stmt->execute(['username' => $username, 'password' => $hashedPassword, 'role' => $role]);
}

// Function to log in a user
function login($username, $password) {
    $pdo = getDBConnection();

    // Prepare the SQL statement
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and verify password
    if ($user && password_verify($password, $user['password'])) {
        // Store user information in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Store user role
        return true; // Login successful
    } else {
        return false; // Login failed
    }
}

// Check if the form is submitted for registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate input
    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
    } else {
        // Attempt to register the user
        if (registerUser ($username, $password, $role)) {
            echo "Registration successful!";
        } else {
            echo "Registration failed. Username may already exist.";
        }
    }
}

// Check if the form is submitted for login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
    } else {
        // Attempt to log in
        if (login($username, $password)) {
            echo "Login successful! Welcome, " . htmlspecialchars($username) . ".";
            // Redirect to a protected page or dashboard
            // header("Location: dashboard.php");
            // exit();
        } else {
            echo "Invalid username or password.";
        }
    }
}
?>
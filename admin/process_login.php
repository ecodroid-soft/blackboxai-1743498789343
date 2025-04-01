<?php
require_once '../config.php';

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (!$username || !$password) {
        $_SESSION['login_error'] = 'Please provide both username and password.';
        header('Location: login.php');
        exit;
    }

    try {
        // Prepare and execute the query to find the admin
        $stmt = $pdo->prepare("SELECT id, username, password FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify credentials
        if ($admin && password_verify($password, $admin['password'])) {
            // Regenerate session ID for security
            session_regenerate_id(true);
            
            // Set admin session variables
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            
            // Set success message
            setFlashMessage('Welcome back, ' . htmlspecialchars($admin['username']) . '!');
            
            // Redirect to dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            $_SESSION['login_error'] = 'Invalid username or password.';
            header('Location: login.php');
            exit;
        }
    } catch (PDOException $e) {
        error_log('Login error: ' . $e->getMessage());
        $_SESSION['login_error'] = 'An error occurred during login. Please try again.';
        header('Location: login.php');
        exit;
    }
} else {
    // If someone tries to access this file directly without POST
    header('Location: login.php');
    exit;
}
?>
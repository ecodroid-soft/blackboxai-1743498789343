<?php
require_once '../config.php';

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Destroy the session
session_destroy();

// Set logout message
session_start();
setFlashMessage('You have been successfully logged out.', 'success');

// Redirect to login page
header('Location: login.php');
exit;
?>
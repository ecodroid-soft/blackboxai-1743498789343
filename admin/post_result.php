<?php
require_once '../config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $game_date = filter_input(INPUT_POST, 'game_date', FILTER_SANITIZE_STRING);
    $result_numbers = filter_input(INPUT_POST, 'result_numbers', FILTER_SANITIZE_STRING);
    $commentary = filter_input(INPUT_POST, 'commentary', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (!$game_date || !$result_numbers) {
        setFlashMessage('Please provide both game date and result numbers.', 'error');
        header('Location: dashboard.php');
        exit;
    }

    // Validate date format
    $date = DateTime::createFromFormat('Y-m-d', $game_date);
    if (!$date || $date->format('Y-m-d') !== $game_date) {
        setFlashMessage('Invalid date format.', 'error');
        header('Location: dashboard.php');
        exit;
    }

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("
            INSERT INTO results (game_date, result_numbers, commentary) 
            VALUES (?, ?, ?)
        ");

        // Execute with the parameters
        $stmt->execute([$game_date, $result_numbers, $commentary]);

        // Set success message
        setFlashMessage('Result posted successfully!', 'success');
    } catch (PDOException $e) {
        // Log the error
        error_log('Error posting result: ' . $e->getMessage());
        
        // Set error message
        setFlashMessage('Error posting result. Please try again.', 'error');
    }

    // Redirect back to dashboard
    header('Location: dashboard.php');
    exit;
} else {
    // If someone tries to access this file directly without POST
    header('Location: dashboard.php');
    exit;
}
?>
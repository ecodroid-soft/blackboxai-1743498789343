<?php 
require_once 'config.php';

// Initialize results array
$results = [];
$error = null;

// Only try to fetch results if we have a database connection
if ($pdo !== null) {
    try {
        $stmt = $pdo->query("SELECT * FROM results ORDER BY game_date DESC, created_at DESC");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $error = "Error fetching results: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Results - Devil Satta King</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-black shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="index.php" class="text-white font-bold text-xl">DEVIL SATTA KING</a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-white hover:text-gray-300">Home</a>
                    <a href="results.php" class="text-white hover:text-gray-300">Results</a>
                    <a href="admin/login.php" class="text-white hover:text-gray-300">Admin Login</a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="mobile-menu-button text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden">
            <a href="index.php" class="block py-2 px-4 text-white hover:bg-gray-700">Home</a>
            <a href="results.php" class="block py-2 px-4 text-white hover:bg-gray-700">Results</a>
            <a href="admin/login.php" class="block py-2 px-4 text-white hover:bg-gray-700">Admin Login</a>
        </div>
    </nav>

    <!-- Results Section -->
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-center">Latest Game Results</h1>
        
        <?php if ($pdo === null): ?>
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Notice: </strong>
                <span class="block sm:inline">The results system is currently undergoing maintenance. Please check back later.</span>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php elseif (empty($results)): ?>
            <div class="text-center py-8">
                <div class="text-gray-500 text-xl">
                    <i class="fas fa-info-circle mr-2"></i>
                    No results available yet
                </div>
            </div>
        <?php else: ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($results as $result): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="bg-red-600 text-white px-4 py-2">
                            <div class="font-semibold">
                                <?php echo date('d M Y', strtotime($result['game_date'])); ?>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="text-2xl font-bold text-center mb-2">
                                <?php echo htmlspecialchars($result['result_numbers']); ?>
                            </div>
                            <?php if (!empty($result['commentary'])): ?>
                                <div class="text-gray-600 text-sm mt-2">
                                    <?php echo htmlspecialchars($result['commentary']); ?>
                                </div>
                            <?php endif; ?>
                            <div class="text-gray-400 text-xs mt-2">
                                Posted: <?php echo date('h:i A', strtotime($result['created_at'])); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-black text-white py-8 mt-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center">
                <p>&copy; <?php echo date('Y'); ?> Devil Satta King. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
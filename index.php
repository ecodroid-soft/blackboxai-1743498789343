<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devil Satta King - Welcome</title>
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

    <!-- Hero Section -->
    <div class="relative h-[500px]">
        <div class="absolute inset-0">
            <img src="https://source.unsplash.com/featured/?casino,gambling" alt="Hero Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>
        <div class="relative max-w-6xl mx-auto px-4 h-full flex items-center">
            <div class="text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to Devil Satta King</h1>
                <p class="text-xl md:text-2xl mb-8">Your trusted source for Satta King results</p>
                <a href="results.php" class="bg-red-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-red-700 transition duration-300">View Latest Results</a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-6xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-red-600 text-3xl mb-4">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Live Results</h3>
                <p class="text-gray-600">Get instant access to the latest Satta King results updated regularly.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-red-600 text-3xl mb-4">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Result History</h3>
                <p class="text-gray-600">Access complete history of past results with detailed information.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-red-600 text-3xl mb-4">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Mobile Friendly</h3>
                <p class="text-gray-600">Access results anywhere, anytime from your mobile device.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black text-white py-8">
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
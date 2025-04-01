<?php
require_once '../config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch existing results
try {
    $stmt = $pdo->query("SELECT * FROM results ORDER BY game_date DESC, created_at DESC LIMIT 10");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log('Error fetching results: ' . $e->getMessage());
    $error = "Error fetching results. Please try again later.";
}

// Get flash message if any
$flash = getFlashMessage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Devil Satta King</title>
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
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <span class="text-white font-bold text-xl">Admin Dashboard</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-white">
                        <i class="fas fa-user mr-2"></i>
                        <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
                    </span>
                    <a href="logout.php" class="text-white hover:text-red-500">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Flash Messages -->
        <?php if ($flash): ?>
            <div class="mb-4 p-4 rounded-lg <?php echo $flash['type'] === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                <?php echo htmlspecialchars($flash['message']); ?>
            </div>
        <?php endif; ?>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Post New Result Form -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Post New Result</h2>
                <form action="post_result.php" method="POST" class="space-y-4">
                    <div>
                        <label for="game_date" class="block text-gray-700 font-semibold mb-2">Game Date</label>
                        <input type="date" id="game_date" name="game_date" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                               value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div>
                        <label for="result_numbers" class="block text-gray-700 font-semibold mb-2">Result Numbers</label>
                        <input type="text" id="result_numbers" name="result_numbers" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                               placeholder="Enter result numbers">
                    </div>

                    <div>
                        <label for="commentary" class="block text-gray-700 font-semibold mb-2">Commentary (Optional)</label>
                        <textarea id="commentary" name="commentary" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                                  placeholder="Add any additional comments"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <i class="fas fa-plus-circle mr-2"></i> Post Result
                    </button>
                </form>
            </div>

            <!-- Recent Results -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Recent Results</h2>
                <?php if (isset($error)): ?>
                    <div class="text-red-600 mb-4"><?php echo htmlspecialchars($error); ?></div>
                <?php elseif (empty($results)): ?>
                    <p class="text-gray-500">No results posted yet.</p>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numbers</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($results as $result): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php echo date('d M Y', strtotime($result['game_date'])); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap font-semibold">
                                            <?php echo htmlspecialchars($result['result_numbers']); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo date('h:i A', strtotime($result['created_at'])); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Simple form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const resultNumbers = document.getElementById('result_numbers').value.trim();
            if (!resultNumbers) {
                e.preventDefault();
                alert('Please enter the result numbers');
            }
        });
    </script>
</body>
</html>
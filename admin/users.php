<?php
$pageTitle = "Users";
include '../includes/config.php';
include '../partials/sidebar.php';

// Example PHP Logic to Fetch Users (Replace with Your Actual Query)
$users = [
    ['name' => 'John Doe', 'email' => 'john@example.com'],
    ['name' => 'Jane Smith', 'email' => 'jane@example.com'],
    ['name' => 'Sam Wilson', 'email' => 'sam@example.com'],
    ['name' => 'Sam Wilson', 'email' => 'sam@example.com'],
    ['name' => 'Sam Wilson', 'email' => 'sam@example.com'],
    ['name' => 'Sam Wilson', 'email' => 'sam@example.com'],
    ['name' => 'Sam Wilson Partey', 'email' => 'sam@example.com'],
    ['name' => 'Sam Wilson', 'email' => 'sam@example.com'],
    ['name' => 'Sam Wilson', 'email' => 'sam@example.com'],
    // Add more users...
];

$totalUsers = count($users);

?>



    <!-- Main Section -->
    <main class="mt-16 lg:mt-0 lg:ml-64 bg-[#2b2929] p-6 overflow-y-auto h-screen">
        <!-- Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-[#1a1818] text-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold">Total Users</h3>
                <p class="text-3xl mt-2"><?php echo $totalUsers; ?></p>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-[#1a1818] shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">User List</h3>
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-left text-red-700">
                        <th class="p-3 border border-gray-300">#</th>
                        <th class="p-3 border border-gray-300">Name</th>
                        <th class="p-3 border border-gray-300">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="p-3 border border-gray-300"><?php echo $index + 1; ?></td>
                            <td class="p-3 border border-gray-300"><?php echo htmlspecialchars($user['name']); ?></td>
                            <td class="p-3 border border-gray-300"><?php echo htmlspecialchars($user['email']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</div>



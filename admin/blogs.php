<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Product Name</th>
                <th scope="col" class="px-6 py-3">Color</th>
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3">Price</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $index => $product): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-[#303030]">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo htmlspecialchars($product['color']); ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo htmlspecialchars($product['category']); ?>
                    </td>
                    <td class="px-6 py-4">
                        $<?php echo number_format($product['price'], 2); ?>
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                            Delete
                        </button>
                        <button 
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded"
                            onclick="openEditModal('<?php echo htmlspecialchars(json_encode($product), ENT_QUOTES); ?>')">
                            Edit
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
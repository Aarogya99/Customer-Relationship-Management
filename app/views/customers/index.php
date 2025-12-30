<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Customers</h1>
        <p class="text-gray-500 mt-1">Manage your customer relationships</p>
    </div>
    <?php if (($_SESSION['user_role'] ?? '') === 'admin'): ?>
        <a href="<?= BASE_URL ?>/customer/create"
            class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:bg-indigo-700 transition flex items-center font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Customer
        </a>
    <?php endif; ?>
</div>

<div class="bg-white shadow-xl shadow-gray-200/50 rounded-2xl overflow-hidden border border-gray-100">
    <table class="min-w-full divide-y divide-gray-100">
        <thead class="bg-gray-50/50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Company
                </th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Contact
                </th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php foreach ($customers as $customer): ?>
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div
                                    class="h-10 w-10 rounded-full bg-gradient-to-tr from-blue-400 to-indigo-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                    <?php echo substr($customer['name'], 0, 1); ?>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-gray-900">
                                    <?php echo htmlspecialchars($customer['name']); ?>
                                </div>
                                <div class="text-xs text-gray-400">Added
                                    <?php echo date('M d', strtotime($customer['created_at'])); ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                            <?php echo htmlspecialchars($customer['company'] ?? 'N/A'); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-600 flex items-center mb-1">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <?php echo htmlspecialchars($customer['email']); ?>
                        </div>
                        <?php if ($customer['phone']): ?>
                            <div class="text-sm text-gray-600 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <?php echo htmlspecialchars($customer['phone']); ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <a href="<?= BASE_URL ?>/customer/edit?id=<?php echo $customer['id']; ?>"
                                class="text-indigo-600 hover:text-indigo-900 font-semibold hover:underline flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit
                            </a>
                            <?php if (($_SESSION['user_role'] ?? '') === 'admin'): ?>
                                <form action="<?= BASE_URL ?>/customer/delete" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                    <input type="hidden" name="csrf_token"
                                        value="<?php echo \App\Core\Validator::generateCsrf(); ?>">
                                    <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 font-semibold hover:underline flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
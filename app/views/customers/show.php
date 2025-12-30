<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="mb-6">
    <a href="<?= BASE_URL ?>/customer" class="text-indigo-600 hover:text-indigo-800 flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        Back to Customers
    </a>
</div>

<div class="bg-white shadow rounded-2xl overflow-hidden">
    <div class="px-6 py-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <div class="flex items-center">
            <div
                class="h-16 w-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-2xl font-bold uppercase shadow-lg">
                <?php echo substr($customer['name'], 0, 1); ?>
            </div>
            <div class="ml-6">
                <h1 class="text-3xl font-bold text-gray-900"><?php echo htmlspecialchars($customer['name']); ?></h1>
                <p class="text-gray-500 text-lg"><?php echo htmlspecialchars($customer['company'] ?? 'No Company'); ?>
                </p>
            </div>
        </div>
        <div>
            <span class="px-4 py-2 bg-green-100 text-green-800 text-sm font-semibold rounded-full">Active
                Customer</span>
        </div>
    </div>

    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-10">
        <div>
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Contact Information</h3>
            <div class="space-y-4">
                <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                    <div class="p-2 bg-white rounded-lg shadow-sm text-gray-400 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Email Address</p>
                        <p class="font-medium text-gray-900"><?php echo htmlspecialchars($customer['email']); ?></p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                    <div class="p-2 bg-white rounded-lg shadow-sm text-gray-400 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Phone Number</p>
                        <p class="font-medium text-gray-900"><?php echo htmlspecialchars($customer['phone']); ?></p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                    <div class="p-2 bg-white rounded-lg shadow-sm text-gray-400 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Address</p>
                        <p class="font-medium text-gray-900">
                            <?php echo nl2br(htmlspecialchars($customer['address'])); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Activity & Notes</h3>
            <div
                class="bg-gray-50 rounded-xl p-6 h-full flex items-center justify-center text-gray-400 border border-dashed border-gray-200">
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    <p>Feature coming soon...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
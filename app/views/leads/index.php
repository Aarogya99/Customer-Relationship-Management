<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Leads</h1>
        <p class="text-gray-500 mt-1">Track potential opportunities</p>
    </div>
    <a href="<?= BASE_URL ?>/lead/create"
        class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl shadow-lg hover:bg-indigo-700 transition flex items-center font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Lead
    </a>
</div>

<div class="bg-white shadow-xl shadow-gray-200/50 rounded-2xl overflow-hidden border border-gray-100">
    <table class="min-w-full divide-y divide-gray-100">
        <thead class="bg-gray-50/50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Name</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Contact</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Source</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Created</th>
                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (empty($leads)): ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        No leads found. <a href="<?= BASE_URL ?>/lead/create" class="text-indigo-600 font-medium">Create
                            your first lead</a>.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($leads as $lead): ?>
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-bold text-gray-900"><?= htmlspecialchars($lead['name']) ?></div>
                            <div class="text-xs text-gray-400"><?= htmlspecialchars($lead['company'] ?? '') ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-600"><?= htmlspecialchars($lead['email']) ?></div>
                            <div class="text-xs text-gray-400"><?= htmlspecialchars($lead['phone']) ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full border border-gray-200"><?= htmlspecialchars($lead['source']) ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full border border-blue-100"><?= htmlspecialchars($lead['status']) ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= date('M d, Y', strtotime($lead['created_at'])) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="<?= BASE_URL ?>/lead/edit?id=<?php echo $lead['id']; ?>"
                                    class="text-indigo-600 hover:text-indigo-900 font-semibold hover:underline flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="<?= BASE_URL ?>/lead/delete" method="POST" class="inline"
                                    onsubmit="return confirm('Delete this lead?');">
                                    <input type="hidden" name="csrf_token"
                                        value="<?php echo \App\Core\Validator::generateCsrf(); ?>">
                                    <input type="hidden" name="id" value="<?php echo $lead['id']; ?>">
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
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
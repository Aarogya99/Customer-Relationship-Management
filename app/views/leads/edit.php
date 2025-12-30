<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="mb-6">
    <a href="<?= BASE_URL ?>/lead" class="text-indigo-600 hover:text-indigo-800 flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        Back to Leads
    </a>
</div>

<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
        <h2 class="text-2xl font-bold text-gray-800">Edit Lead</h2>
        <p class="text-gray-500 text-sm mt-1">Update lead information.</p>
    </div>

    <div class="p-8">
        <?php if (isset($error)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 text-sm">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/lead/update" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo \App\Core\Validator::generateCsrf(); ?>">
            <input type="hidden" name="id" value="<?php echo $lead['id']; ?>">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" required value="<?php echo htmlspecialchars($lead['name']); ?>"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Company Name</label>
                    <input type="text" name="company" value="<?php echo htmlspecialchars($lead['company'] ?? ''); ?>"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($lead['email'] ?? ''); ?>"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" name="phone" value="<?php echo htmlspecialchars($lead['phone'] ?? ''); ?>"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Lead Source</label>
                    <select name="source"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                        <option value="Website" <?= ($lead['source'] == 'Website') ? 'selected' : '' ?>>Website</option>
                        <option value="Referral" <?= ($lead['source'] == 'Referral') ? 'selected' : '' ?>>Referral</option>
                        <option value="Cold Call" <?= ($lead['source'] == 'Cold Call') ? 'selected' : '' ?>>Cold Call
                        </option>
                        <option value="Social Media" <?= ($lead['source'] == 'Social Media') ? 'selected' : '' ?>>Social
                            Media</option>
                        <option value="Other" <?= ($lead['source'] == 'Other') ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                        <option value="New" <?= ($lead['status'] == 'New') ? 'selected' : '' ?>>New</option>
                        <option value="Contacted" <?= ($lead['status'] == 'Contacted') ? 'selected' : '' ?>>Contacted
                        </option>
                        <option value="Qualified" <?= ($lead['status'] == 'Qualified') ? 'selected' : '' ?>>Qualified
                        </option>
                        <option value="Converted" <?= ($lead['status'] == 'Converted') ? 'selected' : '' ?>>Converted
                        </option>
                        <option value="Lost" <?= ($lead['status'] == 'Lost') ? 'selected' : '' ?>>Lost</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                <textarea name="notes" rows="3"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none"><?php echo htmlspecialchars($lead['notes'] ?? ''); ?></textarea>
            </div>

            <div class="pt-4 flex items-center justify-end border-t border-gray-100 mt-6">
                <button type="submit"
                    class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 transform transition hover:-translate-y-0.5">
                    Update Lead
                </button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
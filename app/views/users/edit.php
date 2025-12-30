<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="mb-6">
    <a href="<?= BASE_URL ?>/users" class="text-indigo-600 hover:text-indigo-800 flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        Back to Users
    </a>
</div>

<div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
        <h2 class="text-2xl font-bold text-gray-800">Edit User</h2>
    </div>

    <div class="p-8">
        <?php if (isset($error)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 text-sm">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/users/edit/<?= $user['id'] ?>" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo \App\Core\Validator::generateCsrf(); ?>">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 transition outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 transition outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                <select name="role"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 transition outline-none">
                    <option value="staff" <?= $user['role'] == 'staff' ? 'selected' : '' ?>>Staff</option>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password (Leave blank to keep
                    current)</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 transition outline-none">
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold shadow-lg hover:bg-indigo-700 transition transform hover:-translate-y-0.5">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Create New User</h2>

    <form action="<?= BASE_URL ?>/users/create" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo \App\Core\Validator::generateCsrf(); ?>">

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" name="password" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
            <select name="role"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Create User
            </button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
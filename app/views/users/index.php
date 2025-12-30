<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">User Management</h1>
    <a href="<?= BASE_URL ?>/users/create" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Add
        New User</a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($users as $user): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <?php echo htmlspecialchars($user['name']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?php echo htmlspecialchars($user['email']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $user['role'] === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'; ?>">
                            <?php echo ucfirst(htmlspecialchars($user['role'])); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $user['created_at']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?= BASE_URL ?>/users/edit/<?= $user['id'] ?>"
                            class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <a href="<?= BASE_URL ?>/users/delete/<?= $user['id'] ?>" class="text-red-600 hover:text-red-900"
                            onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="mb-6">
    <a href="<?= BASE_URL ?>/task" class="text-indigo-600 hover:text-indigo-800 flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        Back to Tasks
    </a>
</div>

<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
        <h2 class="text-2xl font-bold text-gray-800">Edit Task</h2>
        <p class="text-gray-500 text-sm mt-1">Update task details.</p>
    </div>

    <div class="p-8">
        <?php if (isset($error)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 text-sm">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/task/update" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo \App\Core\Validator::generateCsrf(); ?>">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Task Title <span
                        class="text-red-500">*</span></label>
                <input type="text" name="title" required value="<?php echo htmlspecialchars($task['title']); ?>"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none"><?php echo htmlspecialchars($task['description'] ?? ''); ?></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Priority</label>
                    <select name="priority"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                        <option value="Low" <?= ($task['priority'] == 'Low') ? 'selected' : '' ?>>Low</option>
                        <option value="Medium" <?= ($task['priority'] == 'Medium') ? 'selected' : '' ?>>Medium</option>
                        <option value="High" <?= ($task['priority'] == 'High') ? 'selected' : '' ?>>High</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                        <option value="Pending" <?= ($task['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                        <option value="In Progress" <?= ($task['status'] == 'In Progress') ? 'selected' : '' ?>>In Progress
                        </option>
                        <option value="Completed" <?= ($task['status'] == 'Completed') ? 'selected' : '' ?>>Completed
                        </option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Due Date</label>
                <input type="date" name="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>"
                    min="<?= date('Y-m-d') ?>"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
            </div>

            <div class="pt-4 flex items-center justify-end border-t border-gray-100 mt-6">
                <button type="submit"
                    class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 transform transition hover:-translate-y-0.5">
                    Update Task
                </button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
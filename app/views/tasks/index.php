<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Tasks</h1>
        <p class="text-gray-500 mt-1">Manage your daily priorities</p>
    </div>
    <a href="<?= BASE_URL ?>/task/create"
        class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl shadow-lg hover:bg-indigo-700 transition flex items-center font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        New Task
    </a>
</div>

<div class="bg-white shadow-xl shadow-gray-200/50 rounded-2xl overflow-hidden border border-gray-100">
    <ul class="divide-y divide-gray-100">
        <?php if (empty($tasks)): ?>
            <li class="px-6 py-12 text-center text-gray-500">
                You have no tasks pending. <a href="<?= BASE_URL ?>/task/create" class="text-indigo-600 font-medium">Create
                    a task</a>.
            </li>
        <?php else: ?>
            <?php foreach ($tasks as $task): ?>
                <?php
                $priorityColor = match ($task['priority']) {
                    'Urgent' => 'text-red-600 bg-red-50 border-red-200',
                    'High' => 'text-orange-600 bg-orange-50 border-orange-200',
                    'Medium' => 'text-blue-600 bg-blue-50 border-blue-200',
                    default => 'text-gray-600 bg-gray-50 border-gray-200',
                };
                ?>
                <li class="flex items-center justify-between p-6 hover:bg-gray-50 transition">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-0.5">
                            <?php if ($task['status'] !== 'Completed'): ?>
                                <form action="<?= BASE_URL ?>/task/complete" method="POST">
                                    <input type="hidden" name="csrf_token"
                                        value="<?php echo \App\Core\Validator::generateCsrf(); ?>">
                                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                    <input type="checkbox" onchange="this.form.submit()"
                                        class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 cursor-pointer"
                                        title="Mark as Completed">
                                </form>
                            <?php else: ?>
                                <input type="checkbox" disabled checked
                                    class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 opacity-50 cursor-not-allowed">
                            <?php endif; ?>
                        </div>
                        <div class="ml-4">
                            <h3
                                class="text-lg font-medium text-gray-900 <?= $task['status'] == 'Completed' ? 'line-through text-gray-400' : '' ?>">
                                <?= htmlspecialchars($task['title']) ?>
                            </h3>
                            <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($task['description']) ?></p>
                            <div class="mt-2 flex items-center gap-3">
                                <span
                                    class="px-2 py-0.5 text-xs font-bold rounded-md border <?= $priorityColor ?>"><?= htmlspecialchars($task['priority']) ?></span>
                                <span class="text-xs text-gray-400 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Due <?= date('M d', strtotime($task['due_date'])) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 ml-4">
                        <a href="<?= BASE_URL ?>/task/edit?id=<?php echo $task['id']; ?>"
                            class="text-indigo-600 hover:text-indigo-900 font-semibold hover:underline flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit
                        </a>
                        <form action="<?= BASE_URL ?>/task/delete" method="POST" class="inline"
                            onsubmit="return confirm('Delete this task?');">
                            <input type="hidden" name="csrf_token" value="<?php echo \App\Core\Validator::generateCsrf(); ?>">
                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
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
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
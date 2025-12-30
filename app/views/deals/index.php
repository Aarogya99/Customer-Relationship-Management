<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Pipeline</h1>
        <p class="text-gray-500 mt-1">Manage deal flow</p>
    </div>
    <a href="<?= BASE_URL ?>/deal/create"
        class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl shadow-lg hover:bg-indigo-700 transition flex items-center font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        New Deal
    </a>
</div>

<!-- Kanban Board -->
<div class="flex overflow-x-auto pb-8 gap-6">
    <?php
    $stages = [
        'Prospect' => 'bg-blue-50 border-blue-200 text-blue-700',
        'Negotiation' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
        'Won' => 'bg-green-50 border-green-200 text-green-700',
        'Lost' => 'bg-gray-50 border-gray-200 text-gray-700'
    ];
    ?>

    <?php foreach ($stages as $stageName => $stageClass): ?>
        <div class="w-80 flex-shrink-0">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700"><?= $stageName ?></h3>
                <span
                    class="text-xs bg-gray-100 px-2 py-1 rounded-full text-gray-500"><?= count($pipeline[$stageName] ?? []) ?></span>
            </div>

            <div class="space-y-4">
                <?php if (empty($pipeline[$stageName])): ?>
                    <div
                        class="h-24 border-2 border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 text-sm">
                        Empty Stage
                    </div>
                <?php else: ?>
                    <?php foreach ($pipeline[$stageName] as $deal): ?>
                        <div
                            class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer card-hover">
                            <h4 class="font-bold text-gray-800"><?= htmlspecialchars($deal['name']) ?></h4>
                            <p class="text-xs text-gray-500 mt-1">
                                <?= htmlspecialchars($deal['customer_name'] ?? 'Unknown Customer') ?></p>

                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-sm font-bold text-gray-700">$<?= number_format($deal['amount']) ?></span>
                                <?php if ($deal['close_date']): ?>
                                    <span class="text-xs text-gray-400"><?= date('M d', strtotime($deal['close_date'])) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
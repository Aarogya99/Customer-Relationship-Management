<?php include __DIR__ . '/../layouts/header.php'; ?>

<!-- Add Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- KPI Cards Container -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1: Total Customers -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Customers</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                    <?php echo number_format($stats['total_customers']); ?>
                </h3>
                <div class="mt-2 flex items-center text-sm text-emerald-600 font-medium">
                    <span class="bg-emerald-50 px-2 py-0.5 rounded text-xs">▲ 12%</span>
                    <span class="text-slate-400 ml-2 font-normal">vs last month</span>
                </div>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                <!-- Icon Users -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Card 2: Active Leads -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Active Leads</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                    <?php echo number_format($stats['total_leads']); ?>
                </h3>
                <div class="mt-2 flex items-center text-sm text-blue-600 font-medium">
                    <span class="bg-blue-50 px-2 py-0.5 rounded text-xs">New</span>
                    <span class="text-slate-400 ml-2 font-normal">opportunities</span>
                </div>
            </div>
            <div class="p-3 bg-yellow-50 text-yellow-600 rounded-xl">
                <!-- Icon Bulb -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Card 3: Revenue -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Projected Revenue</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                    $<?php echo number_format($stats['active_deals'] * 12500); ?></h3>
                <div class="mt-2 flex items-center text-sm text-emerald-600 font-medium">
                    <span class="bg-emerald-50 px-2 py-0.5 rounded text-xs">▲ 5%</span>
                    <span class="text-slate-400 ml-2 font-normal">weighted pipeline</span>
                </div>
            </div>
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                <!-- Icon Dollar -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Card 4: Tasks -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pending Tasks</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                    <?php echo number_format($stats['pending_tasks']); ?>
                </h3>
                <div class="mt-2 flex items-center text-sm text-rose-600 font-medium">
                    <span class="bg-rose-50 px-2 py-0.5 rounded text-xs">Use Caution</span>
                    <span class="text-slate-400 ml-2 font-normal">due soon</span>
                </div>
            </div>
            <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                <!-- Icon Clipboard -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- Left Column: Chart & Quick Actions -->
    <div class="lg:col-span-2 space-y-8">

        <!-- Sales Chart -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-slate-800">Revenue Analytics</h3>
                <select
                    class="text-sm border-none bg-slate-50 rounded-lg p-2 text-slate-600 focus:ring-0 cursor-pointer">
                    <option>Last 6 Months</option>
                    <option>This Year</option>
                </select>
            </div>
            <div class="h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800">Recent Activity</h3>
                <button class="text-blue-600 text-sm font-medium hover:underline">View All</button>
            </div>
            <div class="space-y-6">
                <!-- Activity Item -->
                <div class="flex group">
                    <div class="flex-shrink-0 relative">
                        <div
                            class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 ring-4 ring-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                </path>
                            </svg>
                        </div>
                        <div class="absolute top-10 left-5 w-0.5 h-full bg-slate-100 group-last:hidden"></div>
                    </div>
                    <div class="ml-4 pb-2">
                        <p class="text-sm font-medium text-slate-900">New Customer Added</p>
                        <p class="text-sm text-slate-500">Wayne Enterprises was added by <strong>Admin</strong></p>
                        <p class="text-xs text-slate-400 mt-1">2 hours ago</p>
                    </div>
                </div>

                <!-- Activity Item -->
                <div class="flex group">
                    <div class="flex-shrink-0 relative">
                        <div
                            class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 ring-4 ring-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-10 left-5 w-0.5 h-full bg-slate-100 group-last:hidden"></div>
                    </div>
                    <div class="ml-4 pb-2">
                        <p class="text-sm font-medium text-slate-900">Task Completed</p>
                        <p class="text-sm text-slate-500">Prepare Q3 Report marked as done</p>
                        <p class="text-xs text-slate-400 mt-1">5 hours ago</p>
                    </div>
                </div>

                <!-- Activity Item -->
                <div class="flex group">
                    <div class="flex-shrink-0 relative">
                        <div
                            class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 ring-4 ring-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <!-- No line for last item -->
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-900">New Deal Created</p>
                        <p class="text-sm text-slate-500">Stark Industries Contract ($1.2M)</p>
                        <p class="text-xs text-slate-400 mt-1">1 day ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Quick Actions & Mini Widgets -->
    <div class="lg:col-span-1 space-y-8">

        <!-- Quick Actions -->
        <div
            class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-2xl p-6 shadow-xl text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>

            <h3 class="text-lg font-bold mb-4 relative z-10">Quick Actions</h3>
            <p class="text-indigo-100/80 mb-6 text-sm relative z-10">Manage your CRM efficiently with instant access
                buttons.</p>

            <div class="space-y-3 relative z-10">
                <a href="<?= BASE_URL ?>/customer/create"
                    class="flex items-center p-3 bg-white/10 hover:bg-white/20 rounded-xl transition backdrop-blur-sm border border-white/10 group">
                    <div class="p-2 bg-white/20 rounded-lg mr-3 group-hover:scale-110 transition-transform"><svg
                            class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg></div>
                    <span class="font-medium">Add Customer</span>
                </a>
                <a href="<?= BASE_URL ?>/lead"
                    class="flex items-center p-3 bg-white/10 hover:bg-white/20 rounded-xl transition backdrop-blur-sm border border-white/10 group">
                    <div class="p-2 bg-white/20 rounded-lg mr-3 group-hover:scale-110 transition-transform"><svg
                            class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg></div>
                    <span class="font-medium">Create Lead</span>
                </a>
                <a href="<?= BASE_URL ?>/task"
                    class="flex items-center p-3 bg-white/10 hover:bg-white/20 rounded-xl transition backdrop-blur-sm border border-white/10 group">
                    <div class="p-2 bg-white/20 rounded-lg mr-3 group-hover:scale-110 transition-transform"><svg
                            class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg></div>
                    <span class="font-medium">Add Task</span>
                </a>
            </div>
        </div>

        <!-- Mini Widget: Deal Distribution -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="text-sm font-bold text-slate-800 mb-4">Pipeline Distribution</h3>
            <div class="h-40">
                <canvas id="pipelineChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue ($)',
                data: [12000, 19000, 3000, 5000, 20000, 45000],
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79, 70, 229, 0.05)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#4f46e5',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [2, 2], drawBorder: false } },
                x: { grid: { display: false } }
            }
        }
    });

    // Pipeline Chart
    const ctxPipe = document.getElementById('pipelineChart').getContext('2d');
    new Chart(ctxPipe, {
        type: 'doughnut',
        data: {
            labels: ['Prospect', 'Negotiation', 'Won', 'Lost'],
            datasets: [{
                data: [30, 20, 40, 10],
                backgroundColor: ['#60a5fa', '#f59e0b', '#10b981', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right', labels: { boxWidth: 10, usePointStyle: true, font: { size: 10 } } }
            },
            cutout: '70%'
        }
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs" defer></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .glass-sidebar {
            background: #1e293b;
            /* backdrop-filter: blur(20px); */
        }

        .nav-item.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0) 100%);
            color: #60a5fa;
            border-left: 3px solid #60a5fa;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-72 glass-sidebar text-slate-300 flex flex-col shadow-2xl relative z-20">
            <!-- Logo -->
            <div class="h-20 flex items-center px-8 border-b border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-700 flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-bold text-white text-lg tracking-wide">CRM</h1>
                        <p class="text-xs text-slate-500">Test Edition</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <?php
                $uri = $_SERVER['REQUEST_URI'];
                $navs = [
                    BASE_URL . '/' => ['icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z', 'label' => 'Dashboard'],
                    BASE_URL . '/customer' => ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z', 'label' => 'Customers'],
                    BASE_URL . '/lead' => ['icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'label' => 'Leads'],
                    BASE_URL . '/deal' => ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Pipeline'],
                    BASE_URL . '/task' => ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'label' => 'Tasks'],
                ];


                // Fetch Notifications Logic directly in view for simplicity (View Composer pattern ideal but overkill here)
                $notifModel = new \App\Models\Notification();
                $userId = $_SESSION['user_id'] ?? 0;
                $notifications = $notifModel->getUnread($userId);
                $unreadCount = $notifModel->getUnreadCount($userId);

                if (($_SESSION['user_role'] ?? '') === 'admin') {
                    $navs[BASE_URL . '/users'] = ['icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'label' => 'Users'];
                }

                foreach ($navs as $path => $item):
                    $isActive = ($uri == $path) || ($path !== '/' && strpos($uri, $path) === 0);
                    ?>
                    <a href="<?php echo $path; ?>"
                        class="nav-item flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 hover:bg-slate-700/50 hover:text-white group <?php echo $isActive ? 'active' : ''; ?>">
                        <svg class="w-5 h-5 mr-3 transition-colors <?php echo $isActive ? 'text-blue-400' : 'text-slate-500 group-hover:text-blue-400'; ?>"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="<?php echo $item['icon']; ?>"></path>
                        </svg>
                        <span class="font-medium"><?php echo $item['label']; ?></span>
                    </a>
                <?php endforeach; ?>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-slate-700/50 m-4 rounded-xl bg-slate-700/20">
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-r from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold shadow-md">
                        <?php echo substr($_SESSION['user_name'] ?? 'U', 0, 1); ?>
                    </div>
                    <div class="ml-3 overflow-hidden">
                        <p class="text-sm font-semibold text-white truncate">
                            <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Guest'); ?>
                        </p>
                        <p class="text-xs text-slate-400 capitalize">
                            <?php echo htmlspecialchars($_SESSION['user_role'] ?? ''); ?>
                        </p>
                    </div>
                    <a href="<?= BASE_URL ?>/auth/logout"
                        class="ml-auto p-2 text-slate-400 hover:text-white transition-colors" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 scroll-smooth">
            <header class="bg-white h-20 shadow-sm sticky top-0 z-10 flex items-center justify-between px-8">
                <h2 class="text-2xl font-bold text-gray-800">
                    <?php
                    // Dynamic Title Logic (Subdirectory Safe)
                    $requestUri = $_SERVER['REQUEST_URI'];
                    $scriptDir = dirname($_SERVER['SCRIPT_NAME']); // e.g. /professional-crm
                    
                    // Remove the project folder path from the URI
                    $path = str_replace($scriptDir, '', $requestUri);
                    $path = trim($path, '/');
                    $parts = explode('/', $path);

                    // If empty, it's Dashboard. If 'users', show 'User Management' or just 'Users'
                    $page = empty($parts[0]) ? 'Dashboard' : $parts[0];

                    // Custom mapping for nicer titles
                    $titles = [
                        'users' => 'User Management',
                        'customer' => 'Customers',
                        'lead' => 'Lead Management',
                        'deal' => 'Pipeline',
                        'task' => 'Tasks'
                    ];

                    echo $titles[$page] ?? ucfirst($page);
                    ?>
                </h2>
                <div class="flex items-center gap-4" x-data="{ 
                    open: false,
                    notifications: [],
                    unreadCount: 0,
                    init() {
                       // Preloaded data from PHP (simpler than AJAX for now)
                       this.unreadCount = <?= $unreadCount ?>; 
                    }
                }">
                    <!-- Notification Bell -->
                    <div class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="p-2 text-gray-400 hover:text-blue-600 transition-colors relative">
                            <span x-show="unreadCount > 0"
                                class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-gray-100 z-50 overflow-hidden"
                            style="display: none;">

                            <div
                                class="px-4 py-3 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                                <h3 class="font-bold text-gray-700 text-sm">Notifications</h3>
                                <?php if ($unreadCount > 0): ?>
                                    <a href="<?= BASE_URL ?>/notification/markAllRead"
                                        class="text-xs text-blue-600 hover:text-blue-800 font-medium">Mark all read</a>
                                <?php endif; ?>
                            </div>

                            <div class="max-h-80 overflow-y-auto">
                                <?php if (empty($notifications)): ?>
                                    <div class="px-4 py-8 text-center text-gray-500 text-sm">
                                        No new notifications
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($notifications as $notif): ?>
                                        <div
                                            class="px-4 py-3 border-b border-gray-50 hover:bg-gray-50/50 transition relative group">
                                            <a href="<?= BASE_URL ?>/notification/read/<?= $notif['id'] ?>" class="block">
                                                <p class="text-sm font-semibold text-gray-800 pr-4">
                                                    <?= htmlspecialchars($notif['title']) ?>
                                                </p>
                                                <?php if (!empty($notif['message'])): ?>
                                                    <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">
                                                        <?= htmlspecialchars($notif['message']) ?>
                                                    </p>
                                                <?php endif; ?>
                                                <p class="text-[10px] text-gray-400 mt-1">
                                                    <?= date('M d, H:i', strtotime($notif['created_at'])) ?>
                                                </p>
                                            </a>
                                            <!-- Blue dot for unread -->
                                            <span class="absolute top-4 right-4 w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </header>
            <div class="p-8 max-w-7xl mx-auto pb-20">
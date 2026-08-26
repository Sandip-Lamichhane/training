<?php

/**
 * includes/sidebar.php
 *
 * Reusable sidebar navigation.
 * Set $currentPage in the parent file BEFORE including this file
 * so the matching nav link gets highlighted, e.g.:
 *
 *   $currentPage = 'dashboard';
 *   include __DIR__ . '/includes/sidebar.php';
 */

if (!isset($currentPage)) {
    $currentPage = '';
}

// Nav items grouped by section. Add/remove entries here — the markup
// below just loops over this array, so the sidebar stays a single
// source of truth instead of duplicated <a> tags on every page.
$navSections = [
    'Overview' => [
        'dashboard' => ['label' => 'Dashboard', 'href' => '/workshop/views/dasboard/adminDashboard.php', 'icon' => 'home'],
    ],
    'Records' => [
        'students'    => ['label' => 'Students', 'href' => '/workshop/views/student/index.php', 'icon' => 'users'],
        'courses'     => ['label' => 'Courses', 'href' => '/courses.php', 'icon' => 'book'],
        'instructors' => ['label' => 'Instructors', 'href' => '/instructors.php', 'icon' => 'user-check'],
        'attendance'  => ['label' => 'Attendance', 'href' => '/attendance.php', 'icon' => 'calendar'],
    ],
    'System' => [
        'reports'  => ['label' => 'Reports', 'href' => '/reports.php', 'icon' => 'chart'],
        'settings' => ['label' => 'Settings', 'href' => '/settings.php', 'icon' => 'settings'],
    ],
];

// Minimal icon set (stroke SVGs) keyed by the 'icon' value above.
$navIcons = [
    'home' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2 7-7 7 7 2 2M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10" />',
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1a4 4 0 00-3-3.87M9 20H4v-1a4 4 0 013-3.87m5-4a4 4 0 100-8 4 4 0 000 8zm6 1a4 4 0 10-1.13-7.84M6.13 8.16A4 4 0 108 4" />',
    'book' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.25C10.5 5 8.5 4.5 6 4.5 4.5 4.5 3.5 4.75 3 5v13.5c.5-.25 1.5-.5 3-.5 2.5 0 4.5.5 6 1.75m0-13.5c1.5-1.25 3.5-1.75 6-1.75 1.5 0 2.5.25 3 .5V19c-.5-.25-1.5-.5-3-.5-2.5 0-4.5.5-6 1.75m0-13.5V19" />',
    'user-check' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.4 0-8 2-8 4.5V20h16v-1.5c0-2.5-3.6-4.5-8-4.5z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19 8l1.5 1.5L23 7" />',
    'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2" /><path stroke-linecap="round" d="M8 3v4M16 3v4M3 10h18" />',
    'chart' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15l4-5 3 3 5-7" />',
    'settings' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 100-6 3 3 0 000 6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 00.33 1.82l.03.03a2 2 0 11-2.83 2.83l-.03-.03a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.03.03a2 2 0 11-2.83-2.83l.03-.03a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.03-.03a2 2 0 112.83-2.83l.03.03a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.03-.03a2 2 0 112.83 2.83l-.03.03a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" />',
];
?>
<aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-ink text-paper flex flex-col -translate-x-full lg:translate-x-0 transition-transform duration-200">

    <div class="flex items-center gap-2.5 px-6 h-[74px] border-b border-white/10 shrink-0">
        <div class="w-8 h-8 rounded-full border-2 border-brass flex items-center justify-center font-serif font-bold text-brass">R</div>
        <div class="font-serif font-semibold text-lg">Registrar</div>
    </div>

    <nav class="flex-1 overflow-y-auto py-5 px-3 space-y-0.5">
        <?php foreach ($navSections as $sectionLabel => $items): ?>
            <div class="px-3 mt-5 mb-2 font-mono text-[11px] tracking-widest uppercase text-white/35 first:mt-0">
                <?php echo htmlspecialchars($sectionLabel); ?>
            </div>

            <?php foreach ($items as $key => $item): ?>
                <?php $isActive = ($currentPage === $key); ?>
                <a href="<?php echo htmlspecialchars($item['href']); ?>"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors
                          <?php echo $isActive
                                ? 'bg-white/10 border-l-2 border-brass text-paper'
                                : 'text-white/70 hover:bg-white/5 hover:text-paper'; ?>">
                    <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <?php echo $navIcons[$item['icon']] ?? ''; ?>
                    </svg>
                    <?php echo htmlspecialchars($item['label']); ?>
                </a>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </nav>

    <div class="p-4 border-t border-white/10 shrink-0">
        <div class="flex items-center gap-3 px-2 py-2 rounded-md hover:bg-white/5 transition-colors cursor-pointer">
            <img src="<?php echo htmlspecialchars($user['avatar'] ?? 'https://i.pravatar.cc/64?img=47'); ?>" alt="" class="w-9 h-9 rounded-full border border-white/20 object-cover">
            <div class="min-w-0">
                <div class="text-sm font-medium text-paper truncate"><?php echo htmlspecialchars($user['name'] ?? 'User'); ?></div>
                <div class="text-xs text-white/50 truncate"><?php echo htmlspecialchars($user['role'] ?? ''); ?></div>
            </div>
        </div>
    </div>
</aside>

<!-- backdrop for mobile -->
<div id="backdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-20 hidden lg:hidden"></div>
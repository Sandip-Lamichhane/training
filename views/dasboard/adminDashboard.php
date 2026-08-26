<?php

require_once __DIR__ . '/../../middleware/authMiddlware.php';

// Tell the sidebar which link is active and give the navbar the
// logged-in user's info (swap this for your real session/auth data).
$currentPage = 'dashboard';
$pageTitle   = 'Dashboard';
$user = [
    'name'   => $_SESSION['user_name']  ?? 'Maya Reynolds',
    'role'   => $_SESSION['user_role']  ?? 'Registrar Admin',
    'email'  => $_SESSION['user_email'] ?? 'maya.reynolds@registrar.edu',
    'avatar' => $_SESSION['user_avatar'] ?? 'https://i.pravatar.cc/64?img=47',
];

include __DIR__ . '/../layout/header.php';   // <head>, opens <body> + flex wrapper
include __DIR__ . '/../layout/sidebar.php';  // left nav
?>

    <!-- ============ Main ============ -->
    <div class="flex-1 lg:ml-64">

        <?php include __DIR__ . '/../layout/topbar.php'; ?>

        <main class="p-5 lg:p-8 space-y-6">

            <!-- Heading -->
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <div class="font-mono text-xs tracking-widest uppercase text-brassdk mb-1.5">Fall Term &middot; Week 6</div>
                    <h1 class="font-serif font-semibold text-[26px]">Good afternoon, <?php echo htmlspecialchars(explode(' ', $user['name'])[0]); ?></h1>
                    <p class="text-inksoft text-sm mt-1">Here's what's happening across the registrar today.</p>
                </div>
                <div class="flex gap-2.5">
                    <button class="flex items-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-md border border-ink text-ink hover:bg-paper2 transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" d="M3 3v18h18M7 15l4-5 3 3 5-7" />
                        </svg>
                        Export report
                    </button>
                    <button class="flex items-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-md bg-ink text-paper hover:bg-brassdk transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" d="M12 5v14M5 12h14" />
                        </svg>
                        Add student
                    </button>
                </div>
            </div>

            <!-- Stat cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                <div class="bg-white border border-rule rounded-lg p-5">
                    <div class="flex items-start justify-between">
                        <div class="text-inksoft text-sm font-medium">Total students</div>
                        <div class="w-9 h-9 rounded-md bg-paper2 flex items-center justify-center text-brassdk">
                            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1a4 4 0 00-3-3.87M9 20H4v-1a4 4 0 013-3.87m5-4a4 4 0 100-8 4 4 0 000 8zm6 1a4 4 0 10-1.13-7.84M6.13 8.16A4 4 0 108 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="font-mono font-semibold text-3xl mt-3">3,482</div>
                    <div class="flex items-center gap-1 mt-2 text-xs font-medium text-ok">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5M5 12l7-7 7 7" />
                        </svg>
                        4.2% vs last term
                    </div>
                </div>

                <div class="bg-white border border-rule rounded-lg p-5">
                    <div class="flex items-start justify-between">
                        <div class="text-inksoft text-sm font-medium">Active courses</div>
                        <div class="w-9 h-9 rounded-md bg-paper2 flex items-center justify-center text-brassdk">
                            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.25C10.5 5 8.5 4.5 6 4.5 4.5 4.5 3.5 4.75 3 5v13.5c.5-.25 1.5-.5 3-.5 2.5 0 4.5.5 6 1.75m0-13.5c1.5-1.25 3.5-1.75 6-1.75 1.5 0 2.5.25 3 .5V19c-.5-.25-1.5-.5-3-.5-2.5 0-4.5.5-6 1.75m0-13.5V19" />
                            </svg>
                        </div>
                    </div>
                    <div class="font-mono font-semibold text-3xl mt-3">214</div>
                    <div class="flex items-center gap-1 mt-2 text-xs font-medium text-ok">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5M5 12l7-7 7 7" />
                        </svg>
                        12 added this term
                    </div>
                </div>

                <div class="bg-white border border-rule rounded-lg p-5">
                    <div class="flex items-start justify-between">
                        <div class="text-inksoft text-sm font-medium">Instructors</div>
                        <div class="w-9 h-9 rounded-md bg-paper2 flex items-center justify-center text-brassdk">
                            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.4 0-8 2-8 4.5V20h16v-1.5c0-2.5-3.6-4.5-8-4.5z" />
                            </svg>
                        </div>
                    </div>
                    <div class="font-mono font-semibold text-3xl mt-3">96</div>
                    <div class="flex items-center gap-1 mt-2 text-xs font-medium text-inksoft">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" d="M5 12h14" />
                        </svg>
                        No change
                    </div>
                </div>

                <div class="bg-white border border-rule rounded-lg p-5">
                    <div class="flex items-start justify-between">
                        <div class="text-inksoft text-sm font-medium">Pending enrollments</div>
                        <div class="w-9 h-9 rounded-md bg-warnlt flex items-center justify-center text-warn">
                            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="12" r="9" />
                                <path stroke-linecap="round" d="M12 7v5l3 3" />
                            </svg>
                        </div>
                    </div>
                    <div class="font-mono font-semibold text-3xl mt-3">27</div>
                    <div class="flex items-center gap-1 mt-2 text-xs font-medium text-warn">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12l7 7 7-7" />
                        </svg>
                        Needs review
                    </div>
                </div>
            </div>

        </main>
    </div>

<?php include __DIR__ . '/includes/footer.php'; ?>
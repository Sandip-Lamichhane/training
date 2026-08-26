<?php

/**
 * includes/navbar.php
 *
 * Reusable top bar: mobile menu toggle, search, notifications, profile menu.
 * Expects an optional $user array in scope (name, role, email, avatar) —
 * falls back to sane defaults if not provided.
 */

$user = $user ?? [
    'name'   => 'Maya Reynolds',
    'role'   => 'Admin',
    'email'  => 'maya.reynolds@registrar.edu',
    'avatar' => 'https://i.pravatar.cc/64?img=47',
];
?>
<header class="sticky top-0 z-10 flex items-center justify-between gap-4 px-5 lg:px-8 h-[74px] bg-paper/90 backdrop-blur border-b border-rule">
    <div class="flex items-center gap-3 flex-1">
        <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 rounded-md hover:bg-paper2">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="relative w-full max-w-sm hidden sm:block">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-inksoft" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="7" />
                <path stroke-linecap="round" d="M21 21l-3.5-3.5" />
            </svg>
            <input type="text" placeholder="Search students, courses, IDs…"
                class="w-full pl-9 pr-3 py-2.5 text-sm border border-rule rounded-md bg-white focus:outline-none focus:border-brass">
        </div>
    </div>

    <div class="flex items-center gap-2">
        <button class="relative p-2.5 rounded-md hover:bg-paper2">
            <svg class="w-5 h-5 text-ink" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-2 right-2.5 w-2 h-2 bg-brass rounded-full ring-2 ring-paper"></span>
        </button>
        <div class="w-px h-6 bg-rule mx-1"></div>

        <!-- Profile menu -->
        <div id="profileMenuWrap" class="relative">
            <button onclick="toggleProfileMenu(event)" id="profileTrigger"
                class="flex items-center gap-2.5 pl-1 pr-3 py-1.5 rounded-md hover:bg-paper2 cursor-pointer">
                <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="" class="w-8 h-8 rounded-full object-cover">
                <div class="hidden sm:block leading-tight text-left">
                    <div class="text-sm font-medium"><?php echo htmlspecialchars($user['name']); ?></div>
                    <div class="text-xs text-inksoft"><?php echo htmlspecialchars($user['role']); ?></div>
                </div>
                <svg id="profileChevron" class="w-4 h-4 text-inksoft hidden sm:block transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                </svg>
            </button>

            <!-- Popup -->
            <div id="profileMenu"
                class="hidden absolute right-0 top-[calc(100%+8px)] w-64 bg-white border border-rule rounded-lg shadow-lg overflow-hidden z-50">

                <div class="flex items-center gap-3 px-4 py-3.5 border-b border-rule bg-paper2">
                    <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="" class="w-10 h-10 rounded-full object-cover">
                    <div class="min-w-0">
                        <div class="text-sm font-medium truncate"><?php echo htmlspecialchars($user['name']); ?></div>
                        <div class="text-xs text-inksoft truncate"><?php echo htmlspecialchars($user['email']); ?></div>
                    </div>
                </div>

                <div class="py-1.5">
                    <a href="/profile.php" class="flex items-center gap-3 px-4 py-2.5 text-sm text-ink hover:bg-paper2 transition-colors">
                        <svg class="w-[18px] h-[18px] text-inksoft" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="8" r="4" />
                            <path stroke-linecap="round" d="M4 20c0-3.5 3.5-6 8-6s8 2.5 8 6" />
                        </svg>
                        View profile
                    </a>
                    <a href="/settings.php" class="flex items-center gap-3 px-4 py-2.5 text-sm text-ink hover:bg-paper2 transition-colors">
                        <svg class="w-[18px] h-[18px] text-inksoft" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 00.33 1.82l.03.03a2 2 0 11-2.83 2.83l-.03-.03a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.03.03a2 2 0 11-2.83-2.83l.03-.03a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.03-.03a2 2 0 112.83-2.83l.03.03a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.03-.03a2 2 0 112.83 2.83l-.03.03a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" />
                        </svg>
                        Account settings
                    </a>
                </div>

                <div class="border-t border-rule py-1.5">
                    <form action="../../controller/logoutController.php" method="POST">
                        <button class="flex items-center gap-3 px-4 py-2.5 text-sm text-err hover:bg-errlt transition-colors">
                            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9" />
                            </svg>
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
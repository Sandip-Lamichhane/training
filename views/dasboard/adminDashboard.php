<?php

session_start();

require_once __DIR__ . '/../../middleware/authMiddlware.php';

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Registrar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,500;8..60,600;8..60,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: '#16233D',
                        ink2: '#1E3050',
                        paper: '#FAF7F0',
                        paper2: '#F1ECDF',
                        rule: '#D8CFB8',
                        brass: '#A98544',
                        brassdk: '#8A6B34',
                        brasslt: '#EFE3CC',
                        ok: '#4B6B4B',
                        oklt: '#E9EFE9',
                        err: '#A23B3B',
                        errlt: '#F5E6E6',
                        warn: '#946B2D',
                        warnlt: '#F3E7D2',
                        inksoft: '#4B5566',
                    },
                    fontFamily: {
                        serif: ['"Source Serif 4"', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                        mono: ['"IBM Plex Mono"', 'monospace'],
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-paper text-ink font-sans antialiased">

    <div class="flex min-h-screen">

        <!-- ============ Sidebar ============ -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-ink text-paper flex flex-col -translate-x-full lg:translate-x-0 transition-transform duration-200">

            <div class="flex items-center gap-2.5 px-6 h-[74px] border-b border-white/10 shrink-0">
                <div class="w-8 h-8 rounded-full border-2 border-brass flex items-center justify-center font-serif font-bold text-brass">R</div>
                <div class="font-serif font-semibold text-lg">Registrar</div>
            </div>

            <nav class="flex-1 overflow-y-auto py-5 px-3 space-y-0.5">
                <div class="px-3 mb-2 font-mono text-[11px] tracking-widest uppercase text-white/35">Overview</div>

                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-md bg-white/10 border-l-2 border-brass text-paper text-sm font-medium">
                    <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2 7-7 7 7 2 2M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10" />
                    </svg>
                    Dashboard
                </a>

                <div class="px-3 mt-5 mb-2 font-mono text-[11px] tracking-widest uppercase text-white/35">Records</div>

                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-white/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
                    <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1a4 4 0 00-3-3.87M9 20H4v-1a4 4 0 013-3.87m5-4a4 4 0 100-8 4 4 0 000 8zm6 1a4 4 0 10-1.13-7.84M6.13 8.16A4 4 0 108 4" />
                    </svg>
                    Students
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-white/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
                    <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.25C10.5 5 8.5 4.5 6 4.5 4.5 4.5 3.5 4.75 3 5v13.5c.5-.25 1.5-.5 3-.5 2.5 0 4.5.5 6 1.75m0-13.5c1.5-1.25 3.5-1.75 6-1.75 1.5 0 2.5.25 3 .5V19c-.5-.25-1.5-.5-3-.5-2.5 0-4.5.5-6 1.75m0-13.5V19" />
                    </svg>
                    Courses
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-white/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
                    <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.4 0-8 2-8 4.5V20h16v-1.5c0-2.5-3.6-4.5-8-4.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 8l1.5 1.5L23 7" />
                    </svg>
                    Instructors
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-white/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
                    <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="5" width="18" height="16" rx="2" />
                        <path stroke-linecap="round" d="M8 3v4M16 3v4M3 10h18" />
                    </svg>
                    Attendance
                </a>

                <div class="px-3 mt-5 mb-2 font-mono text-[11px] tracking-widest uppercase text-white/35">System</div>

                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-white/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
                    <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15l4-5 3 3 5-7" />
                    </svg>
                    Reports
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-white/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
                    <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 00.33 1.82l.03.03a2 2 0 11-2.83 2.83l-.03-.03a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.03.03a2 2 0 11-2.83-2.83l.03-.03a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.03-.03a2 2 0 112.83-2.83l.03.03a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.03-.03a2 2 0 112.83 2.83l-.03.03a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" />
                    </svg>
                    Settings
                </a>
            </nav>

            <div class="p-4 border-t border-white/10 shrink-0">
                <div class="flex items-center gap-3 px-2 py-2 rounded-md hover:bg-white/5 transition-colors cursor-pointer">
                    <img src="https://i.pravatar.cc/64?img=47" alt="" class="w-9 h-9 rounded-full border border-white/20 object-cover">
                    <div class="min-w-0">
                        <div class="text-sm font-medium text-paper truncate">Maya Reynolds</div>
                        <div class="text-xs text-white/50 truncate">Registrar Admin</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- backdrop for mobile -->
        <div id="backdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-20 hidden lg:hidden"></div>

        <!-- ============ Main ============ -->
        <div class="flex-1 lg:ml-64">

            <!-- Topbar -->
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
                            <img src="https://i.pravatar.cc/64?img=47" alt="" class="w-8 h-8 rounded-full object-cover">
                            <div class="hidden sm:block leading-tight text-left">
                                <div class="text-sm font-medium">Maya Reynolds</div>
                                <div class="text-xs text-inksoft">Admin</div>
                            </div>
                            <svg id="profileChevron" class="w-4 h-4 text-inksoft hidden sm:block transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                            </svg>
                        </button>

                        <!-- Popup -->
                        <div id="profileMenu"
                            class="hidden absolute right-0 top-[calc(100%+8px)] w-64 bg-white border border-rule rounded-lg shadow-lg overflow-hidden z-50">

                            <div class="flex items-center gap-3 px-4 py-3.5 border-b border-rule bg-paper2">
                                <img src="https://i.pravatar.cc/64?img=47" alt="" class="w-10 h-10 rounded-full object-cover">
                                <div class="min-w-0">
                                    <div class="text-sm font-medium truncate">Maya Reynolds</div>
                                    <div class="text-xs text-inksoft truncate">maya.reynolds@registrar.edu</div>
                                </div>
                            </div>

                            <div class="py-1.5">
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-ink hover:bg-paper2 transition-colors">
                                    <svg class="w-[18px] h-[18px] text-inksoft" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <circle cx="12" cy="8" r="4" />
                                        <path stroke-linecap="round" d="M4 20c0-3.5 3.5-6 8-6s8 2.5 8 6" />
                                    </svg>
                                    View profile
                                </a>
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-ink hover:bg-paper2 transition-colors">
                                    <svg class="w-[18px] h-[18px] text-inksoft" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 00.33 1.82l.03.03a2 2 0 11-2.83 2.83l-.03-.03a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.03.03a2 2 0 11-2.83-2.83l.03-.03a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.03-.03a2 2 0 112.83-2.83l.03.03a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.03-.03a2 2 0 112.83 2.83l-.03.03a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" />
                                    </svg>
                                    Account settings
                                </a>
                            </div>

                            <div class="border-t border-rule py-1.5">
                                <form action="../../controller/logoutController.php">
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

            <main class="p-5 lg:p-8 space-y-6">

                <!-- Heading -->
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <div class="font-mono text-xs tracking-widest uppercase text-brassdk mb-1.5">Fall Term &middot; Week 6</div>
                        <h1 class="font-serif font-semibold text-[26px]">Good afternoon, Maya</h1>
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

                <!-- Middle row: table + attendance chart -->
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

                    <!-- Recent enrollments table -->
                    <div class="xl:col-span-2 bg-white border border-rule rounded-lg overflow-hidden">
                        <div class="flex items-center justify-between px-5 py-4 border-b border-rule">
                            <h2 class="font-serif font-semibold text-lg">Recent enrollments</h2>
                            <a href="#" class="text-sm font-medium text-brassdk hover:underline">View all</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="text-left text-inksoft border-b border-rule">
                                        <th class="font-medium px-5 py-3">Student</th>
                                        <th class="font-medium px-5 py-3">Course</th>
                                        <th class="font-medium px-5 py-3">Date</th>
                                        <th class="font-medium px-5 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-rule">
                                    <tr>
                                        <td class="px-5 py-3.5">
                                            <div class="flex items-center gap-3">
                                                <img src="https://i.pravatar.cc/64?img=32" class="w-8 h-8 rounded-full object-cover">
                                                <div>
                                                    <div class="font-medium">Amelia Torres</div>
                                                    <div class="text-xs text-inksoft font-mono">STU-10234</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5 text-inksoft">Data Structures II</td>
                                        <td class="px-5 py-3.5 text-inksoft font-mono text-xs">Aug 03, 2026</td>
                                        <td class="px-5 py-3.5"><span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-oklt text-ok">Enrolled</span></td>
                                    </tr>
                                    <tr>
                                        <td class="px-5 py-3.5">
                                            <div class="flex items-center gap-3">
                                                <img src="https://i.pravatar.cc/64?img=12" class="w-8 h-8 rounded-full object-cover">
                                                <div>
                                                    <div class="font-medium">Noah Bennett</div>
                                                    <div class="text-xs text-inksoft font-mono">STU-10198</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5 text-inksoft">Organic Chemistry</td>
                                        <td class="px-5 py-3.5 text-inksoft font-mono text-xs">Aug 03, 2026</td>
                                        <td class="px-5 py-3.5"><span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-warnlt text-warn">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td class="px-5 py-3.5">
                                            <div class="flex items-center gap-3">
                                                <img src="https://i.pravatar.cc/64?img=45" class="w-8 h-8 rounded-full object-cover">
                                                <div>
                                                    <div class="font-medium">Priya Nair</div>
                                                    <div class="text-xs text-inksoft font-mono">STU-10176</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5 text-inksoft">Intro to Microeconomics</td>
                                        <td class="px-5 py-3.5 text-inksoft font-mono text-xs">Aug 02, 2026</td>
                                        <td class="px-5 py-3.5"><span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-oklt text-ok">Enrolled</span></td>
                                    </tr>
                                    <tr>
                                        <td class="px-5 py-3.5">
                                            <div class="flex items-center gap-3">
                                                <img src="https://i.pravatar.cc/64?img=8" class="w-8 h-8 rounded-full object-cover">
                                                <div>
                                                    <div class="font-medium">Ethan Walsh</div>
                                                    <div class="text-xs text-inksoft font-mono">STU-10160</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5 text-inksoft">Studio Art I</td>
                                        <td class="px-5 py-3.5 text-inksoft font-mono text-xs">Aug 01, 2026</td>
                                        <td class="px-5 py-3.5"><span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-errlt text-err">Withdrawn</span></td>
                                    </tr>
                                    <tr>
                                        <td class="px-5 py-3.5">
                                            <div class="flex items-center gap-3">
                                                <img src="https://i.pravatar.cc/64?img=25" class="w-8 h-8 rounded-full object-cover">
                                                <div>
                                                    <div class="font-medium">Sofia Marín</div>
                                                    <div class="text-xs text-inksoft font-mono">STU-10151</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5 text-inksoft">World History 101</td>
                                        <td class="px-5 py-3.5 text-inksoft font-mono text-xs">Jul 31, 2026</td>
                                        <td class="px-5 py-3.5"><span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-oklt text-ok">Enrolled</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Attendance mini chart -->
                    <div class="bg-white border border-rule rounded-lg p-5 flex flex-col">
                        <div class="flex items-center justify-between mb-1">
                            <h2 class="font-serif font-semibold text-lg">Attendance this week</h2>
                        </div>
                        <p class="text-inksoft text-xs mb-5">Campus-wide average check-in rate</p>

                        <div class="flex-1 flex items-end justify-between gap-2.5 px-1" style="min-height:160px">
                            <div class="flex flex-col items-center gap-2 flex-1">
                                <div class="w-full bg-paper2 rounded-t" style="height:70px"></div>
                                <span class="text-[11px] font-mono text-inksoft">Mon</span>
                            </div>
                            <div class="flex flex-col items-center gap-2 flex-1">
                                <div class="w-full bg-paper2 rounded-t" style="height:96px"></div>
                                <span class="text-[11px] font-mono text-inksoft">Tue</span>
                            </div>
                            <div class="flex flex-col items-center gap-2 flex-1">
                                <div class="w-full bg-paper2 rounded-t" style="height:88px"></div>
                                <span class="text-[11px] font-mono text-inksoft">Wed</span>
                            </div>
                            <div class="flex flex-col items-center gap-2 flex-1">
                                <div class="w-full bg-brass rounded-t" style="height:112px"></div>
                                <span class="text-[11px] font-mono font-semibold text-ink">Thu</span>
                            </div>
                            <div class="flex flex-col items-center gap-2 flex-1">
                                <div class="w-full bg-paper2 rounded-t" style="height:64px"></div>
                                <span class="text-[11px] font-mono text-inksoft">Fri</span>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-t border-rule flex items-center justify-between">
                            <div>
                                <div class="text-inksoft text-xs">Today's average</div>
                                <div class="font-mono font-semibold text-xl">91.4%</div>
                            </div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-oklt text-ok">
                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5M5 12l7-7 7 7" />
                                </svg>
                                2.1%
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Bottom row: department table + quick actions -->
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

                    <div class="xl:col-span-2 bg-white border border-rule rounded-lg overflow-hidden">
                        <div class="px-5 py-4 border-b border-rule">
                            <h2 class="font-serif font-semibold text-lg">Enrollment by department</h2>
                        </div>
                        <div class="divide-y divide-rule">
                            <div class="flex items-center justify-between px-5 py-3.5">
                                <span class="text-sm font-medium">Computer Science</span>
                                <div class="flex items-center gap-3 w-1/2">
                                    <div class="flex-1 h-2 bg-paper2 rounded-full overflow-hidden">
                                        <div class="h-full bg-brass rounded-full" style="width:82%"></div>
                                    </div>
                                    <span class="font-mono text-xs text-inksoft w-10 text-right">812</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-5 py-3.5">
                                <span class="text-sm font-medium">Business &amp; Economics</span>
                                <div class="flex items-center gap-3 w-1/2">
                                    <div class="flex-1 h-2 bg-paper2 rounded-full overflow-hidden">
                                        <div class="h-full bg-brass rounded-full" style="width:68%"></div>
                                    </div>
                                    <span class="font-mono text-xs text-inksoft w-10 text-right">674</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-5 py-3.5">
                                <span class="text-sm font-medium">Life Sciences</span>
                                <div class="flex items-center gap-3 w-1/2">
                                    <div class="flex-1 h-2 bg-paper2 rounded-full overflow-hidden">
                                        <div class="h-full bg-brass rounded-full" style="width:54%"></div>
                                    </div>
                                    <span class="font-mono text-xs text-inksoft w-10 text-right">531</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-5 py-3.5">
                                <span class="text-sm font-medium">Humanities</span>
                                <div class="flex items-center gap-3 w-1/2">
                                    <div class="flex-1 h-2 bg-paper2 rounded-full overflow-hidden">
                                        <div class="h-full bg-brass rounded-full" style="width:41%"></div>
                                    </div>
                                    <span class="font-mono text-xs text-inksoft w-10 text-right">402</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-5 py-3.5">
                                <span class="text-sm font-medium">Fine Arts</span>
                                <div class="flex items-center gap-3 w-1/2">
                                    <div class="flex-1 h-2 bg-paper2 rounded-full overflow-hidden">
                                        <div class="h-full bg-brass rounded-full" style="width:23%"></div>
                                    </div>
                                    <span class="font-mono text-xs text-inksoft w-10 text-right">228</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick actions -->
                    <div class="bg-white border border-rule rounded-lg p-5">
                        <h2 class="font-serif font-semibold text-lg mb-4">Quick actions</h2>
                        <div class="space-y-2.5">
                            <button class="w-full flex items-center gap-3 px-4 py-3 rounded-md border border-rule hover:bg-paper2 transition-colors text-left">
                                <div class="w-8 h-8 rounded-md bg-paper2 flex items-center justify-center text-brassdk shrink-0">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" d="M12 5v14M5 12h14" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">Add new student</span>
                            </button>
                            <button class="w-full flex items-center gap-3 px-4 py-3 rounded-md border border-rule hover:bg-paper2 transition-colors text-left">
                                <div class="w-8 h-8 rounded-md bg-paper2 flex items-center justify-center text-brassdk shrink-0">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" d="M12 5v14M5 12h14" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">Create new course</span>
                            </button>
                            <button class="w-full flex items-center gap-3 px-4 py-3 rounded-md border border-rule hover:bg-paper2 transition-colors text-left">
                                <div class="w-8 h-8 rounded-md bg-paper2 flex items-center justify-center text-brassdk shrink-0">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">Review pending enrollments</span>
                            </button>
                            <button class="w-full flex items-center gap-3 px-4 py-3 rounded-md border border-rule hover:bg-paper2 transition-colors text-left">
                                <div class="w-8 h-8 rounded-md bg-paper2 flex items-center justify-center text-brassdk shrink-0">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" d="M3 3v18h18M7 15l4-5 3 3 5-7" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">Generate term report</span>
                            </button>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('backdrop').classList.toggle('hidden');
        }

        function toggleProfileMenu(e) {
            e.stopPropagation();
            document.getElementById('profileMenu').classList.toggle('hidden');
            document.getElementById('profileChevron').classList.toggle('rotate-180');
        }

        document.addEventListener('click', function(e) {
            const menu = document.getElementById('profileMenu');
            const wrap = document.getElementById('profileMenuWrap');
            if (!menu.classList.contains('hidden') && !wrap.contains(e.target)) {
                menu.classList.add('hidden');
                document.getElementById('profileChevron').classList.remove('rotate-180');
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('profileMenu').classList.add('hidden');
                document.getElementById('profileChevron').classList.remove('rotate-180');
            }
        });
    </script>

</body>

</html>
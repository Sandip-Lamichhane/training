<?php

require_once __DIR__ . '/../../middleware/authMiddlware.php';

$currentPage = 'students';
$pageTitle   = 'Add Student';

$user = [
    'name'   => $_SESSION['user']['name']  ?? $_SESSION['user_name']  ?? 'Registrar Admin',
    'role'   => $_SESSION['user_role']     ?? 'Registrar Staff',
    'email'  => $_SESSION['user']['email'] ?? $_SESSION['user_email'] ?? 'admin@registrar.edu',
    'avatar' => $_SESSION['user_avatar']   ?? 'https://i.pravatar.cc/64?img=47',
];

// Flash messages & old values
$errors  = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? '';
$old     = $_SESSION['old'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['success']);
unset($_SESSION['old']);

include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';
?>

<div class="flex-1 lg:ml-64">

    <?php include __DIR__ . '/../layout/topbar.php'; ?>

    <main class="p-5 lg:p-8 max-w-4xl mx-auto space-y-6">

        <!-- Top Header & Breadcrumb -->
        <div class="flex flex-wrap items-center justify-between gap-4 pb-2 border-b border-rule">
            <div>
                <nav class="flex items-center gap-2 font-mono text-xs text-brassdk uppercase tracking-widest mb-1.5">
                    <a href="/workshop/views/student/index.php" class="hover:underline">Students</a>
                    <span>&rsaquo;</span>
                    <span class="text-inksoft">New Registration</span>
                </nav>
                <h1 class="font-serif font-semibold text-2xl lg:text-3xl text-ink">Add New Student</h1>
                <p class="text-inksoft text-sm mt-1">Complete all required fields below to create a new student record.</p>
            </div>
            <div>
                <a href="/workshop/views/student/index.php"
                   class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-md border border-rule bg-white text-ink hover:bg-paper2 transition-colors">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Students
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if (!empty($errors)): ?>
            <div class="rounded-lg border border-err/30 bg-errlt/50 p-4 text-sm text-err">
                <div class="flex items-center gap-2 font-semibold mb-1">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Please fix the following issues:
                </div>
                <ul class="list-disc list-inside space-y-1 ml-1 text-[13.5px]">
                    <?php foreach ($errors as $err): ?>
                        <li><?php echo htmlspecialchars($err); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="rounded-lg border border-ok/30 bg-oklt/60 p-4 text-sm text-ok flex items-center gap-2 font-medium">
                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span><?php echo htmlspecialchars($success); ?></span>
            </div>
        <?php endif; ?>

        <!-- Student Form Card -->
        <div class="bg-white border border-rule rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-paper2/70 border-b border-rule flex items-center justify-between">
                <div class="flex items-center gap-2 font-mono text-xs tracking-wider uppercase text-brassdk font-semibold">
                    <svg class="w-4 h-4 text-brassdk" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.4 0-8 2-8 4.5V20h16v-1.5c0-2.5-3.6-4.5-8-4.5z" />
                    </svg>
                    Student Information Form
                </div>
                <span class="text-xs text-inksoft">* All fields required</span>
            </div>

            <form action="../../controller/studentController.php" method="POST" class="p-6 lg:p-8 space-y-6">
                <input type="hidden" name="action" value="create">

                <!-- Section: Personal Info -->
                <div>
                    <h2 class="font-serif font-semibold text-lg text-ink pb-2 border-b border-rule/60 mb-4">
                        Personal Information
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="first_name" class="block text-xs font-semibold text-ink uppercase tracking-wider mb-1.5">
                                First Name <span class="text-err">*</span>
                            </label>
                            <input type="text"
                                   name="first_name"
                                   id="first_name"
                                   required
                                   value="<?php echo htmlspecialchars($old['first_name'] ?? ''); ?>"
                                   placeholder="e.g. John"
                                   class="w-full px-3.5 py-2.5 text-sm border border-rule rounded-md bg-paper text-ink focus:outline-none focus:border-brass focus:ring-1 focus:ring-brass transition-colors">
                        </div>

                        <div>
                            <label for="last_name" class="block text-xs font-semibold text-ink uppercase tracking-wider mb-1.5">
                                Last Name <span class="text-err">*</span>
                            </label>
                            <input type="text"
                                   name="last_name"
                                   id="last_name"
                                   required
                                   value="<?php echo htmlspecialchars($old['last_name'] ?? ''); ?>"
                                   placeholder="e.g. Doe"
                                   class="w-full px-3.5 py-2.5 text-sm border border-rule rounded-md bg-paper text-ink focus:outline-none focus:border-brass focus:ring-1 focus:ring-brass transition-colors">
                        </div>

                        <div>
                            <label for="dob" class="block text-xs font-semibold text-ink uppercase tracking-wider mb-1.5">
                                Date of Birth <span class="text-err">*</span>
                            </label>
                            <input type="date"
                                   name="dob"
                                   id="dob"
                                   required
                                   value="<?php echo htmlspecialchars($old['dob'] ?? ''); ?>"
                                   class="w-full px-3.5 py-2.5 text-sm border border-rule rounded-md bg-paper text-ink focus:outline-none focus:border-brass focus:ring-1 focus:ring-brass transition-colors">
                        </div>

                        <div>
                            <label for="parents_name" class="block text-xs font-semibold text-ink uppercase tracking-wider mb-1.5">
                                Parent / Guardian Name <span class="text-err">*</span>
                            </label>
                            <input type="text"
                                   name="parents_name"
                                   id="parents_name"
                                   required
                                   value="<?php echo htmlspecialchars($old['parents_name'] ?? ''); ?>"
                                   placeholder="e.g. Robert Doe"
                                   class="w-full px-3.5 py-2.5 text-sm border border-rule rounded-md bg-paper text-ink focus:outline-none focus:border-brass focus:ring-1 focus:ring-brass transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Section: Contact Details -->
                <div>
                    <h2 class="font-serif font-semibold text-lg text-ink pb-2 border-b border-rule/60 mb-4">
                        Contact Details
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="email" class="block text-xs font-semibold text-ink uppercase tracking-wider mb-1.5">
                                Email Address <span class="text-err">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   required
                                   value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>"
                                   placeholder="student@example.edu"
                                   class="w-full px-3.5 py-2.5 text-sm border border-rule rounded-md bg-paper text-ink focus:outline-none focus:border-brass focus:ring-1 focus:ring-brass transition-colors">
                        </div>

                        <div>
                            <label for="phone" class="block text-xs font-semibold text-ink uppercase tracking-wider mb-1.5">
                                Phone Number <span class="text-err">*</span>
                            </label>
                            <input type="tel"
                                   name="phone"
                                   id="phone"
                                   required
                                   value="<?php echo htmlspecialchars($old['phone'] ?? ''); ?>"
                                   placeholder="e.g. 9806042762"
                                   class="w-full px-3.5 py-2.5 text-sm border border-rule rounded-md bg-paper text-ink focus:outline-none focus:border-brass focus:ring-1 focus:ring-brass transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pt-6 border-t border-rule flex items-center justify-end gap-3">
                    <a href="/workshop/views/student/index.php"
                       class="px-5 py-2.5 text-sm font-semibold border border-rule text-ink rounded-md hover:bg-paper2 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-md bg-ink text-paper hover:bg-brassdk transition-colors shadow-sm">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                        </svg>
                        Register Student
                    </button>
                </div>
            </form>
        </div>

    </main>

</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
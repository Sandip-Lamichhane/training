<?php

require_once __DIR__ . '/../../middleware/authMiddlware.php';
require_once __DIR__ . '/../../config/db.php';

$currentPage = 'students';
$pageTitle   = 'Students Directory';

$user = [
    'name'   => $_SESSION['user']['name']  ?? $_SESSION['user_name']  ?? 'Registrar Admin',
    'role'   => $_SESSION['user_role']     ?? 'Registrar Staff',
    'email'  => $_SESSION['user']['email'] ?? $_SESSION['user_email'] ?? 'admin@registrar.edu',
    'avatar' => $_SESSION['user_avatar']   ?? 'https://i.pravatar.cc/64?img=47',
];

// Flash messages
$success = $_SESSION['success'] ?? '';
$errors  = $_SESSION['errors'] ?? [];

unset($_SESSION['success']);
unset($_SESSION['errors']);

require_once __DIR__ . '/../../module/StudentSearch.php';

// Search filter and algorithm choice
$search    = trim($_GET['search'] ?? '');
$algorithm = trim($_GET['algorithm'] ?? 'binary');
if (!in_array($algorithm, ['binary', 'linear'])) {
    $algorithm = 'binary';
}

$students = [];
$totalStudents = 0;
$searchReport = null;

// Query all students for algorithmic search and directory listing
$allStudentsResult = $conn->query("SELECT * FROM students ORDER BY id DESC");
$allStudents = [];
if ($allStudentsResult) {
    while ($row = $allStudentsResult->fetch_assoc()) {
        $allStudents[] = $row;
    }
}
$totalStudents = count($allStudents);

// Execute search algorithm when a query is provided
if (!empty($search)) {
    $searchReport = StudentSearch::search($allStudents, $search, $algorithm);
    $students = $searchReport['results'];
} else {
    $students = $allStudents;
}

include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';
?>

<div class="flex-1 lg:ml-64">

    <?php include __DIR__ . '/../layout/topbar.php'; ?>

    <main class="p-5 lg:p-8 space-y-6">

        <!-- Header -->
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <div class="font-mono text-xs tracking-widest uppercase text-brassdk mb-1.5">
                    Academic Records &middot; Student Registry
                </div>
                <h1 class="font-serif font-semibold text-2xl lg:text-3xl text-ink">
                    Students Directory
                </h1>
                <p class="text-inksoft text-sm mt-1">
                    Manage registered student profiles, enrollment data, and contact information.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="./addStudent.php"
                   class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-md bg-ink text-paper hover:bg-brassdk transition-colors shadow-sm">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                    </svg>
                    Add Student
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if (!empty($success)): ?>
            <div class="rounded-lg border border-ok/30 bg-oklt/70 p-4 text-sm text-ok flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-medium"><?php echo htmlspecialchars($success); ?></span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-ok/70 hover:text-ok text-lg leading-none">&times;</button>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="rounded-lg border border-err/30 bg-errlt/70 p-4 text-sm text-err">
                <div class="flex items-center gap-2 font-semibold mb-1">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Notice:
                </div>
                <ul class="list-disc list-inside space-y-1 ml-1 text-[13.5px]">
                    <?php foreach ($errors as $err): ?>
                        <li><?php echo htmlspecialchars($err); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Search & Quick Stats Bar -->
        <div class="bg-white border border-rule rounded-xl p-4 flex flex-col lg:flex-row items-center justify-between gap-4">
            <!-- Search Form with Algorithm Selection -->
            <form action="index.php" method="GET" class="w-full lg:max-w-2xl flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                <div class="relative flex-1">
                    <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-inksoft" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7" />
                        <path stroke-linecap="round" d="M21 21l-3.5-3.5" />
                    </svg>
                    <input type="text"
                           name="search"
                           value="<?php echo htmlspecialchars($search); ?>"
                           placeholder="Search by ID (e.g. 2, STD-0002), Name, Email..."
                           class="w-full pl-10 pr-16 py-2.5 text-sm border border-rule rounded-md bg-paper text-ink focus:outline-none focus:border-brass">
                    <?php if (!empty($search)): ?>
                        <a href="index.php" class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-inksoft hover:text-ink">
                            Clear
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Algorithm Dropdown -->
                <div class="sm:w-56 shrink-0">
                    <select name="algorithm"
                            title="Select Searching Algorithm"
                            class="w-full py-2.5 px-3 text-xs font-mono font-medium border border-rule rounded-md bg-paper2 text-ink focus:outline-none focus:border-brass cursor-pointer">
                        <option value="binary" <?php echo ($algorithm === 'binary') ? 'selected' : ''; ?>>
                            ⚡ Binary Search (O(log n))
                        </option>
                        <option value="linear" <?php echo ($algorithm === 'linear') ? 'selected' : ''; ?>>
                            🔍 Linear Search (O(n))
                        </option>
                    </select>
                </div>

                <button type="submit"
                        class="px-4 py-2.5 text-xs font-semibold rounded-md bg-ink text-paper hover:bg-brassdk transition-colors shrink-0">
                    Search
                </button>
            </form>

            <!-- Metrics Pill -->
            <div class="flex items-center gap-4 text-xs font-mono text-inksoft self-end lg:self-center shrink-0">
                <div>
                    Total Enrolled: <span class="font-semibold text-ink"><?php echo $totalStudents; ?></span>
                </div>
                <?php if (!empty($search)): ?>
                    <div class="border-l border-rule pl-4 text-brassdk">
                        Found: <span class="font-semibold"><?php echo count($students); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Algorithm Performance & Benchmark Card -->
        <?php if ($searchReport !== null): ?>
            <div class="bg-paper border border-brass/35 rounded-xl p-4 shadow-sm space-y-3">
                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-rule/70 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-brass/20 text-brassdk font-mono text-xs font-bold">⚡</span>
                        <h3 class="font-serif font-semibold text-sm text-ink">Algorithm Execution Metrics</h3>
                        <span class="px-2.5 py-0.5 rounded text-[11px] font-mono font-semibold bg-ink text-paper">
                            <?php echo htmlspecialchars($searchReport['algorithm']); ?> &middot; <?php echo htmlspecialchars($searchReport['time_complexity']); ?>
                        </span>
                    </div>
                    <div class="text-xs font-mono text-inksoft">
                        Target Query: <span class="font-semibold text-ink">"<?php echo htmlspecialchars($searchReport['query']); ?>"</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="bg-white border border-rule/70 rounded-lg p-3">
                        <div class="font-mono text-[10.5px] uppercase tracking-wider text-inksoft">Comparisons Made</div>
                        <div class="font-serif font-bold text-xl text-ink mt-0.5">
                            <?php echo $searchReport['comparisons']; ?>
                            <span class="text-xs font-sans font-normal text-inksoft">steps</span>
                        </div>
                    </div>

                    <div class="bg-white border border-rule/70 rounded-lg p-3">
                        <div class="font-mono text-[10.5px] uppercase tracking-wider text-inksoft">Execution Time</div>
                        <div class="font-serif font-bold text-xl text-ink mt-0.5">
                            <?php echo $searchReport['time_ms']; ?>
                            <span class="text-xs font-sans font-normal text-inksoft">ms</span>
                        </div>
                    </div>

                    <div class="bg-white border border-rule/70 rounded-lg p-3">
                        <div class="font-mono text-[10.5px] uppercase tracking-wider text-inksoft">Records Scanned</div>
                        <div class="font-serif font-bold text-xl text-ink mt-0.5">
                            <?php echo $searchReport['records_searched']; ?>
                            <span class="text-xs font-sans font-normal text-inksoft">records</span>
                        </div>
                    </div>

                    <div class="bg-white border border-rule/70 rounded-lg p-3">
                        <div class="font-mono text-[10.5px] uppercase tracking-wider text-inksoft">Matches Found</div>
                        <div class="font-serif font-bold text-xl text-ok mt-0.5">
                            <?php echo count($students); ?>
                            <span class="text-xs font-sans font-normal text-inksoft">match(es)</span>
                        </div>
                    </div>
                </div>

                <?php if (!empty($searchReport['strategy_note'])): ?>
                    <div class="text-xs text-inksoft font-mono bg-paper2/60 rounded-md px-3 py-2 border border-rule/50 flex items-center gap-2">
                        <span class="font-bold text-brassdk uppercase tracking-wide text-[10.5px]">Execution Note:</span>
                        <span><?php echo htmlspecialchars($searchReport['strategy_note']); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Students Table -->
        <div class="bg-white border border-rule rounded-xl shadow-sm overflow-hidden">
            <?php if (empty($students)): ?>
                <!-- Empty State -->
                <div class="p-12 text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-paper2 flex items-center justify-center text-brassdk mb-4">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1a4 4 0 00-3-3.87M9 20H4v-1a4 4 0 013-3.87m5-4a4 4 0 100-8 4 4 0 000 8zm6 1a4 4 0 10-1.13-7.84M6.13 8.16A4 4 0 108 4" />
                        </svg>
                    </div>
                    <h3 class="font-serif font-semibold text-xl text-ink mb-1.5">No student records found</h3>
                    <p class="text-inksoft text-sm max-w-sm mx-auto mb-6">
                        <?php if (!empty($search)): ?>
                            No students matched your search criteria "<?php echo htmlspecialchars($search); ?>". Try searching with different keywords.
                        <?php else: ?>
                            There are currently no students registered in the system. Start by enrolling the first student.
                        <?php endif; ?>
                    </p>
                    <?php if (!empty($search)): ?>
                        <a href="index.php" class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-md border border-rule text-ink hover:bg-paper2 transition-colors">
                            View All Students
                        </a>
                    <?php else: ?>
                        <a href="./addStudent.php" class="inline-flex items-center gap-2 text-sm font-semibold px-5 py-2.5 rounded-md bg-ink text-paper hover:bg-brassdk transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                            </svg>
                            Add First Student
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <!-- Table View -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-paper2/70 border-b border-rule font-mono text-[11px] uppercase tracking-wider text-inksoft">
                                <th class="py-3 px-5">ID</th>
                                <th class="py-3 px-5">Student Name</th>
                                <th class="py-3 px-5">Parent / Guardian</th>
                                <th class="py-3 px-5">Date of Birth</th>
                                <th class="py-3 px-5">Contact Details</th>
                                <th class="py-3 px-5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-rule/60 text-sm">
                            <?php foreach ($students as $s): ?>
                                <?php
                                    $fullName = trim($s['first_name'] . ' ' . $s['last_name']);
                                    $initials = strtoupper(substr($s['first_name'], 0, 1) . substr($s['last_name'], 0, 1));
                                    
                                    // Calculate age safely
                                    $age = '';
                                    if (!empty($s['dob']) && $s['dob'] !== '0000-00-00') {
                                        try {
                                            $birthDate = new DateTime($s['dob']);
                                            $today = new DateTime('today');
                                            $age = $birthDate->diff($today)->y . ' yrs';
                                        } catch (Exception $e) {
                                            $age = '';
                                        }
                                    }
                                ?>
                                <tr class="hover:bg-paper2/40 transition-colors">
                                    <!-- ID -->
                                    <td class="py-4 px-5 font-mono text-xs text-inksoft">
                                        #<?php echo htmlspecialchars((string)$s['id']); ?>
                                    </td>

                                    <!-- Student Name & Initials Badge -->
                                    <td class="py-4 px-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-paper2 border border-rule flex items-center justify-center font-serif font-semibold text-xs text-brassdk shrink-0">
                                                <?php echo htmlspecialchars($initials); ?>
                                            </div>
                                            <div>
                                                <div class="font-medium text-ink">
                                                    <?php echo htmlspecialchars($fullName); ?>
                                                </div>
                                                <div class="font-mono text-[11px] text-inksoft">
                                                    Reg. ID: STD-<?php echo str_pad((string)$s['id'], 4, '0', STR_PAD_LEFT); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Parent Name -->
                                    <td class="py-4 px-5 text-inksoft font-medium">
                                        <?php echo htmlspecialchars($s['parents_name'] ?? '—'); ?>
                                    </td>

                                    <!-- DOB & Age -->
                                    <td class="py-4 px-5">
                                        <div class="text-ink">
                                            <?php echo !empty($s['dob']) ? htmlspecialchars(date('M d, Y', strtotime($s['dob']))) : '—'; ?>
                                        </div>
                                        <?php if ($age): ?>
                                            <div class="font-mono text-[11px] text-brassdk">
                                                Age: <?php echo $age; ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Contact Info -->
                                    <td class="py-4 px-5">
                                        <div class="space-y-0.5">
                                            <div class="flex items-center gap-1.5 text-xs text-ink">
                                                <svg class="w-3.5 h-3.5 text-inksoft shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                <a href="mailto:<?php echo htmlspecialchars($s['email']); ?>" class="hover:text-brassdk transition-colors truncate max-w-[180px]">
                                                    <?php echo htmlspecialchars($s['email']); ?>
                                                </a>
                                            </div>
                                            <div class="flex items-center gap-1.5 text-xs text-inksoft">
                                                <svg class="w-3.5 h-3.5 text-inksoft shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                <span><?php echo htmlspecialchars($s['phone']); ?></span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Actions -->
                                    <td class="py-4 px-5 text-right">
                                        <div class="inline-flex items-center gap-1.5">
                                            <!-- Edit button -->
                                            <a href="editStudent.php?id=<?php echo htmlspecialchars((string)$s['id']); ?>"
                                               title="Edit Student"
                                               class="p-1.5 rounded-md border border-rule hover:border-ink hover:bg-paper2 text-ink transition-colors">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <!-- Delete button with confirmation -->
                                            <form action="../../controller/studentController.php" method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete <?php echo htmlspecialchars(addslashes($fullName)); ?>? This action cannot be undone.');"
                                                  class="inline">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars((string)$s['id']); ?>">
                                                <button type="submit"
                                                        title="Delete Student"
                                                        class="p-1.5 rounded-md border border-rule hover:border-err hover:bg-errlt text-inksoft hover:text-err transition-colors">
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Summary of Table -->
                <div class="px-5 py-3.5 bg-paper2/50 border-t border-rule flex items-center justify-between text-xs font-mono text-inksoft">
                    <span>Showing <?php echo count($students); ?> student record(s)</span>
                    <span class="text-brassdk">&copy; Registrar Academic System</span>
                </div>
            <?php endif; ?>
        </div>

    </main>

</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
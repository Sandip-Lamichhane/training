<?php
include './config/db.php';

session_start();

$success = $_SESSION['success'] ?? '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in — Registrar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,500;8..60,600;8..60,700&family=Inter:wght@400;500;600&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: '#16233D',
                        paper: '#FAF7F0',
                        paper2: '#F1ECDF',
                        rule: '#D8CFB8',
                        brass: '#A98544',
                        brassdk: '#8A6B34',
                        err: '#A23B3B',
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

<body class="bg-paper text-ink font-sans">

    <header class="flex items-center justify-between px-6 md:px-10 py-4 border-b border-rule bg-paper">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full border-2 border-ink flex items-center justify-center font-serif font-bold text-ink">R</div>
            <div class="font-serif font-semibold text-xl">Registrar</div>
        </div>
        <nav class="flex items-center">
            <a href="../index.php" class="ml-4 md:ml-6 text-sm font-medium text-inksoft hover:underline">Home</a>
            <a href="register.php" class="ml-4 md:ml-6 text-sm font-medium text-inksoft hover:underline">Create account</a>
        </nav>
    </header>

    <div class="min-h-[calc(100vh-74px)] flex items-center justify-center px-5 py-10">
        <div class="w-full max-w-md bg-paper2 border border-rule rounded-lg p-9 pt-10 relative">

            <div class="absolute -top-px left-6 right-6 border-t-2 border-dashed border-rule"></div>

            <div class="font-mono text-xs tracking-wider uppercase text-brassdk mb-2">Student Sign-In</div>
            <h1 class="font-serif font-semibold text-2xl mb-1.5">Welcome back</h1>
            <p class="text-inksoft text-sm mb-7">Log in with the email you registered with.</p>

            <?php if (!empty($errors)): ?>
                <div class="rounded-md px-4 py-2.5 text-sm mb-5 bg-red-50 text-err border border-red-200">
                    <?php echo htmlspecialchars(implode(' ', $errors)); ?>
                </div>
            <?php endif; ?>

            <!-- Success Message -->
            <?php if (!empty($success)): ?>

                <div class="mb-5 rounded-md border border-green-300 bg-green-50 p-4 text-sm text-green-700">

                    <?= htmlspecialchars($success) ?>

                </div>

            <?php endif; ?>

            <form action="../controller/loginController.php" method="POST" novalidate>

                <div class="mb-4.5">
                    <label for="email" class="block text-[13px] font-semibold text-ink mb-1.5">Email address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="you@example.com"
                        required
                        class="w-full px-3 py-2.5 text-[15px] font-sans border border-rule rounded bg-paper text-ink focus:outline-none focus:border-brass">
                </div>

                <div class="mb-1">
                    <label for="password" class="block text-[13px] font-semibold text-ink mb-1.5">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        class="w-full px-3 py-2.5 text-[15px] font-sans border border-rule rounded bg-paper text-ink focus:outline-none focus:border-brass">
                </div>

                <button type="submit" class="w-full mt-5 text-center font-semibold text-sm px-6 py-3 rounded bg-ink text-paper hover:bg-brassdk transition-colors">
                    Log in
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-inksoft">
                New here? <a href="register.php" class="text-brassdk font-medium hover:underline">Create an account</a>
            </div>
        </div>
    </div>

    <footer class="border-t border-rule px-6 md:px-10 py-6 text-inksoft text-[13px] text-center">
        &copy; <?php echo date('Y'); ?> Registrar Student Management System.
    </footer>

</body>

</html>
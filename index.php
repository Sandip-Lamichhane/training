<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar — Student Management System</title>

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
                        ok: '#4B6B4B',
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
            <a href="index.php" class="ml-4 md:ml-6 text-sm font-medium text-inksoft hover:underline">Home</a>
            <a href="./views/login.php" class="ml-4 md:ml-6 text-sm font-medium text-inksoft hover:underline">Log in</a>
            <a href="./views/register.php" class="ml-4 md:ml-6 text-sm font-semibold bg-ink text-paper px-4 py-2 rounded hover:bg-brassdk transition-colors">Enroll now</a>
        </nav>
    </header>

    <section class="bg-[repeating-linear-gradient(to_bottom,transparent,transparent_37px,#D8CFB8_37px,#D8CFB8_38px)]">
        <div class="max-w-5xl mx-auto px-6 md:px-10 pt-16 pb-14">

            <div class="font-mono text-xs tracking-widest uppercase text-brassdk mb-3.5">
                Student Management System &middot; Academic Year 2026
            </div>

            <h1 class="font-serif font-semibold text-4xl md:text-[44px] leading-tight max-w-xl mb-4">
                One record, from enrollment to graduation.
            </h1>

            <p class="max-w-md text-inksoft text-base md:text-[16.5px] mb-8">
                Registrar is where students, instructors and staff track courses, grades and
                attendance in a single, always up-to-date file — no more chasing paper forms.
            </p>

            <div class="flex flex-wrap gap-3.5 mb-14">
                <a href="./views/register.php" class="inline-block font-semibold text-sm px-6 py-3 rounded bg-ink text-paper hover:bg-brassdk transition-colors">Create your account</a>
                <a href="./views/login.php" class="inline-block font-semibold text-sm px-6 py-3 rounded border border-ink text-ink hover:bg-paper2 transition-colors">I already have one</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="relative bg-paper2 border border-rule rounded-md p-5">
                    <span class="absolute top-4 right-4 font-mono text-xs font-semibold text-rule">01</span>
                    <h3 class="font-serif font-semibold text-lg mb-2">Course enrollment</h3>
                    <p class="text-inksoft text-sm">Browse the catalog and enroll in courses each term, with seat limits kept current.</p>
                    <span class="inline-block mt-3.5 font-mono text-[11px] tracking-wider uppercase text-brassdk border border-brass px-2 py-0.5 rounded-sm">Self-service</span>
                </div>

                <div class="relative bg-paper2 border border-rule rounded-md p-5">
                    <span class="absolute top-4 right-4 font-mono text-xs font-semibold text-rule">02</span>
                    <h3 class="font-serif font-semibold text-lg mb-2">Grades &amp; transcripts</h3>
                    <p class="text-inksoft text-sm">View grades as they're posted and download an official transcript anytime.</p>
                    <span class="inline-block mt-3.5 font-mono text-[11px] tracking-wider uppercase text-brassdk border border-brass px-2 py-0.5 rounded-sm">Always current</span>
                </div>

                <div class="relative bg-paper2 border border-rule rounded-md p-5">
                    <span class="absolute top-4 right-4 font-mono text-xs font-semibold text-rule">03</span>
                    <h3 class="font-serif font-semibold text-lg mb-2">Attendance record</h3>
                    <p class="text-inksoft text-sm">A running attendance log per course, visible to students and instructors alike.</p>
                    <span class="inline-block mt-3.5 font-mono text-[11px] tracking-wider uppercase text-brassdk border border-brass px-2 py-0.5 rounded-sm">Auto-logged</span>
                </div>

            </div>
        </div>
    </section>

    <footer class="border-t border-rule px-6 md:px-10 py-6 text-inksoft text-[13px] text-center">
        &copy; <?php echo date('Y'); ?> Registrar Student Management System — built while learning PHP.
    </footer>

</body>

</html>
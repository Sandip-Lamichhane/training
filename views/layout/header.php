<?php

/**
 * includes/header.php
 *
 * Opens the HTML document: <head> (fonts + Tailwind via CDN, kept inline —
 * no separate .css file), then opens <body> and the sidebar/main flex
 * wrapper. Pair with includes/footer.php at the end of the page.
 *
 * Set $pageTitle before including this file, e.g.:
 *   $pageTitle = 'Dashboard';
 */

$pageTitle = $pageTitle ?? 'Registrar';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> — Registrar</title>

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
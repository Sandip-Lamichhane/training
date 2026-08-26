<?php

require_once __DIR__ . '/../../middleware/authMiddlware.php';

$currentPage = 'dashboard';
$pageTitle   = 'Dashboard';

include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';  
?>

<div class="flex-1 lg:ml-64">

    <?php include __DIR__ . '/../layout/topbar.php'; ?>
</div>
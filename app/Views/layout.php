<?php
$hlm = "Home";
if (uri_string() != "") {
    $hlm = ucwords(uri_string());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Toko - <?= $hlm ?></title>

    <link href="<?= base_url('NiceAdmin/assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body>

    <?= $this->include('components/header') ?>
    <?= $this->include('components/sidebar') ?>

    <main id="main" class="main">

        <!-- 🔥 PAGE TITLE -->
        <div class="pagetitle">
            <h1><?= $hlm ?></h1>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <?php if ($hlm != "Home"): ?>
                        <li class="breadcrumb-item active"><?= $hlm ?></li>
                    <?php endif; ?>
                </ol>

                <!-- 🔥 MENU -->
                
            </nav>
        </div>

        <!-- 🔥 INFO USER (SESSION) -->
        <div class="alert alert-info">
            Login sebagai: <b><?= session('username') ?></b> |
            Role: <b><?= session('role') ?></b>
        </div>

        <!-- 🔥 CONTENT -->
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $hlm ?></h5>

                    <?= $this->renderSection('content') ?>

                </div>
            </div>
        </section>

    </main>

    <?= $this->include('components/footer') ?>

    <script src="<?= base_url('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>
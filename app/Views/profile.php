<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="card p-3" > 



        

            <h6 class="mb-3"><b>Profile Information</b></h6>

            <div class="row mb-2">
                <div class="col-md-3 text-primary"><b>Username</b></div>
                <div class="col-md-9"><?= session('username') ?></div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 text-primary"><b>Role</b></div>
                <div class="col-md-9">
                    <span class="badge bg-danger">
                        <?= session('role') ?>
                    </span>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 text-primary"><b>Email</b></div>
                <div class="col-md-9"><?= session('email') ?></div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 text-primary"><b>Login Time</b></div>
                <div class="col-md-9"><?= session('login_time') ?></div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 text-primary"><b>Status</b></div>
                <div class="col-md-9">
                    <?php if (session('logged_in')): ?>
                        <span class="badge bg-success">● Sudah Login</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Logout</span>
                    <?php endif; ?>
                </div>
            </div>


<?= $this->endSection() ?>
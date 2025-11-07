<?php
/**
 * CakePHP(tm) : Rapid Development Framework[](https://cakephp.org)
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Event Manager';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Bootstrap 5 CSS -->
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css') ?>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Tùy chỉnh CSS (nếu cần) -->
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body class="bg-light">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= $this->Url->build('/') ?>">
                Event Manager
            </a>
            <div class="d-flex">
                <a href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'index']) ?>"
                   class="btn btn-outline-light btn-sm">
                    Events
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white-50 py-4 mt-5">
        <div class="container text-center">
            <small>
                &copy; <?= date('Y') ?> Event Manager. Powered by
                <a href="https://cakephp.org" target="_blank" class="text-white">CakePHP</a>
            </small>
        </div>
    </footer>

    <!-- Bootstrap 5 JS (Bundle includes Popper) -->
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js') ?>

    <!-- Custom JS -->
    <?= $this->fetch('script') ?>
</body>
</html>
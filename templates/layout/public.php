<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <title>CommunityLink | <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('viewport', 'width=device-width, initial-scale=1') ?>
    <?= $this->Html->css(['https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css','style.css']) ?>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="<?= $this->Url->build(['controller'=>'Public','action'=>'home']) ?>">
      <i class="bi bi-people-fill me-2"></i>CommunityLink
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav ms-auto">
        <?= $this->Html->link('Home', ['action'=>'home'], ['class'=>'nav-link']) ?>
        <?= $this->Html->link('Events', ['action'=>'publicEvents'], ['class'=>'nav-link']) ?>
        <?= $this->Html->link('Volunteer', ['action'=>'volunteerRegister'], ['class'=>'nav-link']) ?>
        <?= $this->Html->link('Organisation', ['action'=>'organisationRegister'], ['class'=>'nav-link']) ?>
        <?= $this->Html->link('Contact Us', ['action'=>'contact'], ['class'=>'nav-link']) ?>
      </div>
    </div>
  </div>
</nav>

<?php
$isHomePage = $this->request->getParam('controller') === 'Public' && $this->request->getParam('action') === 'home';
?>

<?php if (!$isHomePage): ?>
<div class="container py-5">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
<?php else: ?>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
<?php endif; ?>

<footer class="bg-dark text-white-50 py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <h5 class="text-white mb-3"><i class="bi bi-people-fill me-2"></i>CommunityLink</h5>
                <p class="mb-0">Connecting volunteers, organisations, and communities together for a better tomorrow.</p>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <h6 class="text-white mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><?= $this->Html->link('Events', ['controller' => 'Public', 'action' => 'publicEvents'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                    <li class="mb-2"><?= $this->Html->link('Volunteer Registration', ['controller' => 'Public', 'action' => 'volunteerRegister'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                    <li class="mb-2"><?= $this->Html->link('Organisation Registration', ['controller' => 'Public', 'action' => 'organisationRegister'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="text-white mb-3">Contact</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><?= $this->Html->link('Contact Us', ['controller' => 'Public', 'action' => 'contact'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                </ul>
            </div>
        </div>
        <hr class="my-4 bg-white-50">
        <div class="text-center">
            <small>&copy; <?= date('Y') ?> CommunityLink. All rights reserved.</small>
        </div>
    </div>
</footer>

<?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') ?>
<?= $this->fetch('script') ?>
</body>
</html>

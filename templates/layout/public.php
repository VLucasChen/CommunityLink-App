<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <title>CommunityLink | <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('viewport', 'width=device-width, initial-scale=1') ?>
    <?= $this->Html->css(['https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css','style.css']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= $this->Url->build(['controller'=>'Public','action'=>'home']) ?>">CommunityLink</a>
    <div class="navbar-nav">
      <?= $this->Html->link('Home', ['action'=>'home'], ['class'=>'nav-link']) ?>
      <?= $this->Html->link('Events', ['action'=>'publicEvents'], ['class'=>'nav-link']) ?>
      <?= $this->Html->link('Volunteer', ['action'=>'volunteerRegister'], ['class'=>'nav-link']) ?>
      <?= $this->Html->link('Organisation', ['action'=>'organisationRegister'], ['class'=>'nav-link']) ?>
      <?= $this->Html->link('Contact Us', ['action'=>'contact'], ['class'=>'nav-link']) ?>
    </div>
  </div>
</nav>

<div class="container py-5">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>

<footer class="bg-white border-top text-center py-3 mt-5">
    <small class="text-muted">&copy; <?= date('Y') ?> CommunityLink. All rights reserved.</small>
</footer>

<?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') ?>
<?= $this->fetch('script') ?>
</body>
</html>

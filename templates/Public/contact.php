<div class="card shadow-sm p-4">
<h2 class="fw-bold text-primary mb-4">Contact Us</h2>
<p class="text-muted mb-4">Have a question or feedback? Fill out the form below and our team will get back to you soon.</p>

<?= $this->Form->create($contact) ?>
<div class="row g-3">
  <div class="col-md-6"><?= $this->Form->control('first_name', ['class'=>'form-control']) ?></div>
  <div class="col-md-6"><?= $this->Form->control('last_name', ['class'=>'form-control']) ?></div>
  <div class="col-md-6"><?= $this->Form->control('email', ['class'=>'form-control']) ?></div>
  <div class="col-md-6"><?= $this->Form->control('phone', ['class'=>'form-control']) ?></div>
  <div class="col-12"><?= $this->Form->control('message', ['class'=>'form-control', 'rows'=>4]) ?></div>
</div>
<div class="mt-4">
  <?= $this->Form->button('Send Message', ['class'=>'btn btn-primary px-4']) ?>
</div>
<?= $this->Form->end() ?>
</div>

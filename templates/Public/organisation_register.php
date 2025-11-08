<div class="card shadow-sm p-4">
<h2 class="fw-bold text-primary mb-4">Partner Organisation Registration</h2>

<?= $this->Form->create($organisation) ?>
<div class="row g-3">
  <div class="col-12"><?= $this->Form->control('org_name', ['class'=>'form-control']) ?></div>
  <div class="col-12"><?= $this->Form->control('business_address', ['class'=>'form-control', 'rows'=>2]) ?></div>
  <div class="col-md-6"><?= $this->Form->control('contact_person_full_name', ['class'=>'form-control']) ?></div>
  <div class="col-md-6"><?= $this->Form->control('email', ['class'=>'form-control']) ?></div>
  <div class="col-md-6"><?= $this->Form->control('phone', ['class'=>'form-control']) ?></div>
  <div class="col-md-6"><?= $this->Form->control('industry', ['class'=>'form-control']) ?></div>
  <div class="col-12"><?= $this->Form->control('help_description', ['class'=>'form-control', 'rows'=>3]) ?></div>
</div>
<div class="mt-4">
  <?= $this->Form->button('Submit Organisation', ['class'=>'btn btn-primary px-4']) ?>
</div>
<?= $this->Form->end() ?>
</div>

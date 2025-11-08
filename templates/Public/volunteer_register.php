<div class="card shadow-sm p-4">
<h2 class="fw-bold text-primary mb-4">Volunteer Registration</h2>

<?= $this->Form->create($signup, ['type'=>'file']) ?>
<div class="row g-3">
    <div class="col-md-6"><?= $this->Form->control('first_name', ['class'=>'form-control']) ?></div>
    <div class="col-md-6"><?= $this->Form->control('last_name', ['class'=>'form-control']) ?></div>
    <div class="col-md-6"><?= $this->Form->control('email', ['class'=>'form-control']) ?></div>
    <div class="col-md-6"><?= $this->Form->control('phone', ['class'=>'form-control']) ?></div>
    <div class="col-12"><?= $this->Form->control('skills', ['class'=>'form-control', 'rows'=>3]) ?></div>
    <div class="col-12"><?= $this->Form->control('interests', ['class'=>'form-control', 'rows'=>3]) ?></div>
    <div class="col-md-6"><?= $this->Form->control('profile_picture', ['type'=>'file', 'label'=>'Profile Picture']) ?></div>
    <div class="col-md-6"><?= $this->Form->control('documents', ['type'=>'file', 'label'=>'Supporting Documents']) ?></div>
</div>
<div class="mt-4">
    <?= $this->Form->button('Submit Registration', ['class'=>'btn btn-primary px-4']) ?>
</div>
<?= $this->Form->end() ?>
</div>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <?= $event->isNew() ? 'Add New Event' : 'Edit Event' ?>
        </h2>
        <?= $this->Html->link('Back', ['action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <?= $this->Form->create($event, ['class' => 'needs-validation', 'novalidate' => true]) ?>

            <!-- HIỂN THỊ LỖI VALIDATION -->
            <?php if ($event->getErrors()): ?>
                <div class="alert alert-danger">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($event->getErrors() as $field => $errors): ?>
                            <?php foreach ($errors as $error): ?>
                                <li><?= h($field) ?>: <?= h($error) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="row g-3">

                <!-- Basic Information -->
                <div class="col-12">
                    <h5 class="fw-bold text-secondary border-bottom pb-1">Basic Information</h5>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('title', [
                        'label' => 'Title',
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('location', [
                        'label' => 'Location',
                        'class' => 'form-control'
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('host', [
                        'label' => 'Host',
                        'class' => 'form-control'
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('organisation_id', [
                        'label' => 'Organisation',
                        'options' => $organisations,
                        'empty' => '(Select organisation)',
                        'class' => 'form-select'
                    ]) ?>
                </div>

                <!-- Event Details -->
                <div class="col-12 mt-4">
                    <h5 class="fw-bold text-secondary border-bottom pb-1">Event Details</h5>
                </div>

                <div class="col-md-4">
                    <?= $this->Form->control('event_date', [
                        'label' => 'Event Date',
                        'type' => 'date',
                        'class' => 'form-control',
                        'min' => date('Y-m-d')
                    ]) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Form->control('event_size', [
                        'label' => 'Event Size',
                        'type' => 'number',
                        'class' => 'form-control',
                        'min' => 1
                    ]) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Form->control('number_of_required_crews', [
                        'label' => 'Required Crews',
                        'type' => 'number',
                        'class' => 'form-control',
                        'min' => 0
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('status', [
                        'label' => 'Status',
                        'options' => [
                            'Preparing' => 'Preparing',
                            'Ready to go' => 'Ready to go',
                            'Archive' => 'Archive',
                            'Failed' => 'Failed'
                        ],
                        'class' => 'form-select'
                    ]) ?>
                </div>

                <!-- Contact -->
                <div class="col-12 mt-4">
                    <h5 class="fw-bold text-secondary border-bottom pb-1">Contact Information</h5>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('contact_person_full_name', [
                        'label' => 'Full Name',
                        'class' => 'form-control'
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('contact_person_email', [
                        'label' => 'Email',
                        'type' => 'email',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <!-- Description -->
                <div class="col-12 mt-4">
                    <h5 class="fw-bold text-secondary border-bottom pb-1">Description & Requirements</h5>
                </div>
                <div class="col-12">
                    <?= $this->Form->control('event_description', [
                        'label' => 'Description',
                        'type' => 'textarea',
                        'rows' => 3,
                        'class' => 'form-control'
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('required_equipment', [
                        'label' => 'Equipment',
                        'type' => 'textarea',
                        'rows' => 2,
                        'class' => 'form-control'
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('required_skills', [
                        'label' => 'Skills',
                        'type' => 'textarea',
                        'rows' => 2,
                        'class' => 'form-control'
                    ]) ?>
                </div>
            </div>

            <div class="mt-4">
                <?= $this->Form->button('Save Event', ['class' => 'btn btn-primary px-4']) ?>
                <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-outline-secondary ms-2 px-4']) ?>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
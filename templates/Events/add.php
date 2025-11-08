<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0 d-flex align-items-center gap-2">
            <span class="fs-4">➕</span>
            Add New Event
        </h2>
        <?= $this->Html->link(
            '<i class="bi bi-arrow-left"></i> Back to List',
            ['action' => 'index'],
            ['class' => 'btn btn-outline-secondary btn-sm', 'escape' => false]
        ) ?>
    </div>

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient bg-primary text-white py-3">
            <h5 class="mb-0 fw-semibold d-flex align-items-center gap-2">
                <i class="bi bi-calendar-event"></i>
                Create New Event
            </h5>
        </div>

        <div class="card-body p-4 p-lg-5">
            <?= $this->Form->create($event, ['class' => 'needs-validation', 'novalidate' => true]) ?>

            <!-- Validation Errors -->
            <?php if ($event->getErrors()): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
                    <strong><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($event->getErrors() as $field => $errors): ?>
                            <?php foreach ($errors as $error): ?>
                                <li><?= h($field) ?>: <?= h($error) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="row g-4">

                <!-- ========== Basic Information ========== -->
                <div class="col-12">
                    <h6 class="fw-bold text-primary border-bottom pb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle"></i> Basic Information
                    </h6>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('title', [
                        'label' => 'Event Title',
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Enter event title',
                        'required' => true
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('location', [
                        'label' => 'Location',
                        'class' => 'form-control',
                        'placeholder' => 'e.g. Hanoi, Vietnam'
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('host', [
                        'label' => 'Host Name',
                        'class' => 'form-control',
                        'placeholder' => 'Who is hosting?'
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('organisation_id', [
                        'label' => 'Organisation',
                        'options' => $organisations,
                        'empty' => '— Select Organisation —',
                        'class' => 'form-select'
                    ]) ?>
                </div>

                <!-- ========== Event Details ========== -->
                <div class="col-12 mt-4">
                    <h6 class="fw-bold text-success border-bottom pb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-calendar3"></i> Event Details
                    </h6>
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
                        'label' => 'Expected Attendees',
                        'type' => 'number',
                        'class' => 'form-control',
                        'min' => 1,
                        'placeholder' => 'e.g. 100'
                    ]) ?>
                </div>

                <div class="col-md-4">
                    <?= $this->Form->control('number_of_required_crews', [
                        'label' => 'Required Crews',
                        'type' => 'number',
                        'class' => 'form-control',
                        'min' => 0,
                        'placeholder' => 'e.g. 5'
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('status', [
                        'label' => 'Event Status',
                        'options' => [
                            'Preparing' => '🛠 Preparing',
                            'Ready to go' => '✅ Ready to go',
                            'Archive' => '📦 Archive',
                            'Failed' => '❌ Failed'
                        ],
                        'class' => 'form-select'
                    ]) ?>
                </div>

                <!-- ========== Contact Information ========== -->
                <div class="col-12 mt-4">
                    <h6 class="fw-bold text-info border-bottom pb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-person-lines-fill"></i> Contact Person
                    </h6>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('contact_person_full_name', [
                        'label' => 'Full Name',
                        'class' => 'form-control',
                        'placeholder' => 'John Doe'
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('contact_person_email', [
                        'label' => 'Email Address',
                        'type' => 'email',
                        'class' => 'form-control',
                        'placeholder' => 'contact@example.com'
                    ]) ?>
                </div>

                <!-- ========== Description & Requirements ========== -->
                <div class="col-12 mt-4">
                    <h6 class="fw-bold text-warning border-bottom pb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-file-text"></i> Description & Requirements
                    </h6>
                </div>

                <div class="col-12">
                    <?= $this->Form->control('event_description', [
                        'label' => 'Event Description',
                        'type' => 'textarea',
                        'rows' => 4,
                        'class' => 'form-control',
                        'placeholder' => 'Provide a detailed description of the event...'
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('required_equipment', [
                        'label' => 'Required Equipment',
                        'type' => 'textarea',
                        'rows' => 3,
                        'class' => 'form-control',
                        'placeholder' => 'e.g. Projector, microphone, tables...'
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('required_skills', [
                        'label' => 'Required Skills',
                        'type' => 'textarea',
                        'rows' => 3,
                        'class' => 'form-control',
                        'placeholder' => 'e.g. Event setup, crowd control, first aid...'
                    ]) ?>
                </div>

            </div>

            <!-- ========== Action Buttons ========== -->
            <div class="d-flex flex-wrap gap-2 mt-5 pt-3 border-top">
                <?= $this->Form->button(
                    '<i class="bi bi-check-circle"></i> Save Event',
                    ['class' => 'btn btn-primary btn-lg px-5', 'escape' => false]
                ) ?>
                <?= $this->Html->link(
                    '<i class="bi bi-x-lg"></i> Cancel',
                    ['action' => 'index'],
                    ['class' => 'btn btn-outline-danger px-4', 'escape' => false]
                ) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
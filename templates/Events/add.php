<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>

<style>
    :root {
        --m3-primary: #6750A4;
        --m3-primary-container: #EADDFF;
        --m3-surface: #FFFBFE;
        --m3-surface-variant: #E7E0EC;
        --m3-on-surface: #1C1B1F;
        --m3-outline: #79747E;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2.5rem 0;
        color: white;
        margin-bottom: 2rem;
        border-radius: 0 0 24px 24px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-title i {
        font-size: 2.25rem;
    }

    .page-subtitle {
        font-size: 1rem;
        opacity: 0.95;
    }

    .form-card {
        background: white;
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        border: 1px solid var(--m3-surface-variant);
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--m3-on-surface);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--m3-surface-variant);
    }

    .section-title i {
        color: var(--m3-primary);
        font-size: 1.5rem;
    }

    .form-control,
    .form-select {
        border-radius: 16px;
        border: 2px solid var(--m3-surface-variant);
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        background: var(--m3-surface);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--m3-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .form-control-lg {
        height: 56px;
    }

    textarea.form-control {
        min-height: 120px;
        padding: 1rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid var(--m3-surface-variant);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel {
        background: white;
        color: var(--m3-on-surface);
        border: 2px solid var(--m3-surface-variant);
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: var(--m3-surface-variant);
        color: var(--m3-on-surface);
        border-color: var(--m3-outline);
    }

    .alert-danger {
        background: #FEE2E2;
        border: 2px solid #DC2626;
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 2rem;
        color: #991B1B;
    }

    .alert-danger strong {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .alert-danger li {
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <i class="bi bi-plus-circle-fill"></i>
            Add New Event
        </h1>
        <p class="page-subtitle">Create a new event</p>
    </div>
</div>

<div class="container">
    <?= $this->Form->create($event, ['class' => 'needs-validation', 'novalidate' => true]) ?>
    
    <div class="form-card">
        <!-- Validation Errors -->
        <?php if ($event->getErrors()): ?>
            <div class="alert alert-danger" role="alert">
                <strong>
                    <i class="bi bi-exclamation-triangle"></i>
                    Please fix the following errors:
                </strong>
                <ul>
                    <?php foreach ($event->getErrors() as $field => $errors): ?>
                        <?php foreach ($errors as $error): ?>
                            <li><?= h($field) ?>: <?= h($error) ?></li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Basic Information -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-info-circle"></i>
                Basic Information
            </h3>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('title', [
                        'label' => 'Event Title',
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Enter event title',
                        'required' => true
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('location', [
                        'label' => 'Location',
                        'class' => 'form-control',
                        'placeholder' => 'e.g. Hanoi, Vietnam'
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('host', [
                        'label' => 'Host Name',
                        'class' => 'form-control',
                        'placeholder' => 'Who is hosting?'
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('organisation_id', [
                        'label' => 'Organisation',
                        'options' => $organisations,
                        'empty' => '— Select Organisation —',
                        'class' => 'form-select'
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Event Details -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-calendar3"></i>
                Event Details
            </h3>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('event_date', [
                        'label' => 'Event Date',
                        'type' => 'date',
                        'class' => 'form-control',
                        'min' => date('Y-m-d')
                    ]) ?>
                </div>

                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('event_size', [
                        'label' => 'Expected Attendees',
                        'type' => 'number',
                        'class' => 'form-control',
                        'min' => 1,
                        'placeholder' => 'e.g. 100'
                    ]) ?>
                </div>

                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('number_of_required_crews', [
                        'label' => 'Required Crews',
                        'type' => 'number',
                        'class' => 'form-control',
                        'min' => 0,
                        'placeholder' => 'e.g. 5'
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
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
            </div>
        </div>

        <!-- Contact Information -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-person-lines-fill"></i>
                Contact Person
            </h3>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('contact_person_full_name', [
                        'label' => 'Full Name',
                        'class' => 'form-control',
                        'placeholder' => 'John Doe'
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('contact_person_email', [
                        'label' => 'Email Address',
                        'type' => 'email',
                        'class' => 'form-control',
                        'placeholder' => 'contact@example.com'
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Description & Requirements -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-file-text"></i>
                Description & Requirements
            </h3>
            
            <div class="row">
                <div class="col-12 mb-3">
                    <?= $this->Form->control('event_description', [
                        'label' => 'Event Description',
                        'type' => 'textarea',
                        'rows' => 4,
                        'class' => 'form-control',
                        'placeholder' => 'Provide a detailed description of the event...'
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('required_equipment', [
                        'label' => 'Required Equipment',
                        'type' => 'textarea',
                        'rows' => 3,
                        'class' => 'form-control',
                        'placeholder' => 'e.g. Projector, microphone, tables...'
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('required_skills', [
                        'label' => 'Required Skills',
                        'type' => 'textarea',
                        'rows' => 3,
                        'class' => 'form-control',
                        'placeholder' => 'e.g. Event setup, crowd control, first aid...'
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="form-actions">
            <?= $this->Form->button(
                '<i class="bi bi-check-circle"></i> Save Event',
                ['class' => 'btn-submit', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="bi bi-x-lg"></i> Cancel',
                ['action' => 'index'],
                ['class' => 'btn-cancel', 'escape' => false]
            ) ?>
        </div>
    </div>
    
    <?= $this->Form->end() ?>
</div>

<?= $this->element('success_modal', [
    'modalId' => 'addSuccessModal',
    'title' => 'Event Created!',
    'message' => 'The event has been created successfully.',
    'actionLink' => ['action' => 'index'],
    'actionText' => 'View All Events'
]) ?>

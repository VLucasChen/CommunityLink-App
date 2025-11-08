<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organisation $organisation
 */
?>

<style>
    :root {
        --m3-primary: #6750A4;
        --m3-primary-container: #EADDFF;
        --m3-surface: #FFFBFE;
        --m3-surface-variant: #E7E0EC;
        --m3-on-primary: #FFFFFF;
        --m3-on-surface: #1C1B1F;
        --m3-outline: #79747E;
        --m3-error: #BA1A1A;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 0;
        color: white;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .page-header-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto;
    }

    .registration-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .registration-card {
        background: white;
        border-radius: 24px;
        padding: 3rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        margin-bottom: 3rem;
        border: 1px solid var(--m3-surface-variant);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--m3-primary);
        font-size: 1.75rem;
    }

    .section-subtitle {
        color: var(--m3-outline);
        margin-bottom: 2rem;
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid var(--m3-surface-variant);
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        color: var(--m3-on-surface);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--m3-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-control::placeholder {
        color: var(--m3-outline);
        opacity: 0.6;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .error-message {
        color: var(--m3-error);
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .registration-card {
            padding: 2rem 1.5rem;
        }

        .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="page-header-content">
            <h1 class="page-title">
                <i class="bi bi-building"></i>
                Partner Organisation Registration
            </h1>
            <p class="page-subtitle">
                Join us as a partner organisation and help make a positive impact in your community
            </p>
        </div>
    </div>
</div>

<div class="container">
    <div class="registration-container">
        <div class="registration-card">
            <h2 class="section-title">
                <i class="bi bi-info-circle"></i>
                Organisation Information
            </h2>
            <p class="section-subtitle">Please provide your organisation details below</p>

            <?= $this->Form->create($organisation, ['class' => 'organisation-form']) ?>
            
            <div class="form-group">
                <?= $this->Form->label('org_name', 'Organisation Name', ['class' => 'form-label']) ?>
                <?= $this->Form->control('org_name', [
                    'class' => 'form-control',
                    'label' => false,
                    'placeholder' => 'Enter your organisation name',
                    'required' => true
                ]) ?>
                <?php if (isset($organisation->getErrors()['org_name'])): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= h($organisation->getErrors()['org_name'][0]) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <?= $this->Form->label('business_address', 'Business Address', ['class' => 'form-label']) ?>
                <?= $this->Form->control('business_address', [
                    'class' => 'form-control',
                    'label' => false,
                    'type' => 'textarea',
                    'rows' => 3,
                    'placeholder' => 'Enter your business address',
                    'required' => true
                ]) ?>
                <?php if (isset($organisation->getErrors()['business_address'])): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= h($organisation->getErrors()['business_address'][0]) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->Form->label('contact_person_full_name', 'Contact Person Name', ['class' => 'form-label']) ?>
                        <?= $this->Form->control('contact_person_full_name', [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Full name of contact person',
                            'required' => true
                        ]) ?>
                        <?php if (isset($organisation->getErrors()['contact_person_full_name'])): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= h($organisation->getErrors()['contact_person_full_name'][0]) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->Form->label('email', 'Email Address', ['class' => 'form-label']) ?>
                        <?= $this->Form->control('email', [
                            'class' => 'form-control',
                            'label' => false,
                            'type' => 'email',
                            'placeholder' => 'organisation@example.com',
                            'required' => true
                        ]) ?>
                        <?php if (isset($organisation->getErrors()['email'])): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= h($organisation->getErrors()['email'][0]) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->Form->label('phone', 'Phone Number', ['class' => 'form-label']) ?>
                        <?= $this->Form->control('phone', [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Enter phone number',
                            'required' => true
                        ]) ?>
                        <?php if (isset($organisation->getErrors()['phone'])): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= h($organisation->getErrors()['phone'][0]) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->Form->label('industry', 'Industry', ['class' => 'form-label']) ?>
                        <?= $this->Form->control('industry', [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'e.g., Education, Healthcare, Environment',
                            'required' => true
                        ]) ?>
                        <?php if (isset($organisation->getErrors()['industry'])): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= h($organisation->getErrors()['industry'][0]) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('help_description', 'How Can You Help?', ['class' => 'form-label']) ?>
                <?= $this->Form->control('help_description', [
                    'class' => 'form-control',
                    'label' => false,
                    'type' => 'textarea',
                    'rows' => 4,
                    'placeholder' => 'Describe how your organisation can contribute to community events and volunteer activities...',
                    'required' => true
                ]) ?>
                <?php if (isset($organisation->getErrors()['help_description'])): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= h($organisation->getErrors()['help_description'][0]) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle"></i> Submit Organisation
                </button>
            </div>

<?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->element('success_modal', [
    'modalId' => 'organisationSuccessModal',
    'title' => 'Registration Successful!',
    'message' => 'Your organisation has been registered successfully. We will review your application and get back to you soon!'
]) ?>

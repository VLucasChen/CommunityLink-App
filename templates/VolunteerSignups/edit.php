<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VolunteerSignup $volunteerSignup
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

    .input-wrapper {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--m3-outline);
        z-index: 10;
        transition: color 0.3s ease;
        pointer-events: none;
        font-size: 1.1rem;
    }

    .form-floating > label {
        color: var(--m3-outline);
        padding-left: 3rem;
    }

    .form-floating > .form-control {
        border-radius: 16px;
        border: 2px solid var(--m3-surface-variant);
        padding-left: 3rem;
        height: 56px;
        transition: all 0.3s ease;
        background: var(--m3-surface);
    }

    .form-floating > .form-control:focus {
        border-color: var(--m3-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-floating > .form-control:focus ~ .input-icon {
        color: var(--m3-primary);
    }

    .textarea-wrapper {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .textarea-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .textarea-label:hover {
        color: var(--m3-primary);
    }

    .textarea-label i {
        color: var(--m3-primary);
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .textarea-wrapper:has(textarea:focus) .textarea-label {
        color: var(--m3-primary);
    }

    .textarea-wrapper:has(textarea:focus) .textarea-label i {
        transform: scale(1.1);
    }

    .textarea-wrapper textarea.form-control {
        padding: 1rem;
        border-radius: 16px;
        border: 2px solid var(--m3-surface-variant);
        transition: all 0.3s ease;
        background: var(--m3-surface);
        min-height: 120px;
    }

    .textarea-wrapper textarea.form-control:focus {
        border-color: var(--m3-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .textarea-wrapper .form-floating > label {
        display: none;
    }

    .form-select {
        border-radius: 16px;
        border: 2px solid var(--m3-surface-variant);
        padding: 0.75rem 1rem;
        height: 56px;
        transition: all 0.3s ease;
        background: var(--m3-surface);
    }

    .form-select:focus {
        border-color: var(--m3-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .file-upload-area {
        border: 2px dashed var(--m3-surface-variant);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        background: var(--m3-surface);
        margin-bottom: 1.5rem;
    }

    .file-upload-area:hover {
        border-color: var(--m3-primary);
        background: var(--m3-primary-container);
    }

    .file-upload-area i {
        font-size: 3rem;
        color: var(--m3-outline);
        margin-bottom: 1rem;
        display: block;
    }

    .file-upload-area input[type="file"] {
        margin-top: 1rem;
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

    .error-message {
        color: #DC2626;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
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
            <i class="bi bi-pencil-square"></i>
            Edit Volunteer Signup
        </h1>
        <p class="page-subtitle">Update volunteer registration information</p>
    </div>
</div>

<div class="container">
    <?= $this->Form->create($volunteerSignup, ['type' => 'file', 'class' => 'volunteer-signup-form']) ?>
    
    <div class="form-card">
        <!-- Personal Information -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-person"></i>
                Personal Information
            </h3>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="input-wrapper">
                        <i class="bi bi-person-fill input-icon"></i>
                        <div class="form-floating">
                            <?= $this->Form->text('first_name', [
                                'required' => true,
                                'class' => 'form-control',
                                'placeholder' => 'First Name',
                                'id' => 'first_name'
                            ]) ?>
                            <?= $this->Form->label('first_name', 'First Name', ['for' => 'first_name']) ?>
                        </div>
                        <?php if ($this->Form->isFieldError('first_name')): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= $this->Form->error('first_name') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-wrapper">
                        <i class="bi bi-person-fill input-icon"></i>
                        <div class="form-floating">
                            <?= $this->Form->text('last_name', [
                                'required' => true,
                                'class' => 'form-control',
                                'placeholder' => 'Last Name',
                                'id' => 'last_name'
                            ]) ?>
                            <?= $this->Form->label('last_name', 'Last Name', ['for' => 'last_name']) ?>
                        </div>
                        <?php if ($this->Form->isFieldError('last_name')): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= $this->Form->error('last_name') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="input-wrapper">
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <div class="form-floating">
                            <?= $this->Form->email('email', [
                                'required' => true,
                                'class' => 'form-control',
                                'placeholder' => 'Email',
                                'id' => 'email'
                            ]) ?>
                            <?= $this->Form->label('email', 'Email', ['for' => 'email']) ?>
                        </div>
                        <?php if ($this->Form->isFieldError('email')): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= $this->Form->error('email') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-wrapper">
                        <i class="bi bi-telephone-fill input-icon"></i>
                        <div class="form-floating">
                            <?= $this->Form->text('phone', [
                                'required' => true,
                                'class' => 'form-control',
                                'placeholder' => 'Phone',
                                'id' => 'phone'
                            ]) ?>
                            <?= $this->Form->label('phone', 'Phone', ['for' => 'phone']) ?>
                        </div>
                        <?php if ($this->Form->isFieldError('phone')): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= $this->Form->error('phone') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skills & Interests -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-tools"></i>
                Skills & Interests
            </h3>
            
            <div class="textarea-wrapper">
                <label class="textarea-label" for="skills">
                    <i class="bi bi-tools"></i>
                    Skills (Please list your skills and expertise)
                </label>
                <div class="form-floating">
                    <?= $this->Form->textarea('skills', [
                        'required' => true,
                        'class' => 'form-control',
                        'placeholder' => 'Skills',
                        'id' => 'skills',
                        'rows' => 4
                    ]) ?>
                    <?= $this->Form->label('skills', 'Skills', ['for' => 'skills', 'style' => 'display: none;']) ?>
                </div>
                <?php if ($this->Form->isFieldError('skills')): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= $this->Form->error('skills') ?>
                    </div>
                <?php endif; ?>
                <small class="text-muted" style="font-size: 0.85rem; margin-top: 0.5rem; display: block;">
                    <i class="bi bi-info-circle"></i> Describe your skills, qualifications, and areas of expertise
                </small>
            </div>

            <div class="textarea-wrapper">
                <label class="textarea-label" for="interests">
                    <i class="bi bi-heart"></i>
                    Interests
                </label>
                <div class="form-floating">
                    <?= $this->Form->textarea('interests', [
                        'class' => 'form-control',
                        'placeholder' => 'Interests',
                        'id' => 'interests',
                        'rows' => 4
                    ]) ?>
                    <?= $this->Form->label('interests', 'Interests', ['for' => 'interests', 'style' => 'display: none;']) ?>
                </div>
                <?php if ($this->Form->isFieldError('interests')): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= $this->Form->error('interests') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Message -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-chat-left-text"></i>
                Additional Information
            </h3>
            
            <div class="textarea-wrapper">
                <label class="textarea-label" for="message">
                    <i class="bi bi-chat-left-text"></i>
                    Message
                </label>
                <div class="form-floating">
                    <?= $this->Form->textarea('message', [
                        'class' => 'form-control',
                        'placeholder' => 'Message',
                        'id' => 'message',
                        'rows' => 4
                    ]) ?>
                    <?= $this->Form->label('message', 'Message', ['for' => 'message', 'style' => 'display: none;']) ?>
                </div>
                <?php if ($this->Form->isFieldError('message')): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= $this->Form->error('message') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Files & Status -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-file-earmark"></i>
                Files & Status
            </h3>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="file-upload-area">
                        <i class="bi bi-image"></i>
                        <div>
                            <strong>Profile Picture</strong>
                            <p class="text-muted mb-2" style="font-size: 0.875rem;">Current: <?= $volunteerSignup->profile_picture ? h($volunteerSignup->profile_picture) : 'No file' ?></p>
                            <?= $this->Form->file('profile_picture', [
                                'class' => 'form-control',
                                'accept' => 'image/*'
                            ]) ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="file-upload-area">
                        <i class="bi bi-file-earmark-text"></i>
                        <div>
                            <strong>Documents</strong>
                            <p class="text-muted mb-2" style="font-size: 0.875rem;">Current: <?= $volunteerSignup->documents ? h($volunteerSignup->documents) : 'No file' ?></p>
                            <?= $this->Form->file('documents', [
                                'class' => 'form-control',
                                'accept' => '.pdf,.doc,.docx'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="status" style="display: flex; align-items: center; gap: 0.75rem; font-weight: 600; color: var(--m3-on-surface); margin-bottom: 0.75rem;">
                    <i class="bi bi-flag" style="color: var(--m3-primary);"></i>
                    Status
                </label>
                <?= $this->Form->select('status', [
                    'pending' => 'Pending',
                    'hired' => 'Hired',
                    'declined' => 'Declined'
                ], [
                    'class' => 'form-select',
                    'id' => 'status',
                    'value' => $volunteerSignup->status ?? 'pending'
                ]) ?>
                <?php if ($this->Form->isFieldError('status')): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= $this->Form->error('status') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <?= $this->Html->link(
                '<i class="bi bi-x-circle"></i> Cancel',
                ['action' => 'view', $volunteerSignup->id],
                ['class' => 'btn-cancel', 'escape' => false]
            ) ?>
            <button type="submit" class="btn-submit">
                <i class="bi bi-check-circle"></i> Save Changes
            </button>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>

<?= $this->element('success_modal', [
    'modalId' => 'successModal',
    'title' => 'Update Successful!',
    'message' => 'The volunteer signup information has been updated successfully.',
    'actionLink' => ['action' => 'index'],
    'actionText' => 'View List'
]) ?>

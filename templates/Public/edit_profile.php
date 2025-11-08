<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \App\Model\Entity\Volunteer $volunteer
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
        --m3-error: #BA1A1A;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 0;
        color: white;
        margin-bottom: 2rem;
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
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-title i {
        font-size: 2.75rem;
    }

    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .action-bar {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .btn-back {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        background: var(--m3-primary-container);
        color: var(--m3-primary);
        border: 2px solid var(--m3-primary);
    }

    .btn-back:hover {
        background: var(--m3-primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
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
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--m3-surface-variant);
    }

    .form-section:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--m3-primary);
        font-size: 1.75rem;
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
        z-index: 5;
        transition: color 0.3s ease;
        pointer-events: none;
        font-size: 1.1rem;
    }

    .form-floating {
        margin-bottom: 1.5rem;
    }

    .form-floating > label {
        color: var(--m3-outline);
        padding-left: 3rem;
    }

    .form-floating > .form-control,
    .form-floating > .form-select {
        border-radius: 16px;
        border: 2px solid var(--m3-surface-variant);
        padding-left: 3rem;
        height: 56px;
        transition: all 0.3s ease;
        background: var(--m3-surface);
    }

    .form-floating > .form-control:focus,
    .form-floating > .form-select:focus {
        border-color: var(--m3-primary);
        box-shadow: 0 0 0 3px rgba(103, 80, 164, 0.1);
        background: var(--m3-surface);
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label,
    .form-floating > .form-select:focus ~ label,
    .form-floating > .form-select:not([value=""]) ~ label {
        color: var(--m3-primary);
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .input-wrapper:has(.form-control:focus) .input-icon,
    .input-wrapper:has(.form-control:not(:placeholder-shown)) .input-icon {
        color: var(--m3-primary);
    }

    textarea.form-control {
        min-height: 120px;
        padding: 1rem;
        padding-left: 1rem;
        resize: vertical;
        line-height: 1.5;
    }

    .textarea-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .textarea-label i {
        color: var(--m3-primary);
        font-size: 1.2rem;
    }

    .textarea-wrapper textarea.form-control {
        padding-left: 1rem;
    }

    .textarea-wrapper .form-floating > label {
        display: none;
    }

    .file-upload-wrapper {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .file-upload-label {
        display: block;
        font-weight: 500;
        color: var(--m3-on-surface);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .file-upload-area {
        border: 2px dashed var(--m3-surface-variant);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        background: var(--m3-surface);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .file-upload-area:hover {
        border-color: var(--m3-primary);
        background: var(--m3-primary-container);
    }

    .file-upload-area.dragover {
        border-color: var(--m3-primary);
        background: var(--m3-primary-container);
        transform: scale(1.02);
    }

    .file-upload-icon {
        font-size: 3rem;
        color: var(--m3-outline);
        margin-bottom: 1rem;
    }

    .file-upload-text {
        color: var(--m3-outline);
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .file-upload-hint {
        color: var(--m3-outline);
        font-size: 0.85rem;
        opacity: 0.7;
    }

    .file-input-hidden {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        top: 0;
        left: 0;
    }

    .file-preview {
        margin-top: 1rem;
        padding: 1rem;
        background: var(--m3-surface-variant);
        border-radius: 12px;
        display: none;
    }

    .file-preview.show {
        display: block;
    }

    .file-preview-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem;
        background: white;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }

    .file-preview-item:last-child {
        margin-bottom: 0;
    }

    .file-preview-icon {
        font-size: 2rem;
        color: var(--m3-primary);
    }

    .file-preview-info {
        flex: 1;
    }

    .file-preview-name {
        font-weight: 500;
        color: var(--m3-on-surface);
        margin-bottom: 0.25rem;
    }

    .file-preview-size {
        font-size: 0.85rem;
        color: var(--m3-outline);
    }

    .file-remove-btn {
        background: none;
        border: none;
        color: var(--m3-error);
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .file-remove-btn:hover {
        background: rgba(186, 26, 26, 0.1);
    }

    .current-file {
        margin-top: 0.5rem;
        padding: 0.75rem;
        background: var(--m3-primary-container);
        border-radius: 8px;
        font-size: 0.875rem;
        color: var(--m3-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .current-file i {
        font-size: 1.2rem;
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
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
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

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: var(--m3-error);
        margin-left: 3rem;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: var(--m3-error);
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(186, 26, 26, 0.1);
    }

    .input-wrapper:has(.form-control.is-invalid) .input-icon {
        color: var(--m3-error);
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

        .page-title {
            font-size: 2rem;
        }

        .page-title i {
            font-size: 2.25rem;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="page-header-content">
            <h1 class="page-title">
                <i class="bi bi-pencil-square"></i>
                Edit Profile
            </h1>
            <p class="page-subtitle">Update your profile information</p>
        </div>
    </div>
</div>

<div class="container">
    <!-- Action Bar -->
    <div class="action-bar">
        <?= $this->Html->link(
            '<i class="bi bi-arrow-left"></i> Back to Profile',
            ['controller' => 'Public', 'action' => 'profile', $user->id],
            ['class' => 'btn-back', 'escape' => false]
        ) ?>
    </div>

    <?= $this->Form->create($volunteer, ['type' => 'file', 'class' => 'needs-validation', 'novalidate' => true]) ?>
    
    <div class="form-card">
        <!-- Validation Errors -->
        <?php if ($volunteer->getErrors()): ?>
            <div class="alert alert-danger" role="alert">
                <strong>
                    <i class="bi bi-exclamation-triangle"></i>
                    Please fix the following errors:
                </strong>
                <ul>
                    <?php foreach ($volunteer->getErrors() as $field => $errors): ?>
                        <?php foreach ($errors as $error): ?>
                            <li><?= h($field) ?>: <?= h($error) ?></li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Personal Information -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-person-circle"></i>
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
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-wrapper">
                        <i class="bi bi-person-fill input-icon"></i>
                        <div class="form-floating">
                            <?= $this->Form->text('last_name', [
                                'class' => 'form-control',
                                'placeholder' => 'Last Name',
                                'id' => 'last_name'
                            ]) ?>
                            <?= $this->Form->label('last_name', 'Last Name', ['for' => 'last_name']) ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-wrapper">
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <div class="form-floating">
                            <?= $this->Form->email('email', [
                                'class' => 'form-control',
                                'placeholder' => 'Email Address',
                                'id' => 'email'
                            ]) ?>
                            <?= $this->Form->label('email', 'Email Address', ['for' => 'email']) ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-wrapper">
                        <i class="bi bi-telephone-fill input-icon"></i>
                        <div class="form-floating">
                            <?= $this->Form->text('phone', [
                                'class' => 'form-control',
                                'placeholder' => 'Phone Number',
                                'id' => 'phone'
                            ]) ?>
                            <?= $this->Form->label('phone', 'Phone Number', ['for' => 'phone']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skills & Information -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-lightbulb-fill"></i>
                Skills & Information
            </h3>
            
            <div class="input-wrapper textarea-wrapper">
                <label class="textarea-label" for="skills">
                    <i class="bi bi-tools"></i>
                    Skills
                </label>
                <div class="form-floating">
                    <?= $this->Form->textarea('skills', [
                        'class' => 'form-control',
                        'placeholder' => 'List your skills and expertise...',
                        'id' => 'skills',
                        'rows' => 4
                    ]) ?>
                    <?= $this->Form->label('skills', 'Skills', ['for' => 'skills', 'style' => 'display: none;']) ?>
                </div>
            </div>

            <div class="input-wrapper textarea-wrapper">
                <label class="textarea-label" for="availability">
                    <i class="bi bi-calendar-check"></i>
                    Availability
                </label>
                <div class="form-floating">
                    <?= $this->Form->textarea('availability', [
                        'class' => 'form-control',
                        'placeholder' => 'Describe your availability...',
                        'id' => 'availability',
                        'rows' => 3
                    ]) ?>
                    <?= $this->Form->label('availability', 'Availability', ['for' => 'availability', 'style' => 'display: none;']) ?>
                </div>
            </div>

            <div class="input-wrapper textarea-wrapper">
                <label class="textarea-label" for="self_intro">
                    <i class="bi bi-chat-dots-fill"></i>
                    Self Introduction
                </label>
                <div class="form-floating">
                    <?= $this->Form->textarea('self_intro', [
                        'class' => 'form-control',
                        'placeholder' => 'Tell us about yourself...',
                        'id' => 'self_intro',
                        'rows' => 4
                    ]) ?>
                    <?= $this->Form->label('self_intro', 'Self Introduction', ['for' => 'self_intro', 'style' => 'display: none;']) ?>
                </div>
            </div>
        </div>

        <!-- Files & Documents -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-cloud-upload-fill"></i>
                Documents & Photos
            </h3>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="file-upload-wrapper">
                        <label class="file-upload-label">
                            <i class="bi bi-image"></i> Profile Picture
                        </label>
                        <?php if ($volunteer->profile_picture): ?>
                            <div class="current-file">
                                <i class="bi bi-file-image"></i>
                                Current: <?= basename($volunteer->profile_picture) ?>
                            </div>
                        <?php endif; ?>
                        <div class="file-upload-area" id="profilePictureArea">
                            <div class="file-upload-icon">
                                <i class="bi bi-cloud-upload"></i>
                            </div>
                            <div class="file-upload-text">Click to upload or drag and drop</div>
                            <div class="file-upload-hint">PNG, JPG up to 5MB</div>
                            <?= $this->Form->file('profile_picture', [
                                'class' => 'file-input-hidden',
                                'id' => 'profile_picture',
                                'accept' => 'image/*'
                            ]) ?>
                        </div>
                        <div class="file-preview" id="profilePicturePreview"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="file-upload-wrapper">
                        <label class="file-upload-label">
                            <i class="bi bi-file-earmark-pdf"></i> Supporting Documents (CV, Certificates)
                        </label>
                        <?php if ($volunteer->documents): ?>
                            <div class="current-file">
                                <i class="bi bi-file-earmark-pdf"></i>
                                Current: <?= basename($volunteer->documents) ?>
                            </div>
                        <?php endif; ?>
                        <div class="file-upload-area" id="documentsArea">
                            <div class="file-upload-icon">
                                <i class="bi bi-cloud-upload"></i>
                            </div>
                            <div class="file-upload-text">Click to upload or drag and drop</div>
                            <div class="file-upload-hint">PDF, DOC, DOCX up to 10MB</div>
                            <?= $this->Form->file('documents', [
                                'class' => 'file-input-hidden',
                                'id' => 'documents',
                                'accept' => '.pdf,.doc,.docx'
                            ]) ?>
                        </div>
                        <div class="file-preview" id="documentsPreview"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="bi bi-check-circle"></i> Update Profile
            </button>
            <?= $this->Html->link(
                '<i class="bi bi-x-lg"></i> Cancel',
                ['controller' => 'Public', 'action' => 'profile', $user->id],
                ['class' => 'btn-cancel', 'escape' => false]
            ) ?>
        </div>
    </div>
    
    <?= $this->Form->end() ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload handling
    function setupFileUpload(inputId, areaId, previewId, acceptImages = false) {
        const input = document.getElementById(inputId);
        const area = document.getElementById(areaId);
        const preview = document.getElementById(previewId);

        if (!input || !area || !preview) return;

        // Click to upload
        area.addEventListener('click', () => input.click());

        // Drag and drop
        area.addEventListener('dragover', (e) => {
            e.preventDefault();
            area.classList.add('dragover');
        });

        area.addEventListener('dragleave', () => {
            area.classList.remove('dragover');
        });

        area.addEventListener('drop', (e) => {
            e.preventDefault();
            area.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                input.files = files;
                handleFileSelect(files[0], preview, acceptImages);
            }
        });

        // File selected
        input.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0], preview, acceptImages);
            }
        });
    }

    function handleFileSelect(file, preview, isImage) {
        preview.innerHTML = '';
        preview.classList.add('show');

        const fileItem = document.createElement('div');
        fileItem.className = 'file-preview-item';

        const icon = document.createElement('div');
        icon.className = 'file-preview-icon';
        if (isImage) {
            icon.innerHTML = '<i class="bi bi-image"></i>';
        } else {
            icon.innerHTML = '<i class="bi bi-file-earmark-pdf"></i>';
        }

        const info = document.createElement('div');
        info.className = 'file-preview-info';
        const name = document.createElement('div');
        name.className = 'file-preview-name';
        name.textContent = file.name;
        const size = document.createElement('div');
        size.className = 'file-preview-size';
        size.textContent = formatFileSize(file.size);
        info.appendChild(name);
        info.appendChild(size);

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'file-remove-btn';
        removeBtn.innerHTML = '<i class="bi bi-x-circle-fill"></i>';
        removeBtn.onclick = () => {
            preview.classList.remove('show');
            preview.innerHTML = '';
            const inputId = preview.id.includes('profile') ? 'profile_picture' : 'documents';
            document.getElementById(inputId).value = '';
        };

        fileItem.appendChild(icon);
        fileItem.appendChild(info);
        fileItem.appendChild(removeBtn);
        preview.appendChild(fileItem);
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    // Setup file uploads
    setupFileUpload('profile_picture', 'profilePictureArea', 'profilePicturePreview', true);
    setupFileUpload('documents', 'documentsArea', 'documentsPreview', false);
});
</script>


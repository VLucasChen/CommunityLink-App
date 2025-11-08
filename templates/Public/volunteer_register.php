<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VolunteerSignup $signup
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

    .volunteer-register-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 0;
        color: white;
        margin-bottom: 3rem;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-align: center;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        text-align: center;
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

    .section-subtitle {
        color: var(--m3-outline);
        margin-bottom: 2rem;
        font-size: 0.95rem;
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

    /* Textarea label with icon - new approach */
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
        padding-left: 1rem;
    }

    .textarea-wrapper .form-floating > label {
        display: none;
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
        padding-bottom: 0.75rem;
        resize: vertical;
        line-height: 1.5;
    }

    /* File Upload Styling */
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

    /* Button Styling */
    .btn-submit {
        width: 100%;
        height: 56px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        border: none;
        color: var(--m3-on-primary);
        font-weight: 600;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(103, 80, 164, 0.3);
        margin-top: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(103, 80, 164, 0.4);
        background: linear-gradient(135deg, #7B5FC7 0%, #8555B5 100%);
        color: white;
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Error Styling */
    .error-message {
        color: var(--m3-error);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
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

    /* Show validation errors below fields */
    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: var(--m3-error);
        margin-left: 3rem;
    }

    /* Alert Styling */
    .alert {
        border-radius: 16px;
        border: none;
        padding: 1rem 1.25rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .alert-success {
        background: #D1FAE5;
        color: #065F46;
        border-left: 4px solid #10B981;
    }

    .alert-danger {
        background: #FEE2E2;
        color: #991B1B;
        border-left: 4px solid #DC2626;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .registration-card {
            padding: 2rem 1.5rem;
            border-radius: 20px;
        }

        .hero-title {
            font-size: 2rem;
        }

        .section-title {
            font-size: 1.25rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="volunteer-register-hero">
    <div class="container">
        <h1 class="hero-title">Join Our Volunteer Community</h1>
        <p class="hero-subtitle">
            Make a difference in your community. Register as a volunteer and start contributing to meaningful events and causes.
        </p>
    </div>
</section>

<div class="registration-container">
    <div class="registration-card">
        <div class="section-title">
            <i class="bi bi-person-plus-fill" style="color: var(--m3-primary);"></i>
            Volunteer Registration Form
        </div>
        <p class="section-subtitle">Please fill out all required fields to complete your registration.</p>

        <!-- Validation Errors -->
        <?php if ($signup->getErrors()): ?>
            <div class="alert alert-danger">
                <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    <?php foreach ($signup->getErrors() as $field => $errors): ?>
                        <?php foreach ($errors as $error): ?>
                            <li><?= h($error) ?></li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?= $this->Form->create($signup, [
            'type' => 'file',
            'class' => 'volunteer-registration-form',
            'novalidate' => true,
            'id' => 'volunteerForm'
        ]) ?>

        <!-- Personal Information Section -->
        <div class="form-section">
            <h3 class="section-title" style="font-size: 1.25rem; margin-bottom: 1.5rem;">
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
                                'required' => true,
                                'class' => 'form-control',
                                'placeholder' => 'Last Name',
                                'id' => 'last_name'
                            ]) ?>
                            <?= $this->Form->label('last_name', 'Last Name', ['for' => 'last_name']) ?>
                        </div>
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
                                'required' => true,
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

        <!-- Skills & Interests Section -->
        <div class="form-section">
            <h3 class="section-title" style="font-size: 1.25rem; margin-bottom: 1.5rem;">
                <i class="bi bi-lightbulb-fill"></i>
                Skills & Interests
            </h3>

            <div class="input-wrapper textarea-wrapper">
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
                <small class="text-muted" style="font-size: 0.85rem; margin-top: 0.5rem; display: block;">
                    <i class="bi bi-info-circle"></i> Describe your skills, qualifications, and areas of expertise
                </small>
            </div>

            <div class="input-wrapper textarea-wrapper">
                <label class="textarea-label" for="interests">
                    <i class="bi bi-heart-fill"></i>
                    Interests (What causes are you passionate about?)
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
                <small class="text-muted" style="font-size: 0.85rem; margin-top: 0.5rem; display: block;">
                    <i class="bi bi-info-circle"></i> Tell us about your interests and what motivates you to volunteer
                </small>
            </div>
        </div>

        <!-- Additional Message Section -->
        <div class="form-section">
            <h3 class="section-title" style="font-size: 1.25rem; margin-bottom: 1.5rem;">
                <i class="bi bi-chat-left-text-fill"></i>
                Additional Information
            </h3>

            <div class="input-wrapper textarea-wrapper">
                <label class="textarea-label" for="message">
                    <i class="bi bi-chat-dots-fill"></i>
                    Additional Message (Optional)
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
                <small class="text-muted" style="font-size: 0.85rem; margin-top: 0.5rem; display: block;">
                    <i class="bi bi-info-circle"></i> Any additional information you'd like to share with us
                </small>
            </div>
        </div>

        <!-- File Upload Section -->
        <div class="form-section">
            <h3 class="section-title" style="font-size: 1.25rem; margin-bottom: 1.5rem;">
                <i class="bi bi-cloud-upload-fill"></i>
                Documents & Photos
            </h3>

            <div class="row">
                <div class="col-md-6">
                    <div class="file-upload-wrapper">
                        <label class="file-upload-label">
                            <i class="bi bi-image"></i> Profile Picture
                        </label>
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

        <!-- Submit Button -->
        <button type="submit" class="btn btn-submit">
            <i class="bi bi-check-circle-fill"></i> Submit Registration
        </button>

<?= $this->Form->end() ?>
    </div>
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
            document.getElementById(file.name.includes('profile') ? 'profile_picture' : 'documents').value = '';
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

<?= $this->element('success_modal', [
    'modalId' => 'volunteerSuccessModal',
    'title' => 'Registration Successful!',
    'message' => 'Thank you for joining CommunityLink. Your registration has been submitted successfully!'
]) ?>

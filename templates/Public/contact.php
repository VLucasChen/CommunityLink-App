<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactMessage $contact
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

    .contact-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .contact-card {
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
        min-height: 120px;
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

    .info-box {
        background: var(--m3-primary-container);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--m3-primary);
    }

    .info-box-title {
        font-weight: 600;
        color: var(--m3-primary);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-box-text {
        color: var(--m3-on-surface);
        font-size: 0.95rem;
        margin: 0;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .contact-card {
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
                <i class="bi bi-envelope-heart"></i>
                Contact Us
            </h1>
            <p class="page-subtitle">
                Have a question or feedback? Fill out the form below and our team will get back to you soon.
            </p>
        </div>
    </div>
</div>

<div class="container">
    <div class="contact-container">
        <div class="contact-card">
            <h2 class="section-title">
                <i class="bi bi-chat-dots"></i>
                Send Us a Message
            </h2>
            <p class="section-subtitle">We'd love to hear from you. Fill out the form below and we'll respond as soon as possible.</p>

            <div class="info-box">
                <div class="info-box-title">
                    <i class="bi bi-info-circle"></i>
                    Need Help?
                </div>
                <p class="info-box-text">
                    Whether you're a volunteer looking to get involved, an organisation seeking partnership, or have general inquiries, 
                    we're here to help. Your message is important to us!
                </p>
            </div>

            <?= $this->Form->create($contact, ['class' => 'contact-form']) ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->Form->label('first_name', 'First Name', ['class' => 'form-label']) ?>
                        <?= $this->Form->control('first_name', [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Enter your first name',
                            'required' => true
                        ]) ?>
                        <?php if (isset($contact->getErrors()['first_name'])): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= h($contact->getErrors()['first_name'][0]) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->Form->label('last_name', 'Last Name', ['class' => 'form-label']) ?>
                        <?= $this->Form->control('last_name', [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Enter your last name',
                            'required' => true
                        ]) ?>
                        <?php if (isset($contact->getErrors()['last_name'])): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= h($contact->getErrors()['last_name'][0]) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->Form->label('email', 'Email Address', ['class' => 'form-label']) ?>
                        <?= $this->Form->control('email', [
                            'class' => 'form-control',
                            'label' => false,
                            'type' => 'email',
                            'placeholder' => 'your.email@example.com',
                            'required' => true
                        ]) ?>
                        <?php if (isset($contact->getErrors()['email'])): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= h($contact->getErrors()['email'][0]) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->Form->label('phone', 'Phone Number', ['class' => 'form-label']) ?>
                        <?= $this->Form->control('phone', [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Enter your phone number (optional)'
                        ]) ?>
                        <?php if (isset($contact->getErrors()['phone'])): ?>
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= h($contact->getErrors()['phone'][0]) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('message', 'Message', ['class' => 'form-label']) ?>
                <?= $this->Form->control('message', [
                    'class' => 'form-control',
                    'label' => false,
                    'type' => 'textarea',
                    'rows' => 5,
                    'placeholder' => 'Tell us how we can help you...',
                    'required' => true
                ]) ?>
                <?php if (isset($contact->getErrors()['message'])): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= h($contact->getErrors()['message'][0]) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-send"></i> Send Message
                </button>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
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
        --m3-shadow: rgba(0, 0, 0, 0.1);
    }

    body.login-page {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin: 0;
        padding: 0;
    }

    body.login-page main {
        padding: 0 !important;
        margin: 0;
        min-height: 100vh;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        background: transparent;
    }

    .login-card {
        background: var(--m3-surface);
        border-radius: 28px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 3rem;
        max-width: 420px;
        width: 100%;
        animation: slideUp 0.4s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .login-logo {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 4px 12px rgba(103, 80, 164, 0.3);
    }

    .login-logo i {
        font-size: 32px;
        color: white;
    }

    .login-title {
        font-size: 2rem;
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    .login-subtitle {
        color: var(--m3-outline);
        font-size: 0.95rem;
    }

    .form-floating {
        margin-bottom: 1.5rem;
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
        box-shadow: 0 0 0 3px rgba(103, 80, 164, 0.1);
        background: var(--m3-surface);
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: var(--m3-primary);
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .input-wrapper {
        position: relative;
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

    .form-floating:has(.form-control:focus) ~ .input-icon,
    .input-wrapper:has(.form-control:focus) .input-icon {
        color: var(--m3-primary);
    }

    .form-floating:has(.form-control:not(:placeholder-shown)) ~ .input-icon,
    .input-wrapper:has(.form-control:not(:placeholder-shown)) .input-icon {
        color: var(--m3-primary);
    }

    .btn-login {
        width: 100%;
        height: 56px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        border: none;
        color: var(--m3-on-primary);
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(103, 80, 164, 0.3);
        margin-top: 1rem;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(103, 80, 164, 0.4);
        background: linear-gradient(135deg, #7B5FC7 0%, #8555B5 100%);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 2rem 0;
        color: var(--m3-outline);
        font-size: 0.875rem;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid var(--m3-surface-variant);
    }

    .divider::before {
        margin-right: 1rem;
    }

    .divider::after {
        margin-left: 1rem;
    }

    .alert,
    .message {
        border-radius: 16px;
        border: none;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message.error,
    .alert-danger {
        background: #FEE2E2;
        color: #991B1B;
        border-left: 4px solid #DC2626;
    }

    .message.success,
    .alert-success {
        background: #D1FAE5;
        color: #065F46;
        border-left: 4px solid #10B981;
    }

    .message.warning,
    .alert-warning {
        background: #FEF3C7;
        color: #92400E;
        border-left: 4px solid #F59E0B;
    }

    .message.info,
    .alert-info {
        background: #DBEAFE;
        color: #1E40AF;
        border-left: 4px solid #3B82F6;
    }

    @media (max-width: 576px) {
        .login-card {
            padding: 2rem 1.5rem;
            border-radius: 24px;
        }

        .login-title {
            font-size: 1.75rem;
        }
    }
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="login-logo">
                <i class="bi bi-people-fill"></i>
            </div>
            <h1 class="login-title">Welcome Back</h1>
            <p class="login-subtitle">Sign in to CommunityLink</p>
        </div>

        <?= $this->Flash->render() ?>

        <?= $this->Form->create(null, [
            'class' => 'login-form',
            'novalidate' => true
        ]) ?>

        <div class="input-wrapper">
            <i class="bi bi-person-fill input-icon"></i>
            <div class="form-floating">
                <?= $this->Form->text('username', [
                    'required' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Username',
                    'id' => 'username',
                    'autocomplete' => 'username'
                ]) ?>
                <?= $this->Form->label('username', 'Username', ['for' => 'username']) ?>
            </div>
        </div>

        <div class="input-wrapper">
            <i class="bi bi-lock-fill input-icon"></i>
            <div class="form-floating">
                <?= $this->Form->password('password', [
                    'required' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Password',
                    'id' => 'password',
                    'autocomplete' => 'current-password'
                ]) ?>
                <?= $this->Form->label('password', 'Password', ['for' => 'password']) ?>
            </div>
        </div>

        <?= $this->Form->button(__('Sign In'), [
            'class' => 'btn btn-login',
            'type' => 'submit'
        ]) ?>

        <?= $this->Form->end() ?>
    </div>
</div>

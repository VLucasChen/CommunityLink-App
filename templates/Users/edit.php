<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var string[]|\Cake\Collection\CollectionInterface $volunteers
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
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .form-floating > .form-control:focus ~ .input-icon,
    .form-floating > .form-select:focus ~ .input-icon {
        color: var(--m3-primary);
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

    .password-hint {
        font-size: 0.85rem;
        color: var(--m3-outline);
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        margin-left: 0.5rem;
    }

    .role-badge.admin {
        background: #FEE2E2;
        color: #991B1B;
    }

    .role-badge.assistant {
        background: #DBEAFE;
        color: #1E40AF;
    }

    .role-badge.volunteer {
        background: #D1FAE5;
        color: #065F46;
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
            Edit User
        </h1>
        <p class="page-subtitle">Update user information and permissions</p>
    </div>
</div>

<div class="container">
    <?= $this->Form->create($user, ['class' => 'user-form']) ?>
    
    <div class="form-card">
        <!-- User Information -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-person"></i>
                User Information
            </h3>
            
            <div class="input-wrapper">
                <i class="bi bi-person-fill input-icon"></i>
                <div class="form-floating">
                    <?= $this->Form->text('username', [
                        'required' => true,
                        'class' => 'form-control',
                        'placeholder' => 'Username',
                        'id' => 'username'
                    ]) ?>
                    <?= $this->Form->label('username', 'Username', ['for' => 'username']) ?>
                </div>
                <?php if ($this->Form->isFieldError('username')): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= $this->Form->error('username') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="input-wrapper">
                <i class="bi bi-lock-fill input-icon"></i>
                <div class="form-floating">
                    <?= $this->Form->password('password', [
                        'class' => 'form-control',
                        'placeholder' => 'Password',
                        'id' => 'password',
                        'value' => ''
                    ]) ?>
                    <?= $this->Form->label('password', 'Password (leave blank to keep current)', ['for' => 'password']) ?>
                </div>
                <?php if ($this->Form->isFieldError('password')): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= $this->Form->error('password') ?>
                    </div>
                <?php endif; ?>
                <div class="password-hint">
                    <i class="bi bi-info-circle"></i>
                    Leave blank if you don't want to change the password
                </div>
            </div>
        </div>

        <!-- Role & Permissions -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-shield-check"></i>
                Role & Permissions
            </h3>
            
            <div class="input-wrapper">
                <label for="role" style="display: flex; align-items: center; gap: 0.75rem; font-weight: 600; color: var(--m3-on-surface); margin-bottom: 0.75rem;">
                    <i class="bi bi-person-badge" style="color: var(--m3-primary);"></i>
                    Role
                    <?php
                    $currentRole = strtolower($user->role ?? 'volunteer');
                    ?>
                    <span class="role-badge <?= $currentRole ?>">
                        <?php if ($currentRole === 'admin'): ?>
                            <i class="bi bi-shield-check"></i>
                        <?php elseif ($currentRole === 'assistant'): ?>
                            <i class="bi bi-person-badge"></i>
                        <?php else: ?>
                            <i class="bi bi-person"></i>
                        <?php endif; ?>
                        Current: <?= h(ucfirst($user->role ?? 'Volunteer')) ?>
                    </span>
                </label>
                <?= $this->Form->select('role', [
                    'admin' => 'Admin',
                    'assistant' => 'Assistant',
                    'volunteer' => 'Volunteer'
                ], [
                    'class' => 'form-select',
                    'id' => 'role',
                    'value' => $user->role ?? 'volunteer'
                ]) ?>
                <?php if ($this->Form->isFieldError('role')): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= $this->Form->error('role') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Volunteer Association -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-people"></i>
                Volunteer Association
            </h3>
            
            <div class="input-wrapper">
                <label for="volunteer_id" style="display: flex; align-items: center; gap: 0.75rem; font-weight: 600; color: var(--m3-on-surface); margin-bottom: 0.75rem;">
                    <i class="bi bi-person-circle" style="color: var(--m3-primary);"></i>
                    Associated Volunteer
                </label>
                <?= $this->Form->select('volunteer_id', $volunteers, [
                    'empty' => '-- No Volunteer Associated --',
                    'class' => 'form-select',
                    'id' => 'volunteer_id'
                ]) ?>
                <?php if ($this->Form->isFieldError('volunteer_id')): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <?= $this->Form->error('volunteer_id') ?>
                    </div>
                <?php endif; ?>
                <div class="password-hint">
                    <i class="bi bi-info-circle"></i>
                    Link this user account to a volunteer profile (optional)
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <?= $this->Html->link(
                '<i class="bi bi-x-circle"></i> Cancel',
                ['action' => 'index'],
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
    'message' => 'The user information has been updated successfully.',
    'actionLink' => ['action' => 'index'],
    'actionText' => 'View List'
]) ?>

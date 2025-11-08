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

    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .btn-action {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-outline {
        background: white;
        color: var(--m3-primary);
        border: 2px solid var(--m3-primary);
    }

    .btn-outline:hover {
        background: var(--m3-primary-container);
        color: var(--m3-primary);
    }

    .btn-danger {
        background: #DC2626;
        color: white;
    }

    .btn-danger:hover {
        background: #991B1B;
        color: white;
        transform: translateY(-2px);
    }

    .info-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.5rem;
        border: 1px solid var(--m3-surface-variant);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--m3-surface-variant);
        flex-wrap: wrap;
    }

    .user-avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .user-info-header {
        flex: 1;
        min-width: 200px;
    }

    .user-name-large {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
    }

    .user-email-large {
        font-size: 1rem;
        color: var(--m3-outline);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
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

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .info-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--m3-outline);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 1rem;
        color: var(--m3-on-surface);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-value i {
        color: var(--m3-primary);
    }

    .empty-value {
        color: var(--m3-outline);
        font-style: italic;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }

        .page-title i {
            font-size: 1.75rem;
        }

        .action-bar {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .user-avatar-large {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .user-name-large {
            font-size: 1.5rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <i class="bi bi-person-fill"></i>
            User Details
        </h1>
        <p class="page-subtitle">View complete information about this user</p>
    </div>
</div>

<div class="container">
    <!-- Action Bar -->
    <div class="action-bar">
        <div></div>
        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
            <?= $this->Html->link(
                '<i class="bi bi-arrow-left"></i> Back to List',
                ['action' => 'index'],
                ['class' => 'btn-action btn-outline', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="bi bi-pencil"></i> Edit',
                ['action' => 'edit', $user->id],
                ['class' => 'btn-action btn-primary', 'escape' => false]
            ) ?>
            <?php 
            // Assistant cannot delete admin users
            $canDelete = true;
            if (isset($currentUserRole) && strtolower($currentUserRole) === 'assistant' && strtolower($user->role) === 'admin') {
                $canDelete = false;
            }
            ?>
            <?php if ($canDelete): ?>
                <?= $this->Form->postLink(
                    '<i class="bi bi-trash"></i> Delete',
                    ['action' => 'delete', $user->id],
                    [
                        'class' => 'btn-action btn-danger',
                        'confirm' => __('Are you sure you want to delete user "{0}"?', $user->username),
                        'escape' => false
                    ]
                ) ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Info Card -->
    <div class="info-card">
        <div class="card-header">
            <?php
            $initials = strtoupper(substr($user->username ?? '', 0, 2));
            $role = strtolower($user->role ?? 'volunteer');
            ?>
            <div class="user-avatar-large">
                <?= $initials ?: 'U' ?>
            </div>
            <div class="user-info-header">
                <div class="user-name-large">
                    <?= h($user->username) ?>
                </div>
                <div class="user-email-large">
                    <i class="bi bi-key"></i>
                    ID: <?= h($user->id) ?>
                </div>
            </div>
            <div>
                <span class="role-badge <?= $role ?>">
                    <?php if ($role === 'admin'): ?>
                        <i class="bi bi-shield-check"></i>
                    <?php elseif ($role === 'assistant'): ?>
                        <i class="bi bi-person-badge"></i>
                    <?php else: ?>
                        <i class="bi bi-person"></i>
                    <?php endif; ?>
                    <?= h(ucfirst($user->role)) ?>
                </span>
            </div>
        </div>

        <!-- Basic Information -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Username</div>
                <div class="info-value">
                    <i class="bi bi-person"></i>
                    <?= h($user->username) ?>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Role</div>
                <div class="info-value">
                    <i class="bi bi-shield-check"></i>
                    <span class="role-badge <?= $role ?>">
                        <?php if ($role === 'admin'): ?>
                            <i class="bi bi-shield-check"></i>
                        <?php elseif ($role === 'assistant'): ?>
                            <i class="bi bi-person-badge"></i>
                        <?php else: ?>
                            <i class="bi bi-person"></i>
                        <?php endif; ?>
                        <?= h(ucfirst($user->role)) ?>
                    </span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">User ID</div>
                <div class="info-value">
                    <i class="bi bi-hash"></i>
                    <?= h($user->id) ?>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Created</div>
                <div class="info-value">
                    <i class="bi bi-calendar3"></i>
                    <?= $user->created ? $user->created->format('F d, Y \a\t g:i A') : '—' ?>
                </div>
            </div>
            <?php if ($user->modified && $user->modified != $user->created): ?>
                <div class="info-item">
                    <div class="info-label">Last Modified</div>
                    <div class="info-value">
                        <i class="bi bi-clock-history"></i>
                        <?= $user->modified->format('F d, Y \a\t g:i A') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Volunteer Association -->
        <?php if ($user->has('volunteer') && $user->volunteer): ?>
            <div class="info-grid" style="margin-top: 1rem; padding-top: 1.5rem; border-top: 2px solid var(--m3-surface-variant);">
                <div class="info-item">
                    <div class="info-label">Associated Volunteer</div>
                    <div class="info-value">
                        <i class="bi bi-person-circle"></i>
                        <?= $this->Html->link(
                            $user->volunteer->first_name . ' ' . $user->volunteer->last_name,
                            ['controller' => 'Volunteers', 'action' => 'view', $user->volunteer->id],
                            ['style' => 'color: var(--m3-primary); text-decoration: none; font-weight: 600;']
                        ) ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Volunteer Email</div>
                    <div class="info-value">
                        <i class="bi bi-envelope"></i>
                        <?= h($user->volunteer->email ?? '—') ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div style="margin-top: 1rem; padding-top: 1.5rem; border-top: 2px solid var(--m3-surface-variant);">
                <div class="info-item">
                    <div class="info-label">Associated Volunteer</div>
                    <div class="empty-value">
                        <i class="bi bi-dash-circle"></i>
                        No volunteer associated with this user
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

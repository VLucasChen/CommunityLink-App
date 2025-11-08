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

    .info-card {
        background: white;
        border-radius: 24px;
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
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 40px;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .user-info-header {
        flex: 1;
        min-width: 200px;
    }

    .user-name-large {
        font-size: 2rem;
        font-weight: 700;
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
    }

    .user-email-large {
        font-size: 1.1rem;
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
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        color: white;
    }

    .role-badge.assistant {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        color: white;
    }

    .role-badge.volunteer {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
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
            font-size: 2rem;
        }

        .page-title i {
            font-size: 2.25rem;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .user-avatar-large {
            width: 80px;
            height: 80px;
            font-size: 32px;
        }

        .user-name-large {
            font-size: 1.5rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .action-bar {
            flex-direction: column;
        }

        .btn-back {
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
                <i class="bi bi-person-circle"></i>
                My Profile
            </h1>
            <p class="page-subtitle">View your profile information</p>
        </div>
    </div>
</div>

<div class="container">
    <!-- Action Bar -->
    <div class="action-bar">
        <?= $this->Html->link(
            '<i class="bi bi-arrow-left"></i> Back to Home',
            ['controller' => 'Public', 'action' => 'home'],
            ['class' => 'btn-back', 'escape' => false]
        ) ?>
        <?php
        // Show Edit Profile button if user is viewing their own profile
        $currentUserId = null;
        // Try Identity helper first
        if (isset($this->Identity)) {
            try {
                $currentUserId = $this->Identity->get('id');
            } catch (\Exception $e) {
                // Continue to next method
            }
        }
        // Fallback: Try request attribute
        if (!$currentUserId) {
            try {
                $identity = $this->request->getAttribute('identity');
                if ($identity) {
                    if (is_object($identity)) {
                        $currentUserId = $identity->id ?? null;
                    } elseif (is_array($identity)) {
                        $currentUserId = $identity['id'] ?? $identity['data']['id'] ?? null;
                    }
                }
            } catch (\Exception $e) {
                // Ignore
            }
        }
        if ($currentUserId && $currentUserId === $user->id):
        ?>
            <?= $this->Html->link(
                '<i class="bi bi-pencil-square"></i> Edit Profile',
                ['controller' => 'Public', 'action' => 'editProfile', $user->id],
                ['class' => 'btn-back', 'style' => 'background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%); color: white; border-color: var(--m3-primary);', 'escape' => false]
            ) ?>
        <?php endif; ?>
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
                    <i class="bi bi-shield-check"></i>
                    <?= h(ucfirst($user->role)) ?> Account
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
                <div class="info-label">Member Since</div>
                <div class="info-value">
                    <i class="bi bi-calendar3"></i>
                    <?= $user->created ? $user->created->format('F d, Y') : '—' ?>
                </div>
            </div>
        </div>

        <!-- Volunteer Association -->
        <?php if ($user->has('volunteer') && $user->volunteer): ?>
            <div class="info-grid" style="margin-top: 1rem; padding-top: 1.5rem; border-top: 2px solid var(--m3-surface-variant);">
                <div class="info-item">
                    <div class="info-label">Associated Volunteer</div>
                    <div class="info-value">
                        <i class="bi bi-person-circle"></i>
                        <span style="color: var(--m3-on-surface); font-weight: 600;">
                            <?= h($user->volunteer->first_name . ' ' . $user->volunteer->last_name) ?>
                        </span>
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


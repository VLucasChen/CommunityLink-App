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
    }

    .user-avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
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

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .status-badge.pending {
        background: #FEF3C7;
        color: #92400E;
    }

    .status-badge.approved {
        background: #D1FAE5;
        color: #065F46;
    }

    .status-badge.rejected {
        background: #FEE2E2;
        color: #991B1B;
    }

    .status-badge.default {
        background: var(--m3-surface-variant);
        color: var(--m3-on-surface);
    }

    .content-section {
        margin-top: 1.5rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--m3-on-surface);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--m3-primary);
        font-size: 1.5rem;
    }

    .section-content {
        background: var(--m3-surface-variant);
        padding: 1.5rem;
        border-radius: 16px;
        color: var(--m3-on-surface);
        line-height: 1.6;
        white-space: pre-wrap;
    }

    .file-display {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--m3-primary-container);
        border-radius: 12px;
        margin-top: 0.5rem;
    }

    .file-display i {
        font-size: 2rem;
        color: var(--m3-primary);
    }

    .file-info {
        flex: 1;
    }

    .file-name {
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 0.25rem;
    }

    .file-link {
        color: var(--m3-primary);
        text-decoration: none;
        font-size: 0.875rem;
    }

    .file-link:hover {
        text-decoration: underline;
    }

    .empty-content {
        color: var(--m3-outline);
        font-style: italic;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .action-bar {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <i class="bi bi-person-circle"></i>
            Volunteer Signup Details
        </h1>
        <p class="page-subtitle">View complete information about this volunteer registration</p>
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
                ['action' => 'edit', $volunteerSignup->id],
                ['class' => 'btn-action btn-primary', 'escape' => false]
            ) ?>
            <?= $this->Form->postLink(
                '<i class="bi bi-trash"></i> Delete',
                ['action' => 'delete', $volunteerSignup->id],
                [
                    'class' => 'btn-action btn-danger',
                    'confirm' => __('Are you sure you want to delete signup for {0}?', $volunteerSignup->first_name . ' ' . $volunteerSignup->last_name),
                    'escape' => false
                ]
            ) ?>
        </div>
    </div>

    <!-- Main Info Card -->
    <div class="info-card">
        <div class="card-header">
            <?php
            $initials = strtoupper(substr($volunteerSignup->first_name ?? '', 0, 1) . substr($volunteerSignup->last_name ?? '', 0, 1));
            $status = strtolower($volunteerSignup->status ?? 'pending');
            $statusClass = $status === 'approved' ? 'approved' : ($status === 'rejected' ? 'rejected' : 'pending');
            ?>
            <div class="user-avatar-large">
                <?= $initials ?: '?' ?>
            </div>
            <div class="user-info-header">
                <div class="user-name-large">
                    <?= h($volunteerSignup->first_name . ' ' . $volunteerSignup->last_name) ?>
                </div>
                <div class="user-email-large">
                    <i class="bi bi-envelope"></i>
                    <?= h($volunteerSignup->email) ?>
                </div>
            </div>
            <div>
                <span class="status-badge <?= $statusClass ?>">
                    <?php if ($statusClass === 'approved'): ?>
                        <i class="bi bi-check-circle"></i>
                    <?php elseif ($statusClass === 'rejected'): ?>
                        <i class="bi bi-x-circle"></i>
                    <?php else: ?>
                        <i class="bi bi-clock"></i>
                    <?php endif; ?>
                    <?= h(ucfirst($volunteerSignup->status ?? 'Pending')) ?>
                </span>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Phone</div>
                <div class="info-value">
                    <i class="bi bi-telephone"></i>
                    <?= h($volunteerSignup->phone) ?>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Submitted</div>
                <div class="info-value">
                    <i class="bi bi-calendar3"></i>
                    <?= $volunteerSignup->created ? $volunteerSignup->created->format('F d, Y \a\t g:i A') : '-' ?>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Last Modified</div>
                <div class="info-value">
                    <i class="bi bi-clock-history"></i>
                    <?= $volunteerSignup->modified ? $volunteerSignup->modified->format('F d, Y \a\t g:i A') : '-' ?>
                </div>
            </div>
        </div>

        <!-- Profile Picture -->
        <?php if ($volunteerSignup->profile_picture): ?>
            <div class="info-item" style="margin-top: 1rem;">
                <div class="info-label">Profile Picture</div>
                <div class="file-display">
                    <i class="bi bi-image"></i>
                    <div class="file-info">
                        <div class="file-name">Profile Picture</div>
                        <?= $this->Html->link(
                            'View/Download',
                            '/files/volunteer_signups/profile_picture/' . h($volunteerSignup->profile_picture),
                            ['class' => 'file-link', 'target' => '_blank']
                        ) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Documents -->
        <?php if ($volunteerSignup->documents): ?>
            <div class="info-item" style="margin-top: 1rem;">
                <div class="info-label">Documents</div>
                <div class="file-display">
                    <i class="bi bi-file-earmark-text"></i>
                    <div class="file-info">
                        <div class="file-name">Attached Documents</div>
                        <?= $this->Html->link(
                            'View/Download',
                            '/files/volunteer_signups/documents/' . h($volunteerSignup->documents),
                            ['class' => 'file-link', 'target' => '_blank']
                        ) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Skills Section -->
    <?php if ($volunteerSignup->skills): ?>
        <div class="info-card">
            <div class="content-section">
                <h3 class="section-title">
                    <i class="bi bi-tools"></i>
                    Skills & Expertise
                </h3>
                <div class="section-content">
                    <?= $this->Text->autoParagraph(h($volunteerSignup->skills)); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Interests Section -->
    <?php if ($volunteerSignup->interests): ?>
        <div class="info-card">
            <div class="content-section">
                <h3 class="section-title">
                    <i class="bi bi-heart"></i>
                    Interests
                </h3>
                <div class="section-content">
                    <?= $this->Text->autoParagraph(h($volunteerSignup->interests)); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Message Section -->
    <?php if ($volunteerSignup->message): ?>
        <div class="info-card">
            <div class="content-section">
                <h3 class="section-title">
                    <i class="bi bi-chat-left-text"></i>
                    Message
                </h3>
                <div class="section-content">
                    <?= $this->Text->autoParagraph(h($volunteerSignup->message)); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

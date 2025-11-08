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

    .org-icon-large {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        flex-shrink: 0;
    }

    .org-info-header {
        flex: 1;
    }

    .org-name-large {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
    }

    .org-industry-large {
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

    .industry-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.875rem;
        background: #D1FAE5;
        color: #065F46;
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
            <i class="bi bi-building"></i>
            Organisation Details
        </h1>
        <p class="page-subtitle">View complete information about this organisation</p>
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
                ['action' => 'edit', $organisation->id],
                ['class' => 'btn-action btn-primary', 'escape' => false]
            ) ?>
            <?= $this->Form->postLink(
                '<i class="bi bi-trash"></i> Delete',
                ['action' => 'delete', $organisation->id],
                [
                    'class' => 'btn-action btn-danger',
                    'confirm' => __('Are you sure you want to delete "{0}"?', $organisation->org_name),
                    'escape' => false
                ]
            ) ?>
        </div>
    </div>

    <!-- Main Info Card -->
    <div class="info-card">
        <div class="card-header">
            <div class="org-icon-large">
                <i class="bi bi-building"></i>
            </div>
            <div class="org-info-header">
                <div class="org-name-large">
                    <?= h($organisation->org_name) ?>
                </div>
                <div class="org-industry-large">
                    <span class="industry-badge">
                        <i class="bi bi-briefcase"></i>
                        <?= h($organisation->industry) ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value">
                    <i class="bi bi-envelope"></i>
                    <?= h($organisation->email) ?>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Phone</div>
                <div class="info-value">
                    <i class="bi bi-telephone"></i>
                    <?= h($organisation->phone) ?>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Contact Person</div>
                <div class="info-value">
                    <i class="bi bi-person-lines-fill"></i>
                    <?= h($organisation->contact_person_full_name) ?>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Created</div>
                <div class="info-value">
                    <i class="bi bi-clock-history"></i>
                    <?= $organisation->created ? $organisation->created->format('F d, Y \a\t g:i A') : '-' ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Business Address -->
    <?php if ($organisation->business_address): ?>
        <div class="info-card">
            <div class="content-section">
                <h3 class="section-title">
                    <i class="bi bi-geo-alt"></i>
                    Business Address
                </h3>
                <div class="section-content">
                    <?= $this->Text->autoParagraph(h($organisation->business_address)); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Help Description -->
    <?php if ($organisation->help_description): ?>
        <div class="info-card">
            <div class="content-section">
                <h3 class="section-title">
                    <i class="bi bi-info-circle"></i>
                    Help Description
                </h3>
                <div class="section-content">
                    <?= $this->Text->autoParagraph(h($organisation->help_description)); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Related Events -->
    <?php if (!empty($organisation->events)): ?>
        <div class="info-card">
            <div class="content-section">
                <h3 class="section-title">
                    <i class="bi bi-calendar-event"></i>
                    Related Events
                </h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($organisation->events as $event): ?>
                                <tr>
                                    <td><?= h($event->title) ?></td>
                                    <td><?= h($event->location) ?></td>
                                    <td><?= $event->event_date ? $event->event_date->format('M d, Y') : '-' ?></td>
                                    <td>
                                        <?php
                                            $badgeConfig = match (strtolower(str_replace(' ', '-', $event->status ?? ''))) {
                                                'preparing' => ['class' => 'warning', 'icon' => 'bi-tools'],
                                                'ready-to-go' => ['class' => 'success', 'icon' => 'bi-check-circle'],
                                                'archive' => ['class' => 'secondary', 'icon' => 'bi-archive'],
                                                'failed' => ['class' => 'danger', 'icon' => 'bi-x-circle'],
                                                default => ['class' => 'light', 'icon' => 'bi-circle']
                                            };
                                        ?>
                                        <span class="badge bg-<?= $badgeConfig['class'] ?>">
                                            <i class="bi <?= $badgeConfig['icon'] ?>"></i>
                                            <?= h($event->status) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?= $this->Html->link(
                                            '<i class="bi bi-eye"></i>',
                                            ['controller' => 'Events', 'action' => 'view', $event->id],
                                            ['class' => 'btn btn-sm btn-outline-info', 'title' => 'View', 'escape' => false]
                                        ) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

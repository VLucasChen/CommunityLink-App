<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
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

    .event-icon-large {
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

    .event-info-header {
        flex: 1;
    }

    .event-title-large {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
    }

    .event-host-large {
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

    .status-badge.preparing {
        background: #FEF3C7;
        color: #92400E;
    }

    .status-badge.ready {
        background: #D1FAE5;
        color: #065F46;
    }

    .status-badge.archive {
        background: var(--m3-surface-variant);
        color: var(--m3-on-surface);
    }

    .status-badge.failed {
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
            <i class="bi bi-calendar-event-fill"></i>
            Event Details
        </h1>
        <p class="page-subtitle">View complete information about this event</p>
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
                ['action' => 'edit', $event->id],
                ['class' => 'btn-action btn-primary', 'escape' => false]
            ) ?>
            <?= $this->Form->postLink(
                '<i class="bi bi-trash"></i> Delete',
                ['action' => 'delete', $event->id],
                [
                    'class' => 'btn-action btn-danger',
                    'confirm' => __('Are you sure you want to delete "{0}"?', $event->title),
                    'escape' => false
                ]
            ) ?>
        </div>
    </div>

    <!-- Main Info Card -->
    <div class="info-card">
        <div class="card-header">
            <div class="event-icon-large">
                <i class="bi bi-calendar-event"></i>
            </div>
            <div class="event-info-header">
                <div class="event-title-large">
                    <?= h($event->title) ?>
                </div>
                <?php if ($event->host): ?>
                    <div class="event-host-large">
                        <i class="bi bi-person"></i>
                        Hosted by <?= h($event->host) ?>
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <?php
                    $status = strtolower(str_replace(' ', '-', $event->status ?? ''));
                    $statusClass = match($status) {
                        'preparing' => 'preparing',
                        'ready-to-go' => 'ready',
                        'archive' => 'archive',
                        'failed' => 'failed',
                        default => 'default'
                    };
                ?>
                <span class="status-badge <?= $statusClass ?>">
                    <?php if ($statusClass === 'preparing'): ?>
                        <i class="bi bi-tools"></i>
                    <?php elseif ($statusClass === 'ready'): ?>
                        <i class="bi bi-check-circle"></i>
                    <?php elseif ($statusClass === 'archive'): ?>
                        <i class="bi bi-archive"></i>
                    <?php elseif ($statusClass === 'failed'): ?>
                        <i class="bi bi-x-circle"></i>
                    <?php else: ?>
                        <i class="bi bi-circle"></i>
                    <?php endif; ?>
                    <?= h($event->status) ?>
                </span>
            </div>
        </div>

        <!-- Basic Information -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Location</div>
                <div class="info-value">
                    <i class="bi bi-geo-alt"></i>
                    <?= h($event->location) ?>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Event Date</div>
                <div class="info-value">
                    <i class="bi bi-calendar3"></i>
                    <?= $event->event_date ? $event->event_date->format('F d, Y') : '—' ?>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Expected Attendees</div>
                <div class="info-value">
                    <i class="bi bi-people"></i>
                    <?= h($event->event_size) ?> people
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Crews Needed</div>
                <div class="info-value">
                    <i class="bi bi-person-badge"></i>
                    <?= h($event->number_of_required_crews) ?> crews
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Organisation</div>
                <div class="info-value">
                    <i class="bi bi-building"></i>
                    <?= $event->organisation ? h($event->organisation->org_name) : '—' ?>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Created</div>
                <div class="info-value">
                    <i class="bi bi-clock-history"></i>
                    <?= $event->created ? $event->created->format('F d, Y \a\t g:i A') : '—' ?>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <?php if ($event->contact_person_full_name || $event->contact_person_email): ?>
            <div class="info-grid" style="margin-top: 1rem; padding-top: 1.5rem; border-top: 2px solid var(--m3-surface-variant);">
                <div class="info-item">
                    <div class="info-label">Contact Person</div>
                    <div class="info-value">
                        <i class="bi bi-person-lines-fill"></i>
                        <?= h($event->contact_person_full_name) ?: '—' ?>
                    </div>
                </div>
                <?php if ($event->contact_person_email): ?>
                    <div class="info-item">
                        <div class="info-label">Contact Email</div>
                        <div class="info-value">
                            <i class="bi bi-envelope"></i>
                            <a href="mailto:<?= h($event->contact_person_email) ?>" style="color: var(--m3-primary); text-decoration: none;">
                                <?= h($event->contact_person_email) ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Description Section -->
    <?php if ($event->event_description): ?>
        <div class="info-card">
            <div class="content-section">
                <h3 class="section-title">
                    <i class="bi bi-file-text"></i>
                    Event Description
                </h3>
                <div class="section-content">
                    <?= $this->Text->autoParagraph(h($event->event_description)); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Requirements Section -->
    <?php if ($event->required_equipment || $event->required_skills): ?>
        <div class="info-card">
            <div class="content-section">
                <h3 class="section-title">
                    <i class="bi bi-list-check"></i>
                    Requirements
                </h3>
                <?php if ($event->required_equipment): ?>
                    <div style="margin-bottom: 1.5rem;">
                        <div class="info-label" style="margin-bottom: 0.5rem;">Required Equipment</div>
                        <div class="section-content">
                            <?= $this->Text->autoParagraph(h($event->required_equipment)); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($event->required_skills): ?>
                    <div>
                        <div class="info-label" style="margin-bottom: 0.5rem;">Required Skills</div>
                        <div class="section-content">
                            <?= $this->Text->autoParagraph(h($event->required_skills)); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

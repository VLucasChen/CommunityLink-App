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
        min-width: 200px;
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
    }

    @media (max-width: 768px) {
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

        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .event-icon-large {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .event-title-large {
            font-size: 1.5rem;
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
                <i class="bi bi-calendar-event-fill"></i>
                Event Details
            </h1>
            <p class="page-subtitle">View complete information about this event</p>
        </div>
    </div>
</div>

<div class="container">
    <!-- Action Bar -->
    <div class="action-bar">
        <?= $this->Html->link(
            '<i class="bi bi-arrow-left"></i> Back to Events',
            ['controller' => 'Public', 'action' => 'publicEvents'],
            ['class' => 'btn-back', 'escape' => false]
        ) ?>
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
                    $status = $event->status ?? '';
                    $statusLower = strtolower($status);
                    $statusClass = match($statusLower) {
                        'preparing' => 'preparing',
                        'ready to go' => 'ready',
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
                    <?= h($status) ?>
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
                            <?= h($event->contact_person_email) ?>
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


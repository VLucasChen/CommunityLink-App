<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Event> $events
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
        --m3-secondary: #625B71;
        --m3-tertiary: #7D5260;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 4rem 0 3rem;
        color: white;
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
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        letter-spacing: -1px;
    }

    .page-subtitle {
        font-size: 1.25rem;
        opacity: 0.95;
    }

    /* Events Section */
    .events-section {
        padding: 4rem 0;
        background: var(--m3-surface);
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--m3-on-surface);
        margin-bottom: 1rem;
        text-align: center;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: var(--m3-outline);
        text-align: center;
        margin-bottom: 3rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .event-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid var(--m3-surface-variant);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        height: 100%;
        display: flex;
        flex-direction: column;
        margin-bottom: 2rem;
    }

    .event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.15);
    }

    .event-header {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        padding: 1.5rem;
        color: white;
    }

    .event-date {
        font-size: 0.875rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .event-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    .event-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .event-org {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--m3-outline);
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    .event-location {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--m3-outline);
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    .event-description {
        color: var(--m3-on-surface);
        line-height: 1.6;
        flex-grow: 1;
        margin-bottom: 1rem;
    }

    .event-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--m3-surface-variant);
    }

    .event-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--m3-outline);
    }

    .event-meta-item i {
        color: var(--m3-primary);
    }

    .event-link {
        color: var(--m3-primary);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        margin-top: auto;
    }

    .event-link:hover {
        gap: 0.75rem;
        color: #764ba2;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--m3-outline);
        opacity: 0.5;
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
        font-size: 1.5rem;
    }

    .empty-state p {
        color: var(--m3-outline);
        margin-bottom: 1.5rem;
        font-size: 1rem;
    }

    .btn-back {
        padding: 0.875rem 2rem;
        border-radius: 16px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--m3-primary-container);
        color: var(--m3-primary);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back:hover {
        background: var(--m3-primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .page-subtitle {
            font-size: 1.1rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .event-card {
            margin-bottom: 2rem;
        }
    }
</style>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="page-header-content text-center">
            <h1 class="page-title">
                <i class="bi bi-calendar-event-fill"></i>
                Public Events
            </h1>
            <p class="page-subtitle">
                Discover exciting volunteer opportunities happening in your community
            </p>
        </div>
    </div>
</section>

<!-- Events Section -->
<section class="events-section">
    <div class="container">
        <h2 class="section-title">All Upcoming Events</h2>
        <p class="section-subtitle">
            Browse through all available events and find opportunities that match your interests and skills.
        </p>
        
        <?php if (!empty($events) && count($events) > 0): ?>
            <div class="row g-4">
                <?php foreach ($events as $event): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="event-card">
                            <div class="event-header">
                                <div class="event-date">
                                    <i class="bi bi-calendar3"></i>
                                    <?= $event->event_date ? $event->event_date->format('d M Y') : 'Date TBA' ?>
                                </div>
                                <h3 class="event-title"><?= h($event->title) ?></h3>
                            </div>
                            <div class="event-body">
                                <?php if ($event->organisation): ?>
                                    <div class="event-org">
                                        <i class="bi bi-building"></i>
                                        <span><?= h($event->organisation->org_name) ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($event->location): ?>
                                    <div class="event-location">
                                        <i class="bi bi-geo-alt"></i>
                                        <span><?= h($event->location) ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($event->event_description): ?>
                                    <p class="event-description">
                                        <?= $this->Text->truncate($event->event_description, 150) ?>
                                    </p>
                                <?php endif; ?>
                                
                                <div class="event-meta">
                                    <?php if ($event->host): ?>
                                        <div class="event-meta-item">
                                            <i class="bi bi-person"></i>
                                            <span><?= h($event->host) ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($event->status): ?>
                                        <div class="event-meta-item">
                                            <i class="bi bi-info-circle"></i>
                                            <span><?= h($event->status) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <?= $this->Html->link(
                                    'View Details <i class="bi bi-arrow-right"></i>',
                                    ['controller' => 'Public', 'action' => 'viewEvent', $event->id],
                                    ['class' => 'event-link', 'escape' => false]
                                ) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-5">
                <?= $this->Html->link(
                    '<i class="bi bi-arrow-left me-2"></i>Back to Home',
                    ['controller' => 'Public', 'action' => 'home'],
                    ['class' => 'btn-back', 'escape' => false]
                ) ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-calendar-x"></i>
                <h3>No Events Available</h3>
                <p>There are no upcoming events at the moment. Check back soon for new opportunities!</p>
                <div class="mt-4">
                    <?= $this->Html->link(
                        '<i class="bi bi-arrow-left me-2"></i>Back to Home',
                        ['controller' => 'Public', 'action' => 'home'],
                        ['class' => 'btn-back', 'escape' => false]
                    ) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>


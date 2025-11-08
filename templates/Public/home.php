<?php
/**
 * @var \App\View\AppView $this
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

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 6rem 0 4rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        letter-spacing: -1px;
        animation: fadeInUp 0.8s ease-out;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.95;
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .hero-buttons {
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn-hero {
        padding: 0.875rem 2rem;
        border-radius: 16px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        margin: 0.5rem;
    }

    .btn-hero-primary {
        background: white;
        color: var(--m3-primary);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-hero-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        background: #f8f9fa;
    }

    .btn-hero-outline {
        background: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn-hero-outline:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateY(-2px);
    }

    /* Features Section */
    .features-section {
        padding: 5rem 0;
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
        margin-bottom: 4rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .feature-card {
        background: white;
        border-radius: 24px;
        padding: 2.5rem;
        height: 100%;
        transition: all 0.3s ease;
        border: 1px solid var(--m3-surface-variant);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        border-color: var(--m3-primary);
    }

    .feature-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        font-size: 28px;
        color: white;
        box-shadow: 0 4px 12px rgba(103, 80, 164, 0.3);
    }

    .feature-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 1rem;
    }

    .feature-description {
        color: var(--m3-outline);
        line-height: 1.7;
    }

    /* Events Section */
    .events-section {
        padding: 5rem 0;
        background: linear-gradient(to bottom, #f8f9fa 0%, white 100%);
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

    .event-description {
        color: var(--m3-on-surface);
        line-height: 1.6;
        flex-grow: 1;
        margin-bottom: 1rem;
    }

    .event-link {
        color: var(--m3-primary);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .event-link:hover {
        gap: 0.75rem;
        color: #764ba2;
    }

    /* CTA Section */
    .cta-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        color: white;
        text-align: center;
    }

    .cta-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta-subtitle {
        font-size: 1.25rem;
        margin-bottom: 2.5rem;
        opacity: 0.95;
    }

    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-cta {
        padding: 1rem 2.5rem;
        border-radius: 16px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: 2px solid white;
    }

    .btn-cta-primary {
        background: white;
        color: var(--m3-primary);
    }

    .btn-cta-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        background: #f8f9fa;
    }

    .btn-cta-outline {
        background: transparent;
        color: white;
    }

    .btn-cta-outline:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    /* Stats Section */
    .stats-section {
        padding: 4rem 0;
        background: var(--m3-surface);
    }

    .stat-card {
        text-align: center;
        padding: 2rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 1.1rem;
        color: var(--m3-outline);
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .feature-card {
            margin-bottom: 2rem;
        }

        .event-card {
            margin-bottom: 2rem;
        }

        .cta-title {
            font-size: 2rem;
        }

        .btn-hero,
        .btn-cta {
            width: 100%;
            margin: 0.5rem 0;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center hero-content">
                <h1 class="hero-title">Welcome to CommunityLink</h1>
                <p class="hero-subtitle">
                    Connecting volunteers, organisations, and communities together for meaningful impact. 
                    Join us in making a difference, one event at a time.
                </p>
                <div class="hero-buttons">
                    <?= $this->Html->link(
                        '<i class="bi bi-calendar-event me-2"></i>Browse Events',
                        ['controller' => 'Public', 'action' => 'publicEvents'],
                        ['class' => 'btn btn-hero btn-hero-primary', 'escape' => false]
                    ) ?>
                    <?= $this->Html->link(
                        '<i class="bi bi-person-plus me-2"></i>Join as Volunteer',
                        ['controller' => 'Public', 'action' => 'volunteerRegister'],
                        ['class' => 'btn btn-hero btn-hero-outline', 'escape' => false]
                    ) ?>
                </div>
            </div>
        </div>
</div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <h2 class="section-title">Why Choose CommunityLink?</h2>
        <p class="section-subtitle">
            We provide a seamless platform for volunteers and organisations to connect, collaborate, and create positive change in communities.
        </p>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 class="feature-title">Connect Communities</h3>
                    <p class="feature-description">
                        Bring together volunteers, organisations, and community members in one unified platform. 
                        Find opportunities that match your passion and skills.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <h3 class="feature-title">Easy Event Management</h3>
                    <p class="feature-description">
                        Organisations can easily create and manage events, while volunteers can discover 
                        and sign up for opportunities that matter to them.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h3 class="feature-title">Make an Impact</h3>
                    <p class="feature-description">
                        Every event, every volunteer hour, and every connection contributes to building 
                        stronger, more resilient communities.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Events Section -->
<section class="events-section">
    <div class="container">
        <h2 class="section-title">Upcoming Events</h2>
        <p class="section-subtitle">
            Discover exciting volunteer opportunities happening in your community. Join us and make a difference!
        </p>
        <?php if (!empty($events) && count($events) > 0): ?>
            <div class="row g-4">
<?php foreach ($events as $event): ?>
                    <div class="col-md-4">
                        <div class="event-card">
                            <div class="event-header">
                                <div class="event-date">
                                    <i class="bi bi-calendar3"></i>
                                    <?= $event->event_date->format('d M Y') ?>
                                </div>
                                <h3 class="event-title"><?= h($event->title) ?></h3>
                            </div>
                            <div class="event-body">
                                <div class="event-org">
                                    <i class="bi bi-building"></i>
                                    <span><?= h($event->organisation->org_name ?? 'N/A') ?></span>
                                </div>
                                <p class="event-description">
                                    <?= $this->Text->truncate($event->event_description, 120) ?>
                                </p>
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
                    'View All Events <i class="bi bi-arrow-right ms-2"></i>',
                    ['controller' => 'Public', 'action' => 'publicEvents'],
                    ['class' => 'btn btn-hero btn-hero-primary', 'escape' => false]
                ) ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-calendar-x" style="font-size: 4rem; color: var(--m3-outline);"></i>
                <p class="mt-3" style="color: var(--m3-outline); font-size: 1.1rem;">
                    No upcoming events at the moment. Check back soon!
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">Ready to Get Started?</h2>
        <p class="cta-subtitle">
            Join our community today and start making a positive impact in your area.
        </p>
        <div class="cta-buttons">
            <?= $this->Html->link(
                '<i class="bi bi-person-plus me-2"></i>Become a Volunteer',
                ['controller' => 'Public', 'action' => 'volunteerRegister'],
                ['class' => 'btn btn-cta btn-cta-primary', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="bi bi-building me-2"></i>Register Your Organisation',
                ['controller' => 'Public', 'action' => 'organisationRegister'],
                ['class' => 'btn btn-cta btn-cta-outline', 'escape' => false]
            ) ?>
        </div>
    </div>
</section>

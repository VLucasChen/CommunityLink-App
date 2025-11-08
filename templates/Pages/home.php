<?php
/**
 * Main landing page for CommunityLink - A5 CakePHP version
 * Based on A3 index.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CommunityLink - Connecting Communities</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .feature-card {
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="container">
            <a class="navbar-brand" href="<?= $this->Url->build('/') ?>">
                <i class="fas fa-hands-helping me-2"></i>CommunityLink
            </a>
            <div class="navbar-nav ms-auto">
                <?= $this->Html->link('Contact Us', ['controller' => 'ContactMessages', 'action' => 'publicContact'], ['class' => 'nav-link']) ?>
                <?= $this->Html->link('Volunteer Signup', ['controller' => 'VolunteerSignups', 'action' => 'publicSignup'], ['class' => 'nav-link']) ?>
                <?= $this->Html->link('Organisation Registration', ['controller' => 'Organisations', 'action' => 'publicSignup'], ['class' => 'nav-link']) ?>
                <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Welcome to CommunityLink</h1>
            <p class="lead mb-4">Connecting communities through meaningful events and volunteer opportunities</p>
            <?= $this->Html->link('Volunteer Signup', ['controller' => 'VolunteerSignups', 'action' => 'publicSignup'], ['class' => 'btn btn-outline-light btn-lg me-3']) ?>
            <?= $this->Html->link('Organisation Registration', ['controller' => 'Organisations', 'action' => 'publicSignup'], ['class' => 'btn btn-outline-light btn-lg me-3']) ?>
            <?= $this->Html->link('Contact Us', ['controller' => 'ContactMessages', 'action' => 'publicContact'], ['class' => 'btn btn-outline-light btn-lg me-3']) ?>
            <?= $this->Html->link('Admin Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'btn btn-outline-light btn-lg']) ?>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">What We Do</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Community Events</h5>
                            <p class="card-text">We organize and support various community events including markets, workshops, festivals, and more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Volunteer Management</h5>
                            <p class="card-text">We connect passionate volunteers with meaningful opportunities to serve their community.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-handshake fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Partner Organizations</h5>
                            <p class="card-text">We work with local organizations to create impactful community programs and events.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2>About CommunityLink</h2>
                    <p class="lead">We are a not-for-profit group dedicated to supporting local community events and fostering meaningful connections.</p>
                    <p>Our mission is to simplify event planning, volunteer recruitment, and partner organization management through innovative web-based solutions.</p>
                    <?= $this->Html->link('Contact Us', ['controller' => 'ContactMessages', 'action' => 'publicContact'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5>CommunityLink</h5>
                    <p>Connecting communities through meaningful volunteer opportunities.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><?= $this->Html->link('Home', '/', ['class' => 'text-light']) ?></li>
                        <li><?= $this->Html->link('Contact Us', ['controller' => 'ContactMessages', 'action' => 'publicContact'], ['class' => 'text-light']) ?></li>
                        <li><?= $this->Html->link('Volunteer Signup', ['controller' => 'VolunteerSignups', 'action' => 'publicSignup'], ['class' => 'text-light']) ?></li>
                        <li><?= $this->Html->link('Organisation Registration', ['controller' => 'Organisations', 'action' => 'publicSignup'], ['class' => 'text-light']) ?></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Get in Touch</h5>
                    <p><i class="fas fa-envelope me-2"></i>admin@communitylink.com</p>
                    <p><i class="fas fa-phone me-2"></i>+61 400 000 000</p>
                </div>
            </div>
            <hr class="my-4">
            <p>&copy; 2025 CommunityLink. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
/**
 * Contact form page for CommunityLink - A5 CakePHP version
 * Based on A3 contact.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactMessage $contactMessage
 * @var string $message
 * @var string $error
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - CommunityLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }
        .contact-form {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px;
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
                <?= $this->Html->link('Home', '/', ['class' => 'nav-link']) ?>
                <?= $this->Html->link('Contact Us', ['controller' => 'ContactMessages', 'action' => 'publicContact'], ['class' => 'nav-link active']) ?>
                <?= $this->Html->link('Volunteer Signup', ['controller' => 'VolunteerSignups', 'action' => 'publicSignup'], ['class' => 'nav-link']) ?>
                <?= $this->Html->link('Organisation Registration', ['controller' => 'Organisations', 'action' => 'publicSignup'], ['class' => 'nav-link']) ?>
                <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Contact Us</h1>
            <p class="lead">Have a question or want to get involved? We'd love to hear from you!</p>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <h2 class="text-center mb-4">Send us a Message</h2>
                        
                        <?php if ($message): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= h($message) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?= $this->Form->create($contactMessage, ['url' => ['action' => 'publicContact']]) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?= $this->Form->label('first_name', 'First Name *', ['class' => 'form-label']) ?>
                                        <?= $this->Form->text('first_name', [
                                            'class' => 'form-control',
                                            'maxlength' => '50',
                                            'required' => true,
                                            'value' => $contactMessage->first_name ?? ''
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?= $this->Form->label('last_name', 'Last Name *', ['class' => 'form-label']) ?>
                                        <?= $this->Form->text('last_name', [
                                            'class' => 'form-control',
                                            'maxlength' => '50',
                                            'required' => true,
                                            'value' => $contactMessage->last_name ?? ''
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <?= $this->Form->label('phone', 'Phone Number *', ['class' => 'form-label']) ?>
                                <?= $this->Form->tel('phone', [
                                    'class' => 'form-control',
                                    'pattern' => '[0-9\s\-\+\(\)]+',
                                    'title' => 'Please enter a valid phone number (numbers, spaces, hyphens, parentheses, and plus signs only)',
                                    'maxlength' => '20',
                                    'required' => true,
                                    'value' => $contactMessage->phone ?? ''
                                ]) ?>
                            </div>
                            
                            <div class="mb-3">
                                <?= $this->Form->label('email', 'Email Address *', ['class' => 'form-label']) ?>
                                <?= $this->Form->email('email', [
                                    'class' => 'form-control',
                                    'maxlength' => '100',
                                    'required' => true,
                                    'value' => $contactMessage->email ?? ''
                                ]) ?>
                            </div>
                            
                            <div class="mb-3">
                                <?= $this->Form->label('message', 'Message *', ['class' => 'form-label']) ?>
                                <?= $this->Form->textarea('message', [
                                    'class' => 'form-control',
                                    'rows' => '5',
                                    'placeholder' => 'Tell us about your inquiry, volunteer interest, or any questions you have...',
                                    'maxlength' => '1000',
                                    'required' => true,
                                    'value' => $contactMessage->message ?? ''
                                ]) ?>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="row mt-5">
                <div class="col-md-4 text-center">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                            <h5>Email Us</h5>
                            <p class="card-text">admin@communitylink.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-map-marker-alt fa-3x text-success mb-3"></i>
                            <h5>Visit Us</h5>
                            <p class="card-text">Local Community Center<br>Central Park Area</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-clock fa-3x text-info mb-3"></i>
                            <h5>Office Hours</h5>
                            <p class="card-text">Monday - Friday<br>9:00 AM - 5:00 PM</p>
                        </div>
                    </div>
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

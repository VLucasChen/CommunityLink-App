<?php
/**
 * Volunteer signup page for CommunityLink - A5 CakePHP version
 * Based on A3 volunteer-signup.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VolunteerSignup $volunteerSignup
 * @var string $message
 * @var string $error
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Signup - CommunityLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }
        .signup-form {
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
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #667eea;
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
                <?= $this->Html->link('Contact Us', ['controller' => 'ContactMessages', 'action' => 'publicContact'], ['class' => 'nav-link']) ?>
                <?= $this->Html->link('Volunteer Signup', ['controller' => 'VolunteerSignups', 'action' => 'publicSignup'], ['class' => 'nav-link active']) ?>
                <?= $this->Html->link('Organisation Registration', ['controller' => 'Organisations', 'action' => 'publicSignup'], ['class' => 'nav-link']) ?>
                <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Join Our Volunteer Team</h1>
            <p class="lead mb-4">Make a difference in your community by volunteering with CommunityLink</p>
            <div class="row">
                <div class="col-md-4">
                    <i class="fas fa-heart feature-icon"></i>
                    <h5>Community Impact</h5>
                    <p>Help create positive change in your local community</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-users feature-icon"></i>
                    <h5>Build Connections</h5>
                    <p>Meet like-minded people and build lasting friendships</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-star feature-icon"></i>
                    <h5>Personal Growth</h5>
                    <p>Develop new skills and gain valuable experience</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Volunteer Signup Form -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="signup-form">
                        <h2 class="text-center mb-4">Volunteer Application Form</h2>
                        
                        <?php if ($message): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i><?= h($message) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i><?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?= $this->Form->create($volunteerSignup, ['type' => 'file', 'url' => ['action' => 'publicSignup']]) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?= $this->Form->label('first_name', 'First Name *', ['class' => 'form-label']) ?>
                                        <?= $this->Form->text('first_name', [
                                            'class' => 'form-control',
                                            'maxlength' => '50',
                                            'required' => true,
                                            'value' => $volunteerSignup->first_name ?? ''
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
                                            'value' => $volunteerSignup->last_name ?? ''
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?= $this->Form->label('email', 'Email Address *', ['class' => 'form-label']) ?>
                                        <?= $this->Form->email('email', [
                                            'class' => 'form-control',
                                            'maxlength' => '100',
                                            'required' => true,
                                            'value' => $volunteerSignup->email ?? '',
                                            'placeholder' => 'your.email@example.com'
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?= $this->Form->label('phone', 'Phone Number *', ['class' => 'form-label']) ?>
                                        <?= $this->Form->tel('phone', [
                                            'class' => 'form-control',
                                            'pattern' => '[0-9\s\-\+\(\)]+',
                                            'title' => 'Please enter a valid phone number (numbers, spaces, hyphens, parentheses, and plus signs only)',
                                            'maxlength' => '20',
                                            'required' => true,
                                            'value' => $volunteerSignup->phone ?? '',
                                            'placeholder' => '04XX XXX XXX'
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <?= $this->Form->label('skills', 'Skills *', ['class' => 'form-label']) ?>
                                <?= $this->Form->textarea('skills', [
                                    'class' => 'form-control',
                                    'rows' => '3',
                                    'maxlength' => '500',
                                    'required' => true,
                                    'value' => $volunteerSignup->skills ?? '',
                                    'placeholder' => 'Please list your skills and experience'
                                ]) ?>
                            </div>
                            
                            <div class="mb-3">
                                <?= $this->Form->label('availability', 'Availability *', ['class' => 'form-label']) ?>
                                <?= $this->Form->textarea('availability', [
                                    'class' => 'form-control',
                                    'rows' => '2',
                                    'maxlength' => '500',
                                    'required' => true,
                                    'value' => $volunteerSignup->availability ?? '',
                                    'placeholder' => 'e.g., Weekends, Weekdays, Evenings, Flexible'
                                ]) ?>
                                <small class="form-text text-muted">Please indicate when you are available to volunteer</small>
                            </div>
                            
                            <div class="mb-3">
                                <?= $this->Form->label('self_intro', 'Self-intro *', ['class' => 'form-label']) ?>
                                <?= $this->Form->textarea('self_intro', [
                                    'class' => 'form-control',
                                    'rows' => '4',
                                    'maxlength' => '1000',
                                    'required' => true,
                                    'value' => $volunteerSignup->self_intro ?? '',
                                    'placeholder' => 'Please briefly tell Amy why you are interested in working with CommunityLink'
                                ]) ?>
                            </div>

                            <div class="mb-3">
                                <?= $this->Form->label('profile_picture', 'Profile Picture *', ['class' => 'form-label']) ?>
                                <?= $this->Form->file('profile_picture', [
                                    'class' => 'form-control',
                                    'accept' => 'image/*',
                                    'required' => true
                                ]) ?>
                                <small class="form-text text-muted">JPG, PNG, or GIF files only. Max size: 5MB.</small>
                            </div>

                            <div class="mb-3">
                                <?= $this->Form->label('documents', 'Official Documents (PDF) *', ['class' => 'form-label']) ?>
                                <?= $this->Form->file('documents', [
                                    'class' => 'form-control',
                                    'accept' => '.pdf',
                                    'required' => true
                                ]) ?>
                                <small class="form-text text-muted">Upload a PDF containing WWCC, Police check, CV, and other relevant documents (combined into one PDF). Max size: 10MB.</small>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Application
                                </button>
                            </div>
                        <?= $this->Form->end() ?>
                        
                        <div class="text-center mt-4">
                            <p class="text-muted">
                                <i class="fas fa-info-circle me-2"></i>
                                We will review your application and contact you within 3-5 business days.
                            </p>
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

<?php
/**
 * Public partner organisation signup page for CommunityLink - A5 requirement
 * Based on A3 volunteer-signup.php styling, adapted for organisation registration
 * 
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organisation $organisation
 * @var string $message
 * @var string $error
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner Organisation Registration - CommunityLink</title>
    
    <!-- Bootstrap CSS (same version as A3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons (same as A3) -->
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
                <?= $this->Html->link('Volunteer Signup', ['controller' => 'VolunteerSignups', 'action' => 'publicSignup'], ['class' => 'nav-link']) ?>
                <?= $this->Html->link('Organisation Registration', ['controller' => 'Organisations', 'action' => 'publicSignup'], ['class' => 'nav-link active']) ?>
                <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Partner With Us</h1>
            <p class="lead mb-4">Join CommunityLink as a partner organisation and help create positive change</p>
            <div class="row">
                <div class="col-md-4">
                    <i class="fas fa-handshake feature-icon"></i>
                    <h5>Collaboration</h5>
                    <p>Work together to create meaningful community events</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-network-wired feature-icon"></i>
                    <h5>Network</h5>
                    <p>Connect with other organisations and expand your reach</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-star feature-icon"></i>
                    <h5>Impact</h5>
                    <p>Make a real difference in your local community</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Organisation Signup Form -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="signup-form">
                        <h2 class="text-center mb-4">Partner Organisation Registration Form</h2>
                        
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
                        
                        <?= $this->Form->create($organisation, ['type' => 'post', 'url' => ['action' => 'publicSignup']]) ?>
                            <div class="mb-3">
                                <?= $this->Form->label('org_name', 'Business Name *', ['class' => 'form-label']) ?>
                                <?= $this->Form->text('org_name', [
                                    'class' => 'form-control',
                                    'maxlength' => '100',
                                    'required' => true,
                                    'value' => $organisation->org_name ?? ''
                                ]) ?>
                            </div>
                            
                            <div class="mb-3">
                                <?= $this->Form->label('business_address', 'Business Address *', ['class' => 'form-label']) ?>
                                <?= $this->Form->textarea('business_address', [
                                    'class' => 'form-control',
                                    'rows' => '3',
                                    'required' => true,
                                    'value' => $organisation->business_address ?? ''
                                ]) ?>
                            </div>
                            
                            <div class="mb-3">
                                <?= $this->Form->label('contact_person_full_name', 'Contact Person\'s Full Name *', ['class' => 'form-label']) ?>
                                <?= $this->Form->text('contact_person_full_name', [
                                    'class' => 'form-control',
                                    'maxlength' => '100',
                                    'required' => true,
                                    'value' => $organisation->contact_person_full_name ?? '',
                                    'placeholder' => 'John Smith'
                                ]) ?>
                            </div>
                            
                            <div class="mb-3">
                                <?= $this->Form->label('industry', 'Industry *', ['class' => 'form-label']) ?>
                                <?= $this->Form->text('industry', [
                                    'class' => 'form-control',
                                    'maxlength' => '100',
                                    'required' => true,
                                    'value' => $organisation->industry ?? '',
                                    'placeholder' => 'e.g., Community Services, Environmental, Arts & Culture'
                                ]) ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?= $this->Form->label('email', 'Contact Person Email *', ['class' => 'form-label']) ?>
                                        <?= $this->Form->email('email', [
                                            'class' => 'form-control',
                                            'maxlength' => '100',
                                            'required' => true,
                                            'value' => $organisation->email ?? '',
                                            'placeholder' => 'contact@example.com'
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?= $this->Form->label('phone', 'Contact Person Phone Number *', ['class' => 'form-label']) ?>
                                        <?= $this->Form->tel('phone', [
                                            'class' => 'form-control',
                                            'pattern' => '0[2-478][0-9 ]{8,}',
                                            'title' => 'Please enter a valid Australian phone number (04XX XXX XXX format only)',
                                            'maxlength' => '20',
                                            'required' => true,
                                            'value' => $organisation->phone ?? '',
                                            'placeholder' => '04XX XXX XXX'
                                        ]) ?>
                                        <small class="form-text text-muted">Australian phone numbers only - 04XX format (e.g., 0412 345 678)</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <?= $this->Form->label('help_description', 'What they can help with *', ['class' => 'form-label']) ?>
                                <?= $this->Form->textarea('help_description', [
                                    'class' => 'form-control',
                                    'rows' => '4',
                                    'placeholder' => 'Please describe how your organisation can help with community events and programs...',
                                    'required' => true,
                                    'value' => $organisation->help_description ?? ''
                                ]) ?>
                                <small class="form-text text-muted">Please describe what services, resources, or support your organisation can provide</small>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Registration
                                </button>
                            </div>
                        <?= $this->Form->end() ?>
                        
                        <div class="text-center mt-4">
                            <p class="text-muted">
                                <i class="fas fa-info-circle me-2"></i>
                                We will review your registration and contact you within 3-5 business days.
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
            <p>&copy; <?= date('Y') ?> CommunityLink. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


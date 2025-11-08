<?php
/**
 * Volunteer profile page for CommunityLink - A5 CakePHP version
 * Based on A3 volunteer-profile.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Volunteer $volunteer
 * @var string $message
 * @var string $error
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - CommunityLink</title>
    
    <!-- Bootstrap CSS (same version as A3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons (same as A3) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
        }
    </style>
</head>
<body>
    <!-- Profile Header -->
    <section class="profile-header">
        <div class="container text-center">
            <h1 class="display-5 mb-3">My Volunteer Profile</h1>
            <p class="lead">Manage your volunteer information and profile</p>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <?= $this->Flash->render() ?>
                    <?php if ($this->getRequest()->getQuery('updated')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Profile updated successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($message): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= h($message) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= h($error) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($volunteer): ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Edit Profile</h5>
                            </div>
                            <div class="card-body">
                                <?= $this->Form->create($volunteer, ['type' => 'file', 'url' => ['action' => 'profile']]) ?>
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <div class="mb-3">
                                                <?php
                                                $profileFilename = (string)($volunteer->profile_picture ?? '');
                                                if ($profileFilename) {
                                                    $profileFilename = str_replace('volunteer_profiles/', '', $profileFilename);
                                                    $profileFilename = str_replace('img/volunteer_profiles/', '', $profileFilename);
                                                }
                                                $profilePath = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS . $profileFilename;
                                                if ($profileFilename && file_exists($profilePath)):
                                                ?>
                                                    <img src="<?= $this->Url->build('/img/volunteer_profiles/' . $profileFilename) ?>" 
                                                         class="profile-picture" alt="Profile Picture">
                                                <?php else: ?>
                                                    <div class="profile-picture bg-secondary d-flex align-items-center justify-content-center mx-auto">
                                                        <i class="fas fa-user fa-3x text-white"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <?php
                                                    $docFilenameInline = (string)($volunteer->documents ?? '');
                                                    if ($docFilenameInline) {
                                                        $docFilenameInline = str_replace('volunteer_documents/', '', $docFilenameInline);
                                                    }
                                                    if ($docFilenameInline):
                                                ?>
                                                    <div class="mt-3">
                                                        <a href="<?= $this->Url->build('/volunteer_documents/' . $docFilenameInline) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-file-pdf me-1"></i>View Current Documents
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <?= $this->Form->label('profile_picture', 'Profile Picture', ['class' => 'form-label']) ?>
                                                <?= $this->Form->file('profile_picture', [
                                                    'class' => 'form-control',
                                                    'accept' => 'image/*'
                                                ]) ?>
                                                <small class="form-text text-muted">JPG, PNG, or GIF files only. Max size: 5MB.</small>
                                            </div>
                                            
                                            <!-- A5 Requirement: Document upload (WWCC, Police check, CV, etc. - combined PDF) -->
                                            <div class="mb-3">
                                                <?= $this->Form->label('documents', 'Official Documents (PDF)', ['class' => 'form-label']) ?>
                                                <?= $this->Form->file('documents', [
                                                    'class' => 'form-control',
                                                    'accept' => '.pdf'
                                                ]) ?>
                                                <small class="form-text text-muted">Upload combined PDF of WWCC, Police check, CV, etc. PDF only. Max size: 10MB.</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <?= $this->Form->label('first_name', 'First Name *', ['class' => 'form-label']) ?>
                                                <?= $this->Form->text('first_name', [
                                                    'class' => 'form-control',
                                                    'maxlength' => '50',
                                                    'required' => true,
                                                    'value' => $volunteer->first_name ?? ''
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
                                                    'value' => $volunteer->last_name ?? ''
                                                ]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <?= $this->Form->label('email', 'Email *', ['class' => 'form-label']) ?>
                                                <?= $this->Form->email('email', [
                                                    'class' => 'form-control',
                                                    'maxlength' => '100',
                                                    'required' => true,
                                                    'value' => $volunteer->email ?? ''
                                                ]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <?= $this->Form->label('phone', 'Phone *', ['class' => 'form-label']) ?>
                                                <?= $this->Form->tel('phone', [
                                                    'class' => 'form-control',
                                                    'pattern' => '[0-9\s\-\+\(\)]+',
                                                    'title' => 'Please enter a valid phone number (numbers, spaces, hyphens, parentheses, and plus signs only)',
                                                    'maxlength' => '20',
                                                    'required' => true,
                                                    'value' => $volunteer->phone ?? ''
                                                ]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="mb-3">
                                        <?= $this->Form->label('skills', 'Skills & Experience', ['class' => 'form-label']) ?>
                                        <?= $this->Form->textarea('skills', [
                                            'class' => 'form-control',
                                            'rows' => '3',
        								'placeholder' => 'List your skills and experience...',
                                            'maxlength' => '500',
                                            'value' => $volunteer->skills ?? ''
                                        ]) ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <?= $this->Form->label('status', 'Status', ['class' => 'form-label']) ?>
                                                <?= $this->Form->text('status', [
                                                    'class' => 'form-control',
                                                    'readonly' => true,
                                                    'value' => ucfirst($volunteer->status ?? 'inactive')
                                                ]) ?>
                                                <small class="form-text text-muted">Status can only be changed by administrators.</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <?= $this->Form->label('availability', 'Availability', ['class' => 'form-label']) ?>
                                                <?= $this->Form->textarea('availability', [
                                                    'class' => 'form-control',
                                                    'rows' => '3',
                                                    'placeholder' => 'e.g., Weekends, Weeknights, Mon/Wed/Fri',
                                                    'value' => $volunteer->availability ?? ''
                                                ]) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <?= $this->Form->label('self_intro', 'Self Introduction', ['class' => 'form-label']) ?>
                                        <?= $this->Form->textarea('self_intro', [
                                            'class' => 'form-control',
                                            'rows' => '3',
                                            'placeholder' => 'Brief explanation of interest',
                                            'value' => $volunteer->self_intro ?? ''
                                        ]) ?>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Update Profile
                                        </button>
                                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="btn btn-outline-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </a>
                                    </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Volunteer profile not found. Please contact an administrator.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


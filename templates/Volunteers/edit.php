<?php
/**
 * Edit Volunteer page for CommunityLink - A5 CakePHP version
 * Based on Events edit template, adapted for Volunteers with all A5 fields
 * 
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Volunteer $volunteer
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Volunteer - CommunityLink</title>
    
    <!-- Bootstrap CSS (same version as A3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons (same as A3) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        html, body { height: 100%; margin: 0; }
        .container-fluid { height: 100%; display: flex; flex-direction: column; }
        .row { display: flex; flex: 1; min-height: 0; align-items: stretch; }
        .col-md-3, .col-lg-2 { display: flex; flex-direction: column; }
        .sidebar { background: #343a40; width: 250px; display: flex; flex-direction: column; min-height: 100%; }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin: 0.25rem 0;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: #495057;
        }
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        .col-md-9, .col-lg-10 {
            display: flex;
            flex-direction: column;
        }
        .main-content {
            padding: 20px;
            flex: 1;
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (inline, no element) -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar p-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">
                            <i class="fas fa-hands-helping me-2"></i>CommunityLink
                        </h4>
                    </div>
                    <nav class="nav flex-column">
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'index']) ?>">
                            <i class="fas fa-calendar-alt"></i>Events
                        </a>
                        <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Volunteers', 'action' => 'index']) ?>">
                            <i class="fas fa-users"></i>Volunteers
                        </a>
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'VolunteerSignups', 'action' => 'index']) ?>">
                            <i class="fas fa-user-plus"></i>Volunteer Signups
                        </a>
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Organisations', 'action' => 'index']) ?>">
                            <i class="fas fa-handshake"></i>Organizations
                        </a>
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'ContactMessages', 'action' => 'index']) ?>">
                            <i class="fas fa-envelope"></i>Messages
                        </a>
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">
                            <i class="fas fa-user-cog"></i>Users
                        </a>
                        <hr class="text-muted">
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">
                            <i class="fas fa-sign-out-alt"></i>Logout
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Volunteers Management</h1>
                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <!-- Edit Volunteer Form -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Edit Volunteer</h5>
                        </div>
                        <div class="card-body">
                            <?= $this->Form->create($volunteer, ['url' => ['action' => 'edit', $volunteer->id], 'enctype' => 'multipart/form-data']) ?>
                                <!-- Name Fields -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('first_name', 'First Name *', ['class' => 'form-label']) ?>
                                            <?= $this->Form->text('first_name', [
                                                'class' => 'form-control',
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
                                                'required' => true,
                                                'value' => $volunteer->last_name ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Contact Information -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('email', 'Email Address *', ['class' => 'form-label']) ?>
                                            <?= $this->Form->email('email', [
                                                'class' => 'form-control',
                                                'required' => true,
                                                'value' => $volunteer->email ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('phone', 'Contact Number *', ['class' => 'form-label']) ?>
                                            <?= $this->Form->text('phone', [
                                                'class' => 'form-control',
                                                'required' => true,
                                                'value' => $volunteer->phone ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Skills and Availability -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('skills', 'Skills', ['class' => 'form-label']) ?>
                                            <?= $this->Form->textarea('skills', [
                                                'class' => 'form-control',
                                                'rows' => '3',
                                                'value' => $volunteer->skills ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('availability', 'Availability', ['class' => 'form-label']) ?>
                                            <?= $this->Form->textarea('availability', [
                                                'class' => 'form-control',
                                                'rows' => '3',
                                                'value' => $volunteer->availability ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Self Introduction -->
                                <div class="mb-3">
                                    <?= $this->Form->label('self_intro', 'Self Introduction', ['class' => 'form-label']) ?>
                                    <?= $this->Form->textarea('self_intro', [
                                        'class' => 'form-control',
                                        'rows' => '4',
                                        'value' => $volunteer->self_intro ?? ''
                                    ]) ?>
                                    <small class="form-text text-muted">Brief explanation of interest</small>
                                </div>
                                
                                <!-- File Uploads -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('profile_picture', 'Profile Picture', ['class' => 'form-label']) ?>
                                            <div style="min-height: 120px;">
                                                <?php
                                                // Handle both cases: with or without 'volunteer_profiles/' prefix
                                                $profileFilename = $volunteer->profile_picture ?? '';
                                                if ($profileFilename) {
                                                    // Remove 'volunteer_profiles/' prefix if present
                                                    $profileFilename = str_replace('volunteer_profiles/', '', $profileFilename);
                                                    $profileFilename = str_replace('img/volunteer_profiles/', '', $profileFilename);
                                                }
                                                $profilePath = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS . $profileFilename;
                                                if ($profileFilename && file_exists($profilePath)):
                                                ?>
                                                    <div class="mb-2">
                                                        <img src="<?= $this->Url->build('/img/volunteer_profiles/' . $profileFilename) ?>" 
                                                             class="profile-picture" alt="Current Profile Picture">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="mb-2">
                                                <small class="text-muted">Current: <?= h($profileFilename ?: 'none') ?></small>
                                            </div>
                                            <?= $this->Form->file('profile_picture', [
                                                'class' => 'form-control',
                                                'accept' => 'image/jpeg,image/png,image/gif',
                                                'required' => false
                                            ]) ?>
                                            <small class="form-text text-muted">JPG, PNG or GIF only. Leave empty to keep current.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('documents', 'Official Documents (PDF)', ['class' => 'form-label']) ?>
                                            <div style="min-height: 120px;">
                                                <?php if ($volunteer->documents): ?>
                                                    <div class="mb-2">
                                                        <a href="<?= $this->Url->build('/volunteer_documents/' . $volunteer->documents) ?>" 
                                                           target="_blank" 
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-file-pdf me-2"></i>View Current Document
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="mb-2">
                                                <small class="text-muted">Current: <?= h($volunteer->documents ?: 'none') ?></small>
                                            </div>
                                            <?= $this->Form->file('documents', [
                                                'class' => 'form-control',
                                                'accept' => 'application/pdf',
                                                'required' => false
                                            ]) ?>
                                            <small class="form-text text-muted">WWCC, Police check, CV etc. combined into one PDF. Leave empty to keep current.</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Date Submitted and Status -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('date_submitted', 'Date Submitted', ['class' => 'form-label']) ?>
                                            <?= $this->Form->date('date_submitted', [
                                                'class' => 'form-control',
                                                'value' => $volunteer->date_submitted ? $volunteer->date_submitted->format('Y-m-d') : ''
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('status', 'Status', ['class' => 'form-label']) ?>
                                            <?= $this->Form->select('status', [
                                                'inactive' => 'Inactive',
                                                'active' => 'Active',
                                                'hired' => 'Hired'
                                            ], [
                                                'class' => 'form-select',
                                                'value' => $volunteer->status ?? 'inactive'
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Volunteer
                                    </button>
                                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

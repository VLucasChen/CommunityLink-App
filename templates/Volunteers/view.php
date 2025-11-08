<?php
/**
 * View Volunteer page for CommunityLink - A5 CakePHP version
 * Based on A3 volunteers.php view, adapted for CakePHP with same Bootstrap styling
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
    <title>View Volunteer - CommunityLink</title>
    
    <!-- Bootstrap CSS (same version as A3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons (same as A3) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        html, body { height: 100%; margin: 0; }
        .container-fluid { height: 100%; display: flex; flex-direction: column; }
        .row { display: flex; flex: 1; min-height: 0; align-items: stretch; }
        .col-md-3, .col-lg-2 { display: flex; flex-direction: column; }
        .sidebar {
            background: #343a40;
            width: 250px;
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }
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
        .main-content {
            padding: 20px;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #667eea;
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
                    <div class="mb-3">
                        <h1><?= h($volunteer->first_name . ' ' . $volunteer->last_name) ?></h1>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <!-- View Volunteer Details (Events page layout) -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Volunteer Details</h5>
                            <div>
                                <?= $this->Html->link('<i class="fas fa-edit me-2"></i>Edit', ['action' => 'edit', $volunteer->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <h3 class="mb-0 me-3"><?= h($volunteer->first_name . ' ' . $volunteer->last_name) ?></h3>
                                        <?php
                                        $statusColors = [
                                            'active' => 'success',
                                            'inactive' => 'secondary',
                                            'hired' => 'primary'
                                        ];
                                        $statusColor = $statusColors[$volunteer->status] ?? 'secondary';
                                        ?>
                                        <span class="badge bg-<?= $statusColor ?> fs-6"><?= h(ucfirst($volunteer->status ?? 'inactive')) ?></span>
                                    </div>
                                    
                                    <!-- Basic Information -->
                                    <div class="mb-4">
                                        <h5 class="mb-3">Basic Information</h5>
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-envelope me-2"></i><strong>Email:</strong> <a href="mailto:<?= h($volunteer->email) ?>"><?= h($volunteer->email) ?></a>
                                        </p>
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-phone me-2"></i><strong>Phone:</strong> <?= h($volunteer->phone) ?>
                                        </p>
                                        <?php if ($volunteer->date_submitted): ?>
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-calendar me-2"></i><strong>Date Submitted:</strong> <?= h($volunteer->date_submitted->format('M j, Y')) ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Skills -->
                                    <?php if (!empty($volunteer->skills)): ?>
                                        <div class="mb-4">
                                            <h5 class="mb-3">Skills</h5>
                                            <p><?= nl2br(h($volunteer->skills)) ?></p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Availability -->
                                    <?php if (!empty($volunteer->availability)): ?>
                                        <div class="mb-4">
                                            <h5 class="mb-3">Availability</h5>
                                            <p><?= nl2br(h($volunteer->availability)) ?></p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Self Introduction -->
                                    <?php if (!empty($volunteer->self_intro)): ?>
                                        <div class="mb-4">
                                            <h5 class="mb-3">Self Introduction</h5>
                                            <p><?= nl2br(h($volunteer->self_intro)) ?></p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Documents -->
                                    <?php if (!empty($volunteer->documents)): ?>
                                        <div class="mb-4">
                                            <h5 class="mb-3">Official Documents</h5>
                                            <a href="<?= $this->Url->build('/volunteer_documents/' . $volunteer->documents) ?>" 
                                               target="_blank" 
                                               class="btn btn-primary">
                                                <i class="fas fa-file-pdf me-2"></i>View Documents (PDF)
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="mb-0">Profile Picture</h6>
                                        </div>
                                        <div class="card-body text-center">
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
                                                <img src="<?= $this->Url->build('/img/volunteer_profiles/' . $profileFilename) ?>" 
                                                     class="profile-picture" alt="Profile Picture">
                                            <?php else: ?>
                                                <div class="profile-picture bg-secondary d-flex align-items-center justify-content-center mx-auto">
                                                    <i class="fas fa-user fa-3x text-white"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- A5 Requirement: Show related events -->
                                    <?php if (!empty($events)): ?>
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="mb-0">Participated Events (<?= count($events) ?>)</h6>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-unstyled">
                                                    <?php foreach ($events as $event): ?>
                                                        <li class="mb-2">
                                                            <i class="fas fa-calendar me-2"></i>
                                                            <strong><?= h($event->title) ?></strong>
                                                            <br><small class="text-muted">
                                                                <?= $event->event_date ? h($event->event_date->format('M j, Y')) : 'N/A' ?>
                                                                - <?= h($event->location) ?>
                                                            </small>
                                                            <div class="mt-1">
                                                                <a href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'view', $event->id]) ?>" class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-eye"></i> View
                                                                </a>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

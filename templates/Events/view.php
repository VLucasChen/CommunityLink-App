<?php
/**
 * View Event page for CommunityLink - A5 CakePHP version
 * Based on A3 events.php view, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 * @var array $assignedVolunteerIds
 * @var array $volunteers
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Event - CommunityLink</title>
    
    <!-- Bootstrap CSS (same version as A3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons (same as A3) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .container-fluid {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .row {
            display: flex;
            flex: 1;
            min-height: 0;
            align-items: stretch;
        }
        .col-md-3, .col-lg-2 {
            display: flex;
            flex-direction: column;
        }
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
        .col-md-9, .col-lg-10 {
            display: flex;
            flex-direction: column;
        }
        .main-content {
            padding: 20px;
            flex: 1;
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
                        <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'index']) ?>">
                            <i class="fas fa-calendar-alt"></i>Events
                        </a>
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Volunteers', 'action' => 'index']) ?>">
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
                        <h1><?= h($event->title) ?></h1>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <!-- View Event Details (A3 layout) -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Event Details</h5>
                            <div>
                                <?= $this->Html->link('<i class="fas fa-edit me-2"></i>Edit', ['action' => 'edit', $event->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
<div class="row">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <h3 class="mb-0 me-3"><?= h($event->title) ?></h3>
                                        <?php
                                        $status = $event->status ?? 'Preparing';
                                        $badgeClass = match($status) {
                                            'Ready to go' => 'bg-success',
                                            'Preparing' => 'bg-warning',
                                            'Archive' => 'bg-info',
                                            'Failed' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                        ?>
                                        <span class="badge <?= $badgeClass ?> fs-6"><?= h($status) ?></span>
                                    </div>
                                    
                                    <!-- Basic Information -->
                                    <div class="mb-4">
                                        <h5 class="mb-3">Basic Information</h5>
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-calendar me-2"></i><strong>Event Date:</strong> <?= $event->event_date ? h($event->event_date->format('l, F j, Y')) : 'Not set' ?>
                                        </p>
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-map-marker-alt me-2"></i><strong>Location:</strong> <?= h($event->location ?? 'N/A') ?>
                                        </p>
                                        <?php if ($event->has('organisation') && $event->organisation): ?>
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-building me-2"></i><strong>Organization:</strong> <?= h($event->organisation->org_name) ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if (!empty($event->host)): ?>
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-user-tie me-2"></i><strong>Host:</strong> <?= h($event->host) ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if (!empty($event->event_size)): ?>
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-users me-2"></i><strong>Event Size:</strong> <?= h($event->event_size) ?> people
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Contact Information -->
                                    <?php if (!empty($event->contact_person_full_name) || !empty($event->contact_person_email)): ?>
                                        <div class="mb-4">
                                            <h5 class="mb-3">Contact Information</h5>
                                            <?php if (!empty($event->contact_person_full_name)): ?>
                                                <p class="text-muted mb-2">
                                                    <i class="fas fa-user me-2"></i><strong>Contact Person:</strong> <?= h($event->contact_person_full_name) ?>
                                                </p>
                                            <?php endif; ?>
                                            <?php if (!empty($event->contact_person_email)): ?>
                                                <p class="text-muted mb-2">
                                                    <i class="fas fa-envelope me-2"></i><strong>Email:</strong> <a href="mailto:<?= h($event->contact_person_email) ?>"><?= h($event->contact_person_email) ?></a>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Description -->
                                    <?php if (!empty($event->event_description)): ?>
                                        <div class="mb-4">
                                            <h5 class="mb-3">Description</h5>
                                            <p><?= nl2br(h($event->event_description)) ?></p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Requirements -->
                                    <div class="mb-4">
                                        <h5 class="mb-3">Requirements</h5>
                                        <?php if (!empty($event->required_equipment)): ?>
                                            <div class="mb-3">
                                                <p class="mb-1"><strong><i class="fas fa-tools me-2"></i>Required Equipment:</strong></p>
                                                <p class="text-muted"><?= nl2br(h($event->required_equipment)) ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($event->required_skills)): ?>
                                            <div class="mb-3">
                                                <p class="mb-1"><strong><i class="fas fa-star me-2"></i>Required Skills:</strong></p>
                                                <p class="text-muted"><?= nl2br(h($event->required_skills)) ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($event->number_of_required_crews)): ?>
                                            <div class="mb-3">
                                                <p class="mb-1"><strong><i class="fas fa-user-friends me-2"></i>Number of Required Crews:</strong></p>
                                                <p class="text-muted"><?= h($event->number_of_required_crews) ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Assigned Volunteers</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php if (!empty($assignedVolunteerIds) && !empty($volunteers)): ?>
                                                <ul class="list-unstyled">
                                                    <?php foreach ($volunteers as $volunteer): ?>
                                                        <?php if (in_array($volunteer->id, $assignedVolunteerIds)): ?>
                                                            <li class="mb-2 d-flex align-items-center justify-content-between">
                                                                <div>
                                                                    <i class="fas fa-user me-2"></i>
                                                                    <?= h($volunteer->first_name . ' ' . $volunteer->last_name) ?>
                                                                    <span class="badge bg-<?= $volunteer->status === 'active' ? 'success' : ($volunteer->status === 'hired' ? 'primary' : 'secondary'); ?> ms-2">
                                                                        <?= h(ucfirst($volunteer->status ?? 'inactive')) ?>
                                                                    </span>
                                                                </div>
                                                                <a class="btn btn-sm btn-outline-primary" href="<?= $this->Url->build(['controller' => 'Volunteers', 'action' => 'view', $volunteer->id]) ?>">
                                                                    <i class="fas fa-eye me-1"></i>View
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php else: ?>
                                                <p class="text-muted">No volunteers assigned</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
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

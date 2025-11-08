<?php
/**
 * Dashboard page for CommunityLink admin - A5 CakePHP version
 * Based on A3 dashboard.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var int $eventCount
 * @var int $volunteerCount
 * @var int $orgCount
 * @var int $messageCount
 * @var int $signupCount
 * @var int $totalSignupCount
 * @var int $hiredSignupCount
 * @var int $declinedSignupCount
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CommunityLink</title>
    
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
        .sidebar { min-height: 100%; background: #343a40; width: 250px; }
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
        .stat-card {
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }
        .stat-card .card-body { min-height: 110px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar p-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">
                            <i class="fas fa-hands-helping me-2"></i>CommunityLink
                        </h4>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'index']) ?>">
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Dashboard</h1>
                    </div>
                    
                    <!-- Statistics Cards (A3 exact layout) -->
                    <div class="stats-grid mb-4">
                        <a href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'index']) ?>" class="text-decoration-none">
                        <div class="card stat-card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $eventCount ?></h4>
                                        <p class="card-text">Total Events</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-calendar-alt fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'Volunteers', 'action' => 'index']) ?>" class="text-decoration-none">
                        <div class="card stat-card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $volunteerCount ?></h4>
                                        <p class="card-text">Total Volunteers</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'Organisations', 'action' => 'index']) ?>" class="text-decoration-none">
                        <div class="card stat-card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $orgCount ?></h4>
                                        <p class="card-text">Organizations</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-handshake fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'ContactMessages', 'action' => 'index']) ?>" class="text-decoration-none">
                        <div class="card stat-card bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $messageCount ?></h4>
                                        <p class="card-text">Unread Messages</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-envelope fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'VolunteerSignups', 'action' => 'index']) ?>" class="text-decoration-none">
                        <div class="card stat-card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $totalSignupCount ?></h4>
                                        <p class="card-text">Total Signups</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-clipboard-list fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                        <div class="card stat-card bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $signupCount ?></h4>
                                        <p class="card-text">Pending Signups</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-user-plus fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card stat-card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $hiredSignupCount ?></h4>
                                        <p class="card-text">Hired Signups</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-user-check fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card stat-card bg-danger text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $declinedSignupCount ?></h4>
                                        <p class="card-text">Declined Signups</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-user-times fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- A5 Requirement: Top 10 Most Active Volunteers -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-trophy me-2"></i>Top 10 Most Active Volunteers (Current Year)</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($topVolunteers)): ?>
                                        <div class="list-group list-group-flush">
                                            <?php foreach ($topVolunteers as $item): ?>
                                                <?php $volunteer = $item['volunteer']; ?>
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong><?= h($volunteer->first_name . ' ' . $volunteer->last_name) ?></strong>
                                                        <br><small class="text-muted"><?= h($volunteer->email) ?></small>
                                                    </div>
                                                    <span class="badge bg-primary rounded-pill"><?= h($item['event_count']) ?> events</span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-muted">No volunteer activity data available for this year.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- A5 Requirement: Top 10 Most Active Organisations -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-building me-2"></i>Top 10 Most Active Organisations (Current Year)</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($topOrganisations)): ?>
                                        <div class="list-group list-group-flush">
                                            <?php foreach ($topOrganisations as $item): ?>
                                                <?php $org = $item['organisation']; ?>
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong><?= h($org->org_name) ?></strong>
                                                        <br><small class="text-muted"><?= h($org->email) ?></small>
                                                    </div>
                                                    <span class="badge bg-success rounded-pill"><?= h($item['event_count']) ?> events</span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-muted">No organisation activity data available for this year.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- A5 Requirement: Volunteer Skills Distribution -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Volunteer Skills Distribution (Top 10)</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($skillsStats)): ?>
                                        <div class="list-group list-group-flush">
                                            <?php foreach ($skillsStats as $skill => $count): ?>
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span><?= h($skill) ?></span>
                                                    <span class="badge bg-info rounded-pill"><?= h($count) ?> volunteer<?= $count != 1 ? 's' : '' ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-muted">No skills data available.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- A5 Requirement: Events in Coming Month by Status -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Events in Coming Month by Status</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($eventsNextMonth)): ?>
                                        <div class="list-group list-group-flush">
                                            <?php 
                                            $statusLabels = [
                                                'Preparing' => 'warning',
                                                'Ready to go' => 'success',
                                                'Archive' => 'secondary',
                                                'Failed' => 'danger'
                                            ];
                                            foreach ($eventsNextMonth as $eventStat): 
                                                $statusClass = $statusLabels[$eventStat->status] ?? 'light';
                                            ?>
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span class="badge bg-<?= $statusClass ?>"><?= h($eventStat->status) ?></span>
                                                    <span class="badge bg-primary rounded-pill"><?= h($eventStat->count ?? 0) ?> event<?= ($eventStat->count ?? 0) != 1 ? 's' : '' ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-muted">No events scheduled.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions (A3) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <?= $this->Html->link('<i class="fas fa-plus me-2"></i>Add New Event', ['controller' => 'Events', 'action' => 'add'], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                                        <?= $this->Html->link('<i class="fas fa-user-plus me-2"></i>Add New Volunteer', ['controller' => 'Volunteers', 'action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
                                        <?= $this->Html->link('<i class="fas fa-building me-2"></i>Add New Organization', ['controller' => 'Organisations', 'action' => 'add'], ['class' => 'btn btn-info', 'escape' => false]) ?>
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

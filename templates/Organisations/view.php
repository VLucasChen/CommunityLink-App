<?php
/**
 * View Organisation page for CommunityLink - A5 CakePHP version
 * Based on A3 organisations.php view, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organisation $organisation
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Organisation - CommunityLink</title>
    
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
        .sidebar .nav-link i { width: 20px; margin-right: 10px; }
        .main-content { padding: 20px; flex: 1; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (inline, consistent with Events/Volunteers) -->
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
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Volunteers', 'action' => 'index']) ?>">
                            <i class="fas fa-users"></i>Volunteers
                        </a>
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'VolunteerSignups', 'action' => 'index']) ?>">
                            <i class="fas fa-user-plus"></i>Volunteer Signups
                        </a>
                        <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Organisations', 'action' => 'index']) ?>">
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
                        <h1><?= h($organisation->org_name) ?></h1>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Organisation Details</h5>
                                    <div>
                                        <?= $this->Html->link('<i class="fas fa-edit me-2"></i>Edit', ['action' => 'edit', $organisation->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Back to List</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="30%">Business Name</th>
                                            <td><?= h($organisation->org_name) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Contact Person</th>
                                            <td><?= h($organisation->contact_person_full_name) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><i class="fas fa-envelope me-1"></i><?= h($organisation->email) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td><i class="fas fa-phone me-1"></i><?= h($organisation->phone) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Industry</th>
                                            <td><?= h($organisation->industry) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Business Address</th>
                                            <td><?= $this->Text->autoParagraph(h($organisation->business_address)) ?></td>
                                        </tr>
                                        <tr>
                                            <th>What They Can Help With</th>
                                            <td><?= $this->Text->autoParagraph(h($organisation->help_description)) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- No actions on view page -->
                    </div>
                    
                    <!-- A5 Requirement: Show related events -->
                    <?php if (!empty($organisation->events)): ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Related Events (<?= count($organisation->events) ?>)</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Location</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($organisation->events as $event): ?>
                                                <tr>
                                                    <td><strong><?= h($event->title) ?></strong></td>
                                                    <td><?= $event->event_date ? h($event->event_date->format('M j, Y')) : 'N/A' ?></td>
                                                    <td><?= h($event->location) ?></td>
                                                    <td>
                                                        <?php
                                                        $statusClass = match($event->status ?? '') {
                                                            'Preparing' => 'warning',
                                                            'Ready to go' => 'success',
                                                            'Archive' => 'secondary',
                                                            'Failed' => 'danger',
                                                            default => 'light'
                                                        };
                                                        ?>
                                                        <span class="badge bg-<?= $statusClass ?>"><?= h($event->status ?? 'N/A') ?></span>
                                                    </td>
                                                    <td>
                                                        <a href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'view', $event->id]) ?>" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card">
                            <div class="card-body">
                                <p class="text-muted mb-0">No events associated with this organisation.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

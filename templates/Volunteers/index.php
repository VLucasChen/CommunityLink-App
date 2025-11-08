<?php
/**
 * Volunteers management page for CommunityLink - A5 CakePHP version
 * Based on A3 volunteers.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Volunteer> $volunteers
 * @var string $search
 * @var string $status
 * @var string $skills
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteers Management - CommunityLink</title>
    
    <!-- Bootstrap CSS (same version as A3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons (same as A3) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        html, body { height: 100%; margin: 0; }
        .container-fluid { height: 100%; display: flex; flex-direction: column; }
        .row { display: flex; flex: 1; min-height: 0; align-items: stretch; }
        .col-md-3, .col-lg-2 { display: flex; flex-direction: column; }
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
        .main-content {
            padding: 20px;
        }
        .profile-picture {
            width: 60px;
            height: 60px;
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
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <!-- Volunteers List -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Volunteers</h5>
                            <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add New Volunteer
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Search and Filters (Events page style - no labels) -->
                            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3 mb-4 align-items-center']) ?>
                                <div class="col-auto" style="max-width: 360px;">
                                    <label for="search" class="visually-hidden">Filter</label>
                                    <?= $this->Form->text('search', [
                                        'class' => 'form-control',
                                        'id' => 'search',
                                        'placeholder' => 'Filter name',
                                        'value' => $search ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto" style="max-width: 150px;">
                                    <label for="status" class="visually-hidden">Status</label>
                                    <?= $this->Form->select('status', [
                                        '' => 'Filter status',
                                        'active' => 'Active',
                                        'inactive' => 'Inactive',
                                        'hired' => 'Hired'
                                    ], [
                                        'class' => 'form-select',
                                        'id' => 'status',
                                        'value' => $status ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto" style="max-width: 180px;">
                                    <label for="skills" class="visually-hidden">Skills</label>
                                    <?= $this->Form->text('skills', [
                                        'class' => 'form-control',
                                        'id' => 'skills',
                                        'placeholder' => 'Filter skills',
                                        'value' => $skills ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto" style="max-width: 180px;">
                                    <label for="availability" class="visually-hidden">Availability</label>
                                    <?= $this->Form->text('availability', [
                                        'class' => 'form-control',
                                        'id' => 'availability',
                                        'placeholder' => 'Filter availability',
                                        'value' => $availability ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                                    <?php if (($search ?? '') || ($status ?? '') || ($skills ?? '') || ($availability ?? '')): ?>
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary ms-2">Clear</a>
                                    <?php endif; ?>
                                </div>
                            <?= $this->Form->end() ?>
                            
                            <?php 
                            // Check if volunteers collection is actually empty (CakePHP pagination returns Collection, not array)
                            $volunteersArray = $volunteers->toArray();
                            $hasVolunteers = !empty($volunteersArray);
                            $hasFilters = ($search ?? '') || ($status ?? '') || ($skills ?? '') || ($availability ?? '');
                            ?>
                            <?php if (!$hasVolunteers): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5>No volunteers found</h5>
                                    <p class="text-muted"><?= $hasFilters ? 'Try adjusting your search terms.' : 'Get started by adding your first volunteer.'; ?></p>
                                </div>
                            <?php else: ?>
    <div class="table-responsive">
                                    <table class="table table-striped">
            <thead>
                <tr>
                                                <th>Profile</th>
                                                <th>Name</th>
                                                <th style="min-width: 250px;">Contact</th>
                                                <th style="min-width: 200px;">Skills</th>
                                                <th style="max-width: 120px;">Availability</th>
                                                <th>Status</th>
                                                <th>Events</th>
                                                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                                            <?php foreach ($volunteers as $vol): ?>
                                                <tr>
                                                    <td>
                                                        <?php 
                                                        // Handle both cases: with or without 'volunteer_profiles/' prefix
                                                        $profileFilename = $vol->profile_picture ?? '';
                                                        if ($profileFilename) {
                                                            // Remove 'volunteer_profiles/' prefix if present
                                                            $profileFilename = str_replace('volunteer_profiles/', '', $profileFilename);
                                                            $profileFilename = str_replace('img/volunteer_profiles/', '', $profileFilename);
                                                        }
                                                        $profilePath = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS . $profileFilename;
                                                        if ($profileFilename && file_exists($profilePath)):
                                                        ?>
                                                            <img src="<?= $this->Url->build('/img/volunteer_profiles/' . $profileFilename) ?>" 
                                                                 alt="Profile" class="profile-picture">
                                                        <?php else: ?>
                                                            <div class="profile-picture bg-secondary d-flex align-items-center justify-content-center">
                                                                <i class="fas fa-user text-white"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <strong><?= h($vol->first_name . ' ' . $vol->last_name) ?></strong>
                                                    </td>
                                                    <td>
                                                        <div><i class="fas fa-envelope me-2"></i><?= h($vol->email) ?></div>
                                                        <div><i class="fas fa-phone me-2"></i><?= h($vol->phone) ?></div>
                                                    </td>
                                                    <td style="min-width: 200px;">
                                                        <?php if ($vol->skills): ?>
                                                            <small><?= h(substr($vol->skills, 0, 120)) . (strlen($vol->skills) > 120 ? '...' : '') ?></small>
                                                        <?php else: ?>
                                                            <span class="text-muted">No skills listed</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="max-width: 120px;">
                                                        <?php if ($vol->availability): ?>
                                                            <small><?= h(substr($vol->availability, 0, 40)) . (strlen($vol->availability) > 40 ? '...' : '') ?></small>
                                                        <?php else: ?>
                                                            <span class="text-muted">Not specified</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $statusColors = [
                                                            'active' => 'success',
                                                            'inactive' => 'secondary',
                                                            'hired' => 'primary'
                                                        ];
                                                        $statusColor = $statusColors[$vol->status] ?? 'secondary';
                                                        ?>
                                                        <span class="badge bg-<?= $statusColor ?>">
                                                            <?= h(ucfirst($vol->status)) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        // Count events for this volunteer
                                                        $eventCount = 0;
                                                        if ($vol->has('events')) {
                                                            $eventCount = count($vol->events ?? []);
                                                        }
                                                        ?>
                                                        <span class="badge bg-info"><?= $eventCount ?> events</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="<?= $this->Url->build(['action' => 'view', $vol->id]) ?>" class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="<?= $this->Url->build(['action' => 'edit', $vol->id]) ?>" class="btn btn-sm btn-outline-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                        <?= $this->Form->postLink(
                                                                '<i class="fas fa-trash"></i>',
                                                                ['action' => 'delete', $vol->id],
                            [
                                                                    'class' => 'btn btn-sm btn-outline-danger',
                                                                    'confirm' => __('Are you sure you want to delete the volunteer "{0}"?', h($vol->first_name . ' ' . $vol->last_name)),
                                                                    'escape' => false
                            ]
                        ) ?>
                                                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
                                
                                <!-- A5 Requirement: Server-side pagination using CakePHP Paginator -->
                                <nav aria-label="Volunteers pagination" class="mt-3">
                                    <?php 
                                        $paging = $this->getRequest()->getAttribute('paging') ?? [];
                                        $pg = $paging['Volunteers'] ?? [];
                                    ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text">
                                            <?= $this->Paginator->counter(__('Showing {{start}} to {{end}} of {{count}} entries')) ?>
                                        </div>
                                        <ul class="pagination mb-0">
                                        <?= $this->Paginator->prev(__('Previous'), [
                                            'templates' => [
                                                'prevActive' => '<li class="page-item"><a class="page-link" rel="prev" href="{{url}}">{{text}}</a></li>',
                                                'prevDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>'
                                            ]
                                        ]) ?>
                                        <?php if (isset($pg['pageCount']) && $pg['pageCount'] === 1): ?>
                                            <li class="page-item active"><span class="page-link">1</span></li>
                                        <?php else: ?>
                                            <?= $this->Paginator->numbers([
                                                'separator' => '',
                                                'templates' => [
                                                    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                                    'current' => '<li class="page-item active"><span class="page-link">{{text}}</span></li>'
                                                ]
                                            ]) ?>
                                        <?php endif; ?>
                                        <?= $this->Paginator->next(__('Next'), [
                                            'templates' => [
                                                'nextActive' => '<li class="page-item"><a class="page-link" rel="next" href="{{url}}">{{text}}</a></li>',
                                                'nextDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>'
                                            ]
                                        ]) ?>
        </ul>
                                    </div>
                                </nav>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

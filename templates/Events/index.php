<?php
/**
 * Events management page for CommunityLink - A5 CakePHP version
 * Based on A3 events.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Event> $events
 * @var string $search
 * @var string $skills
 * @var string $status
 * @var string $event_date
 * @var string $date_from
 * @var string $date_to
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Management - CommunityLink</title>
    
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Events Management</h1>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <!-- Events List -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Events</h5>
                            <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add New Event
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- A3-style simple search (title/location/description) -->
                            
                            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3 mb-4 align-items-center']) ?>
                                <div class="col-auto" style="max-width: 360px;">
                                    <label for="search" class="visually-hidden">Filter</label>
                                    <?= $this->Form->text('search', [
                                        'class' => 'form-control',
                                        'id' => 'search',
                                        'placeholder' => 'Filter title',
                                        'value' => $search ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto" style="max-width: 220px;">
                                    <label for="skills" class="visually-hidden">Skills</label>
                                    <?= $this->Form->text('skills', [
                                        'class' => 'form-control',
                                        'id' => 'skills',
                                        'placeholder' => 'Filter skills',
                                        'value' => $skills ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto" style="max-width: 180px;">
                                    <label for="status" class="visually-hidden">Status</label>
                                    <?= $this->Form->select('status', [
                                        '' => 'Filter status',
                                        'Preparing' => 'Preparing',
                                        'Ready to go' => 'Ready to go',
                                        'Archive' => 'Archive',
                                        'Failed' => 'Failed'
                                    ], [
                                        'class' => 'form-select',
                                        'id' => 'status',
                                        'value' => $status ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto">
                                    <label for="event_date" class="visually-hidden">Date</label>
                                    <?= $this->Form->date('event_date', [
                                        'class' => 'form-control',
                                        'id' => 'event_date',
                                        'placeholder' => 'Date',
                                        'value' => $event_date ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                                    <?php if (($search ?? '') || ($skills ?? '') || ($status ?? '') || ($event_date ?? '')): ?>
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary ms-2">Clear</a>
                                    <?php endif; ?>
                                </div>
                            <?= $this->Form->end() ?>
                            
                            <!-- Removed A5 extra filters to match A3 UI -->
                            
                            <?php 
                            // Check if events collection is actually empty (CakePHP pagination returns Collection, not array)
                            $eventsArray = $events->toArray();
                            $hasEvents = !empty($eventsArray);
                            $hasFilters = ($search ?? '') || ($skills ?? '') || ($status ?? '') || ($event_date ?? '');
                            
                            // Show "No events found" only if:
                            // 1. Events collection is empty AND filters are applied, OR
                            // 2. Events collection is empty AND no filters (truly empty database)
                            $showEmptyState = !$hasEvents;
                            ?>
                            <?php if ($showEmptyState): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                    <h5>No events found</h5>
                                    <p class="text-muted"><?= $hasFilters ? 'Try adjusting your search terms.' : 'Get started by adding your first event.'; ?></p>
                                </div>
                            <?php else: ?>
    <div class="table-responsive">
                                    <table class="table table-striped">
            <thead>
                <tr>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Location</th>
                                                <th>Organization</th>
                                                <th>Required Skills</th>
                                                <th>Volunteers</th>
                                                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                                                    <td><strong><?= h($event->title) ?></strong></td>
                                                    <td><?= $event->event_date ? h($event->event_date->format('M j, Y')) : 'N/A' ?></td>
                                                    <td>
                                                        <?php
                                                        $eventStatus = $event->status ?? 'Preparing';
                                                        $badgeClass = match($eventStatus) {
                                                            'Ready to go' => 'bg-success',
                                                            'Preparing' => 'bg-warning',
                                                            'Archive' => 'bg-info',
                                                            'Failed' => 'bg-danger',
                                                            default => 'bg-secondary'
                                                        };
                                                        ?>
                                                        <span class="badge <?= $badgeClass ?>"><?= h($eventStatus) ?></span>
                                                    </td>
                    <td><?= h($event->location) ?></td>
                                                    <td><?= $event->has('organisation') ? h($event->organisation->org_name) : 'N/A' ?></td>
                                                    <td><?= h($event->required_skills ?? '') ?></td>
                                                    <td>
                                                        <span class="badge bg-info"><?= count($event->volunteers ?? []) ?> volunteers</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="<?= $this->Url->build(['action' => 'view', $event->id]) ?>" class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="<?= $this->Url->build(['action' => 'edit', $event->id]) ?>" class="btn btn-sm btn-outline-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                        <?= $this->Form->postLink(
                                                                '<i class="fas fa-trash"></i>',
                                                                ['action' => 'delete', $event->id],
                            [
                                                                    'class' => 'btn btn-sm btn-outline-danger',
                                                                    'confirm' => __('Are you sure you want to delete the event "{0}"?', h($event->title)),
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
                                
                                <!-- A5 Requirement: Server-side pagination using CakePHP Paginator (NOT DataTables) -->
                                <nav aria-label="Events pagination" class="mt-3">
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
                                        <?php 
                                            $paging = $this->getRequest()->getAttribute('paging') ?? [];
                                            $pg = $paging['Events'] ?? [];
                                        ?>
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

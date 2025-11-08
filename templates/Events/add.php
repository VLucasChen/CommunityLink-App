<?php
/**
 * Add Event page for CommunityLink - A5 CakePHP version
 * Based on A3 events.php add form, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 * @var \Cake\Collection\CollectionInterface|string[] $organisations
 * @var array $volunteers
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Event - CommunityLink</title>
    
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Events Management</h1>
                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <!-- Add Event Form -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Add New Event</h5>
                        </div>
                        <div class="card-body">
                            <?= $this->Form->create($event, ['url' => ['action' => 'add']]) ?>
                                <!-- A5 Requirement: Event Title -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('title', 'Event Title *', ['class' => 'form-label']) ?>
                                            <?= $this->Form->text('title', [
                                                'class' => 'form-control',
                                                'maxlength' => '200',
                                                'required' => true,
                                                'value' => $event->title ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                    <!-- A5 Requirement: Event Date -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('event_date', 'Event Date *', ['class' => 'form-label']) ?>
                                            <?= $this->Form->date('event_date', [
                                                'class' => 'form-control',
                                                'min' => date('Y-m-d'),
                                                'required' => true,
                                                'value' => $event->event_date ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Location -->
                                <div class="mb-3">
                                    <?= $this->Form->label('location', 'Location *', ['class' => 'form-label']) ?>
                                    <?= $this->Form->text('location', [
                                        'class' => 'form-control',
                                        'maxlength' => '200',
                                        'required' => true,
                                        'value' => $event->location ?? ''
                                    ]) ?>
                                </div>
                                
                                <!-- A5 Fields: Host and Event Size -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('host', 'Host', ['class' => 'form-label']) ?>
                                            <?= $this->Form->text('host', [
                                                'class' => 'form-control',
                                                'value' => $event->host ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('event_size', 'Event Size', ['class' => 'form-label']) ?>
                                            <?= $this->Form->number('event_size', [
                                                'class' => 'form-control',
                                                'min' => '1',
                                                'value' => $event->event_size ?? ''
                                            ]) ?>
                                            <small class="form-text text-muted">Number of people expected</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- A5 Fields: Contact Person -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('contact_person_full_name', 'Contact Person Full Name', ['class' => 'form-label']) ?>
                                            <?= $this->Form->text('contact_person_full_name', [
                                                'class' => 'form-control',
                                                'value' => $event->contact_person_full_name ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('contact_person_email', 'Contact Person Email', ['class' => 'form-label']) ?>
                                            <?= $this->Form->email('contact_person_email', [
                                                'class' => 'form-control',
                                                'value' => $event->contact_person_email ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="mb-3">
                                    <?= $this->Form->label('event_description', 'Event Description *', ['class' => 'form-label']) ?>
                                    <?= $this->Form->textarea('event_description', [
                                        'class' => 'form-control',
                                        'rows' => '4',
                                        'required' => true,
                                        'value' => $event->event_description ?? ''
                                    ]) ?>
                                </div>
                                
                                <!-- A5 Fields: Requirements -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('required_equipment', 'Required Equipment', ['class' => 'form-label']) ?>
                                            <?= $this->Form->textarea('required_equipment', [
                                                'class' => 'form-control',
                                                'rows' => '3',
                                                'value' => $event->required_equipment ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('required_skills', 'Required Skills', ['class' => 'form-label']) ?>
                                            <?= $this->Form->textarea('required_skills', [
                                                'class' => 'form-control',
                                                'rows' => '3',
                                                'value' => $event->required_skills ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- A5 Fields: Number of Required Crews and Status -->
<div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('number_of_required_crews', 'Number of Required Crews', ['class' => 'form-label']) ?>
                                            <?= $this->Form->number('number_of_required_crews', [
                                                'class' => 'form-control',
                                                'min' => '1',
                                                'value' => $event->number_of_required_crews ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <?= $this->Form->label('status', 'Status', ['class' => 'form-label']) ?>
                                            <?= $this->Form->select('status', [
                                                'Preparing' => 'Preparing',
                                                'Ready to go' => 'Ready to go',
                                                'Archive' => 'Archive',
                                                'Failed' => 'Failed'
                                            ], [
                                                'class' => 'form-select',
                                                'value' => $event->status ?? 'Preparing'
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Organization (optional) -->
                                <div class="mb-3">
                                    <?= $this->Form->label('organisation_id', 'Organization', ['class' => 'form-label']) ?>
                                    <?= $this->Form->select('organisation_id', $organisations, [
                                        'class' => 'form-select',
                                        'empty' => 'Select Organization',
                                        'value' => $event->organisation_id ?? ''
                                    ]) ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Assign Volunteers</label>
                                    <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                        <?php foreach ($volunteers ?? [] as $volunteer): ?>
                                            <div class="form-check">
                                                <?= $this->Form->checkbox('volunteer_ids[]', [
                                                    'value' => $volunteer->id,
                                                    'id' => 'volunteer_' . $volunteer->id,
                                                    'class' => 'form-check-input'
                                                ]) ?>
                                                <label class="form-check-label" for="volunteer_<?= $volunteer->id ?>">
                                                    <?= h($volunteer->first_name . ' ' . $volunteer->last_name) ?>
                                                    <span class="badge bg-<?= $volunteer->status === 'active' ? 'success' : ($volunteer->status === 'hired' ? 'primary' : 'secondary'); ?> ms-2">
                                                        <?= h(ucfirst($volunteer->status ?? 'inactive')) ?>
                                                    </span>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <small class="form-text text-muted">Select volunteers to assign to this event</small>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Add Event
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

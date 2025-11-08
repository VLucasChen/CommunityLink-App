<?php
/**
 * Add Organisation - A5 layout (matches Events/Volunteers pages)
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organisation $organisation
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Organisation - CommunityLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        html, body { height: 100%; margin: 0; }
        .container-fluid { height: 100%; display: flex; flex-direction: column; }
        .row { display: flex; flex: 1; min-height: 0; align-items: stretch; }
        .col-md-3, .col-lg-2 { display: flex; flex-direction: column; }
        .sidebar { background:#343a40; width:250px; display:flex; flex-direction:column; min-height:100%; }
        .sidebar .nav-link { color:#adb5bd; padding:0.75rem 1rem; border-radius:0.375rem; margin:0.25rem 0; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color:#fff; background:#495057; }
        .sidebar .nav-link i { width:20px; margin-right:10px; }
        .main-content { padding:20px; flex:1; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Inline sidebar for consistency -->
        <div class="col-md-3 col-lg-2 px-0">
            <div class="sidebar p-3">
                <div class="text-center mb-4">
                    <h4 class="text-white"><i class="fas fa-hands-helping me-2"></i>CommunityLink</h4>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'index']) ?>"><i class="fas fa-calendar-alt"></i>Events</a>
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Volunteers', 'action' => 'index']) ?>"><i class="fas fa-users"></i>Volunteers</a>
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'VolunteerSignups', 'action' => 'index']) ?>"><i class="fas fa-user-plus"></i>Volunteer Signups</a>
                    <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Organisations', 'action' => 'index']) ?>"><i class="fas fa-handshake"></i>Organizations</a>
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'ContactMessages', 'action' => 'index']) ?>"><i class="fas fa-envelope"></i>Messages</a>
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>"><i class="fas fa-user-cog"></i>Users</a>
                    <hr class="text-muted">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </nav>
            </div>
        </div>
        <div class="col-md-9 col-lg-10">
            <div class="main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Add Organisation</h1>
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Organisations
                    </a>
                </div>

                <?= $this->Flash->render() ?>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Organisation Details</h5>
                    </div>
                    <div class="card-body">
                        <?= $this->Form->create($organisation) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <?= $this->Form->label('org_name', 'Business Name *', ['class' => 'form-label']) ?>
                                    <?= $this->Form->text('org_name', ['class' => 'form-control', 'required' => true]) ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <?= $this->Form->label('industry', 'Industry *', ['class' => 'form-label']) ?>
                                    <?= $this->Form->text('industry', ['class' => 'form-control', 'required' => true]) ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <?= $this->Form->label('business_address', 'Business Address *', ['class' => 'form-label']) ?>
                            <?= $this->Form->textarea('business_address', ['class' => 'form-control', 'rows' => 2, 'required' => true]) ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <?= $this->Form->label('contact_person_full_name', 'Contact Person Full Name *', ['class' => 'form-label']) ?>
                                    <?= $this->Form->text('contact_person_full_name', ['class' => 'form-control', 'required' => true]) ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <?= $this->Form->label('email', 'Email *', ['class' => 'form-label']) ?>
                                    <?= $this->Form->email('email', ['class' => 'form-control', 'required' => true]) ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <?= $this->Form->label('phone', 'Phone *', ['class' => 'form-label']) ?>
                                    <?= $this->Form->text('phone', ['class' => 'form-control', 'required' => true]) ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <?= $this->Form->label('help_description', 'What They Can Help With *', ['class' => 'form-label']) ?>
                            <?= $this->Form->textarea('help_description', ['class' => 'form-control', 'rows' => 4, 'required' => true]) ?>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Add Organisation</button>
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

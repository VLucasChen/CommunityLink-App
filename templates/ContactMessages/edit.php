<?php
/**
 * Edit Message - A5 admin layout
 * Allows toggling status and sending a reply
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactMessage $contactMessage
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Message - CommunityLink</title>
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
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Organisations', 'action' => 'index']) ?>"><i class="fas fa-handshake"></i>Organizations</a>
                    <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'ContactMessages', 'action' => 'index']) ?>"><i class="fas fa-envelope"></i>Messages</a>
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>"><i class="fas fa-user-cog"></i>Users</a>
                    <hr class="text-muted">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </nav>
            </div>
        </div>
        <div class="col-md-9 col-lg-10">
            <div class="main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Edit Message</h1>
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Messages
                    </a>
                </div>

                <?= $this->Flash->render() ?>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Update Status</h5>
                    </div>
                    <div class="card-body">
                        <?= $this->Form->create(null, ['url' => ['action' => 'edit', $contactMessage->id]]) ?>
                            <?= $this->Form->hidden('action', ['value' => 'status']) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?= $this->Form->label('is_replied', 'Status', ['class' => 'form-label']) ?>
                                        <?= $this->Form->select('is_replied', [0 => 'Unreplied', 1 => 'Replied'], [
                                            'class' => 'form-select',
                                            'value' => (int)$contactMessage->is_replied
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Status</button>
                        <?= $this->Form->end() ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Reply</h5>
                    </div>
                    <div class="card-body">
                        <?= $this->Form->create(null, ['url' => ['action' => 'edit', $contactMessage->id]]) ?>
                            <?= $this->Form->hidden('action', ['value' => 'reply']) ?>
                            <div class="mb-3">
                                <?= $this->Form->label('reply_body', 'Message', ['class' => 'form-label']) ?>
                                <?= $this->Form->textarea('reply_body', ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Type your reply to the sender...']) ?>
                                <small class="text-muted">From: admin@communitylink.com (automatically used)</small>
                            </div>
                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane me-2"></i>Send Reply</button>
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

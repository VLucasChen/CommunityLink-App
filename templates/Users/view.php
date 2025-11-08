<?php
/**
 * View User - A5 admin layout matching Events/Volunteers
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User - CommunityLink</title>
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
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'ContactMessages', 'action' => 'index']) ?>"><i class="fas fa-envelope"></i>Messages</a>
                    <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>"><i class="fas fa-user-cog"></i>Users</a>
                    <hr class="text-muted">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </nav>
            </div>
        </div>
        <div class="col-md-9 col-lg-10">
            <div class="main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Users Management</h1>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">User Details</h5>
                        <div class="d-flex gap-2">
                            <a href="<?= $this->Url->build(['action' => 'edit', $user->id]) ?>" class="btn btn-warning"><i class="fas fa-edit me-2"></i>Edit</a>
                            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user me-2 text-dark"></i>
                                        <div class="fw-semibold text-dark">Username</div>
                                    </div>
                                    <div class="mt-1"><?= h($user->username) ?></div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-shield me-2 text-dark"></i>
                                        <div class="fw-semibold text-dark">Role</div>
                                    </div>
                                    <?php
                                        $role = strtolower((string)$user->role);
                                        $badge = $role === 'admin' ? 'danger' : ($role === 'assistant' ? 'primary' : 'success');
                                    ?>
                                    <div class="mt-1"><span class="badge bg-<?= $badge ?>"><?= h(ucfirst($role)) ?></span></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-lock me-2 text-dark"></i>
                                        <div class="fw-semibold text-dark">Password</div>
                                    </div>
                                    <div class="mt-1">•••••••• (Hidden for security)</div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar me-2 text-dark"></i>
                                        <div class="fw-semibold text-dark">Created Date</div>
                                    </div>
                                    <div class="mt-1"><?= $user->created ? h($user->created->format('l, F j, Y \a\t g:i A')) : 'N/A' ?></div>
                                </div>
                            </div>
                        </div>

                        <?php if ($user->has('volunteer') && $user->volunteer): ?>
                            <?php
                                $pic = (string)($user->volunteer->profile_picture ?? '');
                                $picFile = str_starts_with($pic, 'volunteer_profiles/') ? substr($pic, strlen('volunteer_profiles/')) : $pic;
                                $imgPath = $this->Url->build('/img/volunteer_profiles/' . h($picFile));
                                $doc = (string)($user->volunteer->documents ?? '');
                                if ($doc) { $doc = str_replace('volunteer_documents/', '', $doc); }
                            ?>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-id-card me-2 text-dark"></i>
                                        <div class="fw-semibold text-dark">Volunteer</div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php if ($picFile): ?>
                                            <img src="<?= $imgPath ?>" alt="Profile" class="rounded-circle" style="width:48px;height:48px;object-fit:cover;">
                                        <?php else: ?>
                                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div><?= h($user->volunteer->first_name . ' ' . $user->volunteer->last_name) ?></div>
                                            <div class="text-muted small"><i class="fas fa-envelope me-1"></i><?= h($user->volunteer->email ?? '') ?></div>
                                            <?php if (!empty($doc)): ?>
                                                <div class="mt-1">
                                                    <a href="<?= $this->Url->build('/volunteer_documents/' . h($doc)) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-file-pdf me-1"></i>View Documents
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->Identity && $this->Identity->isLoggedIn() && (string)$this->Identity->get('id') === (string)$user->id): ?>
                            <div class="alert alert-info d-flex align-items-center mt-2" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>This is your current user account.</div>
                            </div>
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
<?php
/**
 * Volunteer Signup Details (A5, aligned with Volunteers view layout)
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VolunteerSignup $volunteerSignup
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Application - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
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
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Volunteers', 'action' => 'index']) ?>">
                            <i class="fas fa-users"></i>Volunteers
                        </a>
                        <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'VolunteerSignups', 'action' => 'index']) ?>">
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
                        <h1>Volunteer Application</h1>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-warning" onclick="showStatusModal('<?= $volunteerSignup->id ?>', '<?= h($volunteerSignup->status) ?>')">
                                <i class="fas fa-edit me-2"></i>Edit
                            </button>
                            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <?php
                                    $sp = $volunteerSignup->profile_picture ?? '';
                                    if ($sp) {
                                        $sp = str_replace('volunteer_profiles/', '', $sp);
                                        $sp = str_replace('img/volunteer_profiles/', '', $sp);
                                    }
                                    $spPath = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS . $sp;
                                    if ($sp && file_exists($spPath)):
                                    ?>
                                        <img src="<?= $this->Url->build('/img/volunteer_profiles/' . $sp) ?>" class="profile-picture mb-3" alt="Profile">
                                    <?php else: ?>
                                        <div class="profile-picture bg-secondary d-flex align-items-center justify-content-center mx-auto mb-3">
                                            <i class="fas fa-user fa-3x text-white"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <?php
                                        $statusColors = ['pending'=>'warning','hired'=>'success','declined'=>'danger'];
                                        $statusColor = $statusColors[$volunteerSignup->status] ?? 'secondary';
                                        ?>
                                        <span class="badge bg-<?= $statusColor ?> fs-6"><?= h(ucfirst($volunteerSignup->status)) ?></span>
                                    </div>
                                    <div class="small text-muted mb-3">
                                        <i class="fas fa-calendar me-2"></i>Submitted: <?= $volunteerSignup->created ? h($volunteerSignup->created->format('M j, Y')) : 'N/A' ?>
                                    </div>
                                    <?php if ($volunteerSignup->documents): ?>
                                        <a class="btn btn-sm btn-outline-primary" target="_blank" href="<?= $this->Url->build('/volunteer_documents/' . $volunteerSignup->documents) ?>">
                                            <i class="fas fa-file-pdf me-2"></i>View Document
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="mb-3"><i class="fas fa-user me-2"></i>Personal Information</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <i class="fas fa-user me-2 text-muted"></i><strong>Name:</strong> <?= h($volunteerSignup->first_name . ' ' . $volunteerSignup->last_name) ?>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <i class="fas fa-envelope me-2 text-muted"></i><strong>Email:</strong> <?= h($volunteerSignup->email) ?>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <i class="fas fa-phone me-2 text-muted"></i><strong>Phone:</strong> <?= h($volunteerSignup->phone) ?>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <i class="fas fa-calendar me-2 text-muted"></i><strong>Date Submitted:</strong> <?= $volunteerSignup->date_submitted ? h($volunteerSignup->date_submitted->format('M j, Y')) : 'N/A' ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="mb-3"><i class="fas fa-tools me-2"></i>Skills & Availability</h5>
                                    <div class="mb-3">
                                        <strong>Skills:</strong>
                                        <p class="mb-0"><?= $volunteerSignup->skills ? h($volunteerSignup->skills) : '<span class="text-muted">N/A</span>' ?></p>
                                    </div>
                                    <div class="mb-0">
                                        <strong>Availability:</strong>
                                        <p class="mb-0"><?= $volunteerSignup->availability ? h($volunteerSignup->availability) : '<span class="text-muted">N/A</span>' ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-3"><i class="fas fa-comment me-2"></i>Self Introduction</h5>
                                    <div class="border rounded p-3 bg-light">
                                        <?= $volunteerSignup->self_intro ? nl2br(h($volunteerSignup->self_intro)) : '<span class="text-muted">No message provided</span>' ?>
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
    <!-- Status Update Modal (reused from index) -->
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Application Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <?= $this->Form->create(null, ['url' => ['action' => 'updateStatus'], 'id' => 'statusForm']) ?>
                    <div class="modal-body">
                        <input type="hidden" name="signup_id" id="statusSignupId">
                        <div class="mb-3">
                            <label for="status" class="form-label">New Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="hired">Hired</option>
                                <option value="declined">Declined</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <script>
        function showStatusModal(signupId, currentStatus) {
            document.getElementById('statusSignupId').value = signupId;
            document.getElementById('status').value = currentStatus;
            new bootstrap.Modal(document.getElementById('statusModal')).show();
        }
    </script>
</body>
</html>
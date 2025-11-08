<?php
/**
 * Users management page for CommunityLink - A5 CakePHP version
 * Based on A3 users.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 * @var string $search
 */
$currentUser = $this->request->getAttribute('identity');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management - CommunityLink</title>
    
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?= $this->element('admin_sidebar', ['activeLink' => 'users']) ?>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Users Management</h1>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <!-- Users List -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">System Users</h5>
                            <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add New User
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Filters: username and role -->
                            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3 mb-4 align-items-center']) ?>
                                <div class="col-auto" style="max-width: 300px;">
                                    <label for="username" class="visually-hidden">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Filter username" value="<?= h($username ?? '') ?>">
                                </div>
                                <div class="col-auto" style="max-width: 180px;">
                                    <label for="role" class="visually-hidden">Role</label>
                                    <?= $this->Form->select('role', [
                                        '' => 'All roles',
                                        'admin' => 'Admin',
                                        'assistant' => 'Assistant',
                                        'volunteer' => 'Volunteer'
                                    ], [
                                        'class' => 'form-select',
                                        'id' => 'role',
                                        'value' => $role ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                                    <?php if (($username ?? '') || ($role ?? '')): ?>
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary ms-2">Clear</a>
                                    <?php endif; ?>
                                </div>
                            <?= $this->Form->end() ?>
                            
                            <?php 
                                $usersArray = is_iterable($users) ? $users->toArray() : (array)$users;
                                $hasUsers = !empty($usersArray);
                                $hasFilters = ($username ?? '') || ($role ?? '');
                            ?>
                            <?php if (!$hasUsers): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5>No users found</h5>
                                    <p class="text-muted"><?= $hasFilters ? 'Try adjusting your search terms.' : 'Get started by adding your first user.'; ?></p>
                                </div>
                            <?php else: ?>
    <div class="table-responsive">
                                    <table class="table table-striped">
            <thead>
                <tr>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Volunteer</th>
                                                <th>Created</th>
                                                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                                            <?php foreach ($users as $u): ?>
                                                <tr>
                                                    <td>
                                                        <strong><?= h($u->username) ?></strong>
                                                        <?php if ($currentUser && $u->id === $currentUser->getIdentifier()): ?>
                                                            <span class="badge bg-primary ms-2">Current User</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $role = strtolower((string)$u->role);
                                                            $badge = $role === 'admin' ? 'danger' : ($role === 'assistant' ? 'primary' : 'success');
                                                        ?>
                                                        <span class="badge bg-<?= $badge ?>"><?= h(ucfirst($role)) ?></span>
                                                    </td>
                                                    <td>
                                                        <?php if ($u->has('volunteer') && $u->volunteer): ?>
                                                            <?= h($u->volunteer->first_name . ' ' . $u->volunteer->last_name) ?>
                                                        <?php else: ?>
                                                            <span class="text-muted">-</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $u->created ? h($u->created->format('M j, Y')) : 'N/A' ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="<?= $this->Url->build(['action' => 'view', $u->id]) ?>" class="btn btn-sm btn-outline-primary" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="<?= $this->Url->build(['action' => 'edit', $u->id]) ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <?php if (!$currentUser || $u->id !== $currentUser->getIdentifier()): ?>
                        <?= $this->Form->postLink(
                                                                    '<i class="fas fa-trash"></i>',
                                                                    ['action' => 'delete', $u->id],
                                                                    [
                                                                        'class' => 'btn btn-sm btn-outline-danger',
                                                                        'confirm' => __('Are you sure you want to delete the user "{0}"?', h($u->username)),
                                                                        'escape' => false,
                                                                        'title' => 'Delete'
                                                                    ]
                                                                ) ?>
                                                            <?php endif; ?>
                                                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
                                
                                <!-- A5 Requirement: Server-side pagination using CakePHP Paginator -->
                                <nav aria-label="Users pagination" class="mt-3">
                                    <?php 
                                        $paging = $this->getRequest()->getAttribute('paging') ?? [];
                                        $pg = $paging['Users'] ?? (function($arr){ foreach ($arr as $v) { return $v; } return []; })($paging);
                                        $pageCount = $pg['pageCount'] ?? null;
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
                                            ],
                                            'model' => 'Users'
                                        ]) ?>
                                        <?php if ($pageCount === null || $pageCount === 1): ?>
                                            <li class="page-item active"><span class="page-link">1</span></li>
                                        <?php else: ?>
                                            <?= $this->Paginator->numbers([
                                                'separator' => '',
                                                'templates' => [
                                                    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                                    'current' => '<li class="page-item active"><span class="page-link">{{text}}</span></li>'
                                                ],
                                                'model' => 'Users'
                                            ]) ?>
                                        <?php endif; ?>
                                            <?= $this->Paginator->next(__('Next'), [
                                            'templates' => [
                                                'nextActive' => '<li class="page-item"><a class="page-link" rel="next" href="{{url}}">{{text}}</a></li>',
                                                'nextDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>'
                                            ],
                                            'model' => 'Users'
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

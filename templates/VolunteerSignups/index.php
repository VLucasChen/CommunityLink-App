<?php
/**
 * Volunteer signups management page for CommunityLink - A5 CakePHP version
 * Based on A3 volunteer-signups.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\VolunteerSignup> $volunteerSignups
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
    <title>Volunteer Signups Management - CommunityLink</title>
    
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
        .table thead th { vertical-align: middle; }
        .status-badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?= $this->element('admin_sidebar', ['activeLink' => 'volunteer-signups']) ?>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Volunteer Signups Management</h1>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <!-- Volunteer Signups List -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Volunteer Applications</h5>
                        </div>
                        <div class="card-body">
                            <!-- Search and Filters (follow Volunteers/Events style) -->
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
                                        '' => 'All statuses',
                                        'pending' => 'Pending',
                                        'hired' => 'Hired',
                                        'declined' => 'Declined'
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
                                    <button type="submit" class="btn btn-outline-primary me-2">Filter</button>
                                    <?php if (($search ?? '') || ($status ?? '') || ($skills ?? '') || ($availability ?? '')): ?>
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary">Clear</a>
                                    <?php endif; ?>
                                </div>
                            <?= $this->Form->end() ?>

                            <?php 
                                // Empty-state logic: only show when filters applied or DB truly empty
                                $signupsArray = is_iterable($volunteerSignups) ? $volunteerSignups->toArray() : (array)$volunteerSignups;
                                $hasSignups = !empty($signupsArray);
                                $hasFilters = ($search ?? '') || ($status ?? '') || ($skills ?? '') || ($availability ?? '');
                                $showEmpty = !$hasSignups; 
                            ?>
                            
                            <?php if ($showEmpty): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No volunteer signups found</h5>
                                    <p class="text-muted"><?= $hasFilters ? 'Try adjusting your search terms.' : 'Get started by collecting your first signup.'; ?></p>
                                </div>
                            <?php else: ?>
    <div class="table-responsive">
                                    <table class="table table-striped table-hover">
            <thead>
                <tr>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th style="min-width: 230px;">Contact</th>
                                                <th style="min-width: 220px;">Skills</th>
                                                <th style="max-width: 140px;">Availability</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                                            <?php foreach ($volunteerSignups as $signup): ?>
                                                <tr>
                                                    <td>
                                                        <?php 
                                                        $sp = $signup->profile_picture ?? '';
                                                        if ($sp) {
                                                            $sp = str_replace('volunteer_profiles/', '', $sp);
                                                            $sp = str_replace('img/volunteer_profiles/', '', $sp);
                                                        }
                                                        $spPath = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS . $sp;
                                                        if ($sp && file_exists($spPath)): ?>
                                                            <img src="<?= $this->Url->build('/img/volunteer_profiles/' . $sp) ?>" 
                                                                 alt="Profile" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                                        <?php else: ?>
                                                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                                                 style="width: 40px; height: 40px;">
                                                                <i class="fas fa-user text-white"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <strong><?= h($signup->first_name . ' ' . $signup->last_name) ?></strong>
                                                    </td>
                                                    <td>
                                                        <div class="text-truncate"><i class="fas fa-envelope me-2"></i><span class="align-middle"><?= h($signup->email) ?></span></div>
                                                        <div class="text-truncate"><i class="fas fa-phone me-2"></i><span class="align-middle"><?= h($signup->phone) ?></span></div>
                                                    </td>
                                                    <td>
                                                        <?php if ($signup->skills): ?>
                                                            <small><?= h(mb_substr($signup->skills, 0, 120)) . (mb_strlen($signup->skills) > 120 ? '...' : '') ?></small>
                                                        <?php else: ?>
                                                            <span class="text-muted">No skills listed</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="max-width:140px;">
                                                        <?php if ($signup->availability): ?>
                                                            <small><?= h(mb_substr($signup->availability, 0, 40)) . (mb_strlen($signup->availability) > 40 ? '...' : '') ?></small>
                                                        <?php else: ?>
                                                            <span class="text-muted">N/A</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $statusColors = [
                                                            'pending' => 'warning',
                                                            'hired' => 'success',
                                                            'declined' => 'danger'
                                                        ];
                                                        $statusColor = $statusColors[$signup->status] ?? 'secondary';
                                                        ?>
                                                        <span class="badge bg-<?= $statusColor ?>">
                                                            <?= h(ucfirst($signup->status)) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <small><?= $signup->created ? h($signup->created->format('M j, Y')) : 'N/A' ?></small>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a href="<?= $this->Url->build(['action' => 'view', $signup->id]) ?>" 
                                                               class="btn btn-outline-primary" title="View Details">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-outline-warning" 
                                                                    onclick="showStatusModal('<?= $signup->id ?>', '<?= $signup->status ?>')" 
                                                                    title="Update Status">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                        <?= $this->Form->postLink(
                                                                '<i class="fas fa-trash"></i>',
                                                                ['action' => 'delete', $signup->id],
                                                                [
                                                                    'class' => 'btn btn-outline-danger',
                                                                    'confirm' => __('Are you sure you want to delete this volunteer application? This action cannot be undone.'),
                                                                    'escape' => false,
                                                                    'title' => 'Delete'
                                                                ]
                                                            ) ?>
                                                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
                                
                                <!-- Server-side pagination using CakePHP Paginator -->
                                <nav aria-label="Signups pagination" class="mt-3">
                                    <?php 
                                        $paging = $this->getRequest()->getAttribute('paging') ?? [];
                                        $firstModel = function($arr){ foreach ($arr as $k => $_) { return $k; } return null; };
                                        $modelKey = $firstModel($paging);
                                        $pg = $modelKey && isset($paging[$modelKey]) ? $paging[$modelKey] : [];
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
                                        <?php if (($pg['pageCount'] ?? 1) === 1): ?>
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

    <!-- Status Update Modal (A3 logic preserved) -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function showStatusModal(signupId, currentStatus) {
            document.getElementById('statusSignupId').value = signupId;
            document.getElementById('status').value = currentStatus;
            new bootstrap.Modal(document.getElementById('statusModal')).show();
        }
    </script>
</body>
</html>

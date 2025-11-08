<?php
/**
 * Organizations management page for CommunityLink - A5 CakePHP version
 * Based on A3 organisations.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Organisation> $organisations
 * @var string $search
 * @var string $industry
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizations Management - CommunityLink</title>
    
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
            <?= $this->element('admin_sidebar', ['activeLink' => 'organisations']) ?>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Organizations Management</h1>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <!-- Organizations List -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Organizations</h5>
                            <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add New Organization
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Filters (compact, no labels) -->
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
                                <div class="col-auto" style="max-width: 180px;">
                                    <label for="industry" class="visually-hidden">Industry</label>
                                    <?= $this->Form->text('industry', [
                                        'class' => 'form-control',
                                        'id' => 'industry',
                                        'placeholder' => 'Filter industry',
                                        'value' => $industry ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto" style="max-width: 220px;">
                                    <label for="description" class="visually-hidden">Description</label>
                                    <?= $this->Form->text('description', [
                                        'class' => 'form-control',
                                        'id' => 'description',
                                        'placeholder' => 'Filter description',
                                        'value' => $description ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary me-2">Filter</button>
                                    <?php if (($search ?? '') || ($industry ?? '') || ($description ?? '')): ?>
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary">Clear</a>
                                    <?php endif; ?>
                                </div>
                            <?= $this->Form->end() ?>
                            
                            <?php 
                                // Convert pagination set to array for reliable emptiness check
                                $orgArray = is_iterable($organisations) ? $organisations->toArray() : (array)$organisations;
                                $hasOrgs = !empty($orgArray);
                                $hasFilters = ($search ?? '') || ($industry ?? '') || ($description ?? '');
                            ?>
                            <?php if (!$hasOrgs): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-building fa-3x text-muted mb-3"></i>
                                    <h5>No organizations found</h5>
                                    <p class="text-muted"><?= $hasFilters ? 'Try adjusting your search terms.' : 'Get started by adding your first organization.'; ?></p>
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Organization Name</th>
                                                <th>Contact Person</th>
                                                <th style="min-width: 300px;">Contact Information</th>
                                                <th>Industry</th>
                                                <th style="min-width: 260px;">Help Description</th>
                                                <th>Events</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($organisations as $org): ?>
                                                <tr>
                                                    <td>
                                                        <strong><?= h($org->org_name) ?></strong>
                                                    </td>
                                                    <td><?= h($org->contact_person_full_name) ?></td>
                                                    <td>
                                                        <div><i class="fas fa-envelope me-2"></i><?= h($org->email) ?></div>
                                                        <div><i class="fas fa-phone me-2"></i><?= h($org->phone) ?></div>
                                                    </td>
                                                    <td><?= h($org->industry) ?></td>
                                                    <td>
                                                        <?php if ($org->help_description): ?>
                                                            <small><?= h(mb_substr($org->help_description, 0, 120)) . (mb_strlen($org->help_description) > 120 ? '...' : '') ?></small>
                                                        <?php else: ?>
                                                            <span class="text-muted">N/A</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info"><?= count($org->events ?? []) ?> events</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="<?= $this->Url->build(['action' => 'view', $org->id]) ?>" class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="<?= $this->Url->build(['action' => 'edit', $org->id]) ?>" class="btn btn-sm btn-outline-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <?= $this->Form->postLink(
                                                                '<i class="fas fa-trash"></i>',
                                                                ['action' => 'delete', $org->id],
                                                                [
                                                                    'class' => 'btn btn-sm btn-outline-danger',
                                                                    'confirm' => __('Are you sure you want to delete the organization "{0}"?', h($org->org_name)),
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
                                
                                <!-- Server-side pagination using CakePHP Paginator -->
                                <nav aria-label="Organisations pagination" class="mt-3">
                                    <?php 
                                        $paging = $this->getRequest()->getAttribute('paging') ?? [];
                                        $pg = $paging['Organisations'] ?? [];
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

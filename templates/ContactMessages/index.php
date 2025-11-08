<?php
/**
 * Messages management page for CommunityLink - A5 CakePHP version
 * Based on A3 messages.php, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ContactMessage> $contactMessages
 * @var string $search
 * @var string $status_filter
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages Management - CommunityLink</title>
    
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
        .message-preview {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?= $this->element('admin_sidebar', ['activeLink' => 'messages']) ?>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Messages Management</h1>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <!-- Messages List -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Contact Form Messages</h5>
                        </div>
                        <div class="card-body">
                            <!-- Filters: sender and message -->
                            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3 mb-4 align-items-center']) ?>
                                <div class="col-auto" style="max-width: 280px;">
                                    <label for="sender" class="visually-hidden">Sender</label>
                                    <?= $this->Form->text('sender', [
                                        'class' => 'form-control',
                                        'id' => 'sender',
                                        'placeholder' => 'Filter sender',
                                        'value' => $sender ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto" style="max-width: 360px;">
                                    <label for="message" class="visually-hidden">Message</label>
                                    <?= $this->Form->text('message', [
                                        'class' => 'form-control',
                                        'id' => 'message',
                                        'placeholder' => 'Filter message',
                                        'value' => $messageFilter ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto" style="max-width: 180px;">
                                    <label for="status" class="visually-hidden">Status</label>
                                    <?= $this->Form->select('status', [
                                        '' => 'All messages',
                                        'unreplied' => 'Unreplied',
                                        'replied' => 'Replied'
                                    ], [
                                        'class' => 'form-select',
                                        'id' => 'status',
                                        'value' => $status_filter ?? ''
                                    ]) ?>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary me-2">Filter</button>
                                    <?php if (($sender ?? '') || ($messageFilter ?? '') || ($status_filter ?? '')): ?>
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary">Clear</a>
                                    <?php endif; ?>
                                </div>
                            <?= $this->Form->end() ?>
                            
                            <?php 
                                $msgsArray = is_iterable($contactMessages) ? $contactMessages->toArray() : (array)$contactMessages;
                                $hasMsgs = !empty($msgsArray);
                                $hasFilters = ($sender ?? '') || ($messageFilter ?? '') || ($status_filter ?? '');
                            ?>
                            <?php if (!$hasMsgs): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-envelope fa-3x text-muted mb-3"></i>
                                    <h5>No messages found</h5>
                                    <p class="text-muted"><?= $hasFilters ? 'Try adjusting your search terms.' : 'No contact form submissions yet.'; ?></p>
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>From</th>
                                                <th>Contact Info</th>
                                                <th>Message Preview</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($contactMessages as $msg): ?>
                                                <tr>
                                                    <td>
                                                        <strong><?= h($msg->first_name . ' ' . $msg->last_name) ?></strong>
                                                    </td>
                                                    <td>
                                                        <div><i class="fas fa-envelope me-2"></i><?= h($msg->email) ?></div>
                                                        <div><i class="fas fa-phone me-2"></i><?= h($msg->phone) ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="message-preview" title="<?= h($msg->message) ?>">
                                                            <?= h(substr($msg->message, 0, 100)) . (strlen($msg->message) > 100 ? '...' : '') ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php if ($msg->is_replied): ?>
                                                            <span class="badge bg-success">Replied</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-warning">Unreplied</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $msg->created ? h($msg->created->format('M j, Y H:i')) : 'N/A' ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="<?= $this->Url->build(['action' => 'view', $msg->id]) ?>" class="btn btn-sm btn-outline-primary" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="<?= $this->Url->build(['action' => 'edit', $msg->id]) ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <?= $this->Form->postLink(
                                                                '<i class="fas fa-trash"></i>',
                                                                ['action' => 'delete', $msg->id],
                                                                [
                                                                    'class' => 'btn btn-sm btn-outline-danger',
                                                                    'confirm' => __('Are you sure you want to delete the message from "{0}"?', h($msg->first_name . ' ' . $msg->last_name)),
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
                                <nav aria-label="Messages pagination" class="mt-3">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

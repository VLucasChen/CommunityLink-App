<?php
/**
 * View Contact Message page for CommunityLink - A5 CakePHP version
 * Based on A3 messages.php view, adapted for CakePHP with same Bootstrap styling
 * 
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactMessage $contactMessage
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message - CommunityLink</title>
    
    <!-- Bootstrap CSS (same version as A3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons (same as A3) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            width: 250px;
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
                    <div class="mb-3">
                        <h1>Message from <?= h($contactMessage->first_name . ' ' . $contactMessage->last_name) ?></h1>
                    </div>
                    
                    <?= $this->Flash->render() ?>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Message Details</h5>
                                    <div>
                                        <?= $this->Html->link('<i class="fas fa-edit me-2"></i>Edit', ['action' => 'edit', $contactMessage->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Back to Messages</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="30%">Name</th>
                                            <td><?= h($contactMessage->first_name . ' ' . $contactMessage->last_name) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><i class="fas fa-envelope me-1"></i><?= h($contactMessage->email) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td><i class="fas fa-phone me-1"></i><?= h($contactMessage->phone) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Received</th>
                                            <td>
                                                <i class="fas fa-calendar me-1"></i>
                                                <?= $contactMessage->created ? h($contactMessage->created->format('l, F j, Y \a\t g:i A')) : 'N/A' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <?php if ($contactMessage->is_replied): ?>
                                                    <span class="badge bg-success">Replied</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning">Unreplied</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-comment me-2"></i>Message</h5>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded p-3 bg-light">
                                        <?= $this->Text->autoParagraph(h($contactMessage->message)) ?>
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
</body>
</html>

<?php
/**
 * Edit Volunteer Signup (admin) - aligned to Volunteers edit layout
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VolunteerSignup $volunteerSignup
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Volunteer Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar { background:#343a40; width:250px; min-height:100%; }
        .profile-picture { width:100px; height:100px; object-fit:cover; border-radius:50%; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?= $this->element('admin_sidebar', ['activeLink' => 'volunteer-signups']) ?>
        <div class="col-md-9 col-lg-10">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Edit Volunteer Application</h1>
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <?= $this->Flash->render() ?>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Update Status</h5>
                    </div>
                    <div class="card-body">
                        <?= $this->Form->create($volunteerSignup, ['url' => ['action' => 'edit', $volunteerSignup->id]]) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?= $this->Form->label('status', 'Status', ['class' => 'form-label']) ?>
                                        <?= $this->Form->select('status', ['pending' => 'Pending', 'hired' => 'Hired', 'declined' => 'Declined'], ['class' => 'form-select', 'value' => $volunteerSignup->status]) ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Status</button>
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

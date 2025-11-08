<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Dashboard</h1>
        <p class="lead">Welcome, <?= h($user->username) ?>!</p>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Events Card -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white rounded-circle p-3 me-3">
                        <i class="bi bi-calendar-event fs-4"></i>
                    </div>
                    <h5 class="card-title mb-0">Events</h5>
                </div>
                <p class="card-text text-muted">Manage community events and activities</p>
                <?= $this->Html->link('View Events', 
                    ['controller' => 'Events', 'action' => 'index'], 
                    ['class' => 'btn btn-primary']
                ) ?>
            </div>
        </div>
    </div>

    <!-- Organisations Card -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success text-white rounded-circle p-3 me-3">
                        <i class="bi bi-building fs-4"></i>
                    </div>
                    <h5 class="card-title mb-0">Organisations</h5>
                </div>
                <p class="card-text text-muted">Manage partner organisations</p>
                <?= $this->Html->link('View Organisations', 
                    ['controller' => 'Organisations', 'action' => 'index'], 
                    ['class' => 'btn btn-success']
                ) ?>
            </div>
        </div>
    </div>

    <!-- Volunteers Card -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-info text-white rounded-circle p-3 me-3">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <h5 class="card-title mb-0">Volunteers</h5>
                </div>
                <p class="card-text text-muted">Manage volunteer registrations</p>
                <?= $this->Html->link('View Volunteers', 
                    ['controller' => 'Volunteers', 'action' => 'index'], 
                    ['class' => 'btn btn-info']
                ) ?>
            </div>
        </div>
    </div>

    <!-- Volunteer Signups Card -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning text-white rounded-circle p-3 me-3">
                        <i class="bi bi-person-plus fs-4"></i>
                    </div>
                    <h5 class="card-title mb-0">Volunteer Signups</h5>
                </div>
                <p class="card-text text-muted">Review new volunteer applications</p>
                <?= $this->Html->link('View Signups', 
                    ['controller' => 'VolunteerSignups', 'action' => 'index'], 
                    ['class' => 'btn btn-warning']
                ) ?>
            </div>
        </div>
    </div>

    <!-- Contact Messages Card -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-secondary text-white rounded-circle p-3 me-3">
                        <i class="bi bi-envelope fs-4"></i>
                    </div>
                    <h5 class="card-title mb-0">Contact Messages</h5>
                </div>
                <p class="card-text text-muted">View and respond to contact messages</p>
                <?= $this->Html->link('View Messages', 
                    ['controller' => 'ContactMessages', 'action' => 'index'], 
                    ['class' => 'btn btn-secondary']
                ) ?>
            </div>
        </div>
    </div>

    <!-- Users Card (Admin only) -->
    <?php if ($user->role === 'admin'): ?>
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-dark text-white rounded-circle p-3 me-3">
                        <i class="bi bi-person-gear fs-4"></i>
                    </div>
                    <h5 class="card-title mb-0">Users</h5>
                </div>
                <p class="card-text text-muted">Manage system users</p>
                <?= $this->Html->link('View Users', 
                    ['controller' => 'Users', 'action' => 'index'], 
                    ['class' => 'btn btn-dark']
                ) ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="d-flex flex-wrap gap-2">
                    <?= $this->Html->link('Create New Event', 
                        ['controller' => 'Events', 'action' => 'add'], 
                        ['class' => 'btn btn-outline-primary']
                    ) ?>
                    <?= $this->Html->link('Add Organisation', 
                        ['controller' => 'Organisations', 'action' => 'add'], 
                        ['class' => 'btn btn-outline-success']
                    ) ?>
                    <?= $this->Html->link('Logout', 
                        ['controller' => 'Users', 'action' => 'logout'], 
                        ['class' => 'btn btn-outline-danger']
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>


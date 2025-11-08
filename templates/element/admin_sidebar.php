<?php
/**
 * Admin Sidebar Element - Reusable sidebar matching A3 design
 * 
 * @var \App\View\AppView $this
 * @var string $activeLink Current active page
 */
$activeLink = $activeLink ?? '';
?>
<div class="col-md-3 col-lg-2 px-0">
    <div class="sidebar p-3">
        <div class="text-center mb-4">
            <h4 class="text-white">
                <i class="fas fa-hands-helping me-2"></i>CommunityLink
            </h4>
        </div>
        
        <nav class="nav flex-column">
            <a class="nav-link <?= $activeLink === 'dashboard' ? 'active' : '' ?>" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>">
                <i class="fas fa-tachometer-alt"></i>Dashboard
            </a>
            <a class="nav-link <?= $activeLink === 'events' ? 'active' : '' ?>" href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'index']) ?>">
                <i class="fas fa-calendar-alt"></i>Events
            </a>
            <a class="nav-link <?= $activeLink === 'volunteers' ? 'active' : '' ?>" href="<?= $this->Url->build(['controller' => 'Volunteers', 'action' => 'index']) ?>">
                <i class="fas fa-users"></i>Volunteers
            </a>
            <a class="nav-link <?= $activeLink === 'volunteer-signups' ? 'active' : '' ?>" href="<?= $this->Url->build(['controller' => 'VolunteerSignups', 'action' => 'index']) ?>">
                <i class="fas fa-user-plus"></i>Volunteer Signups
            </a>
            <a class="nav-link <?= $activeLink === 'organisations' ? 'active' : '' ?>" href="<?= $this->Url->build(['controller' => 'Organisations', 'action' => 'index']) ?>">
                <i class="fas fa-handshake"></i>Organizations
            </a>
            <a class="nav-link <?= $activeLink === 'messages' ? 'active' : '' ?>" href="<?= $this->Url->build(['controller' => 'ContactMessages', 'action' => 'index']) ?>">
                <i class="fas fa-envelope"></i>Messages
            </a>
            <a class="nav-link <?= $activeLink === 'users' ? 'active' : '' ?>" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">
                <i class="fas fa-user-cog"></i>Users
            </a>
            <hr class="text-muted">
            <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">
                <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        </nav>
    </div>
</div>



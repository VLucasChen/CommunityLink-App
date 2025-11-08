<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <title>CommunityLink | <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('viewport', 'width=device-width, initial-scale=1') ?>
    <?= $this->Html->css(['https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css','style.css']) ?>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<?php
$currentController = $this->request->getParam('controller');
$currentAction = $this->request->getParam('action');
// Check if user is authenticated - multiple methods
$isAuthenticated = false;

// Method 1: Try Identity helper
if (isset($this->Identity) && method_exists($this->Identity, 'isLoggedIn')) {
    try {
        $isAuthenticated = $this->Identity->isLoggedIn();
    } catch (\Exception $e) {
        // Continue to next method
    }
}

// Method 2: Try request attribute (more reliable)
if (!$isAuthenticated) {
    try {
        $identity = $this->request->getAttribute('identity');
        if ($identity) {
            $isAuthenticated = true;
        }
    } catch (\Exception $e) {
        // Continue
    }
}

// Method 3: Check if Identity helper has data
if (!$isAuthenticated && isset($this->Identity)) {
    try {
        $userId = $this->Identity->get('id');
        if ($userId) {
            $isAuthenticated = true;
        }
    } catch (\Exception $e) {
        // Ignore
    }
}
?>
<style>
    :root {
        --navbar-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --navbar-height: 70px;
        --m3-primary: #6750A4;
    }

    .main-navbar {
        background: var(--navbar-gradient) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 0.75rem 0;
        transition: all 0.3s ease;
    }

    .main-navbar.scrolled {
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
        padding: 0.5rem 0;
    }

    .navbar-brand-custom {
        font-size: 1.5rem;
        font-weight: 700;
        color: white !important;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        padding: 0.5rem 0;
    }

    .navbar-brand-custom:hover {
        transform: translateY(-2px);
        color: white !important;
    }

    .navbar-brand-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .navbar-brand-custom:hover .navbar-brand-icon {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.05);
    }

    .navbar-nav-custom {
        gap: 0.5rem;
    }

    .nav-link-custom {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        padding: 0.625rem 1.25rem !important;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .nav-link-custom::before {
        content: '';
        position: absolute;
        bottom: 0.25rem;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        width: 60%;
        height: 2px;
        background: white;
        border-radius: 2px;
        transition: transform 0.3s ease;
    }

    .nav-link-custom:hover {
        color: white !important;
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
    }

    .nav-link-custom.active {
        color: white !important;
        background: rgba(255, 255, 255, 0.2);
        font-weight: 600;
    }

    .nav-link-custom.active::before {
        transform: translateX(-50%) scaleX(1);
    }

    .navbar-toggler-custom {
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }

    .navbar-toggler-custom:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
    }

    .navbar-toggler-custom:focus {
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
    }

    .navbar-toggler-icon-custom {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .btn-login-nav {
        background: white;
        color: var(--m3-primary);
        border: none;
        padding: 0.625rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-login-nav:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        background: #f8f9fa;
        color: var(--m3-primary);
    }

    .btn-login-nav:active {
        transform: translateY(0);
    }

    .user-menu {
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: white;
        padding: 0.5rem 1rem;
        background: transparent;
        border: none;
        border-radius: 0;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        user-select: none;
    }

    .user-info:hover {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: white;
        flex-shrink: 0;
    }

    .user-avatar i {
        display: block;
        color: white;
    }

    .user-dropdown {
        position: absolute;
        top: calc(100% + 1rem);
        right: 0;
        background: white;
        border-radius: 20px;
        box-shadow: 0 12px 48px rgba(0, 0, 0, 0.15), 0 4px 16px rgba(0, 0, 0, 0.1);
        min-width: 280px;
        padding: 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-15px) scale(0.95);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1000;
        border: 1px solid rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .user-dropdown.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
    }

    .dropdown-header {
        padding: 1.5rem;
        background: white;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .dropdown-header-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
    }

    .dropdown-header-avatar i {
        display: block;
        color: white;
    }

    .dropdown-header-content {
        flex: 1;
    }

    .dropdown-username {
        font-weight: 700;
        color: var(--m3-on-surface);
        font-size: 1rem;
        margin-bottom: 0.5rem;
        letter-spacing: -0.01em;
    }

    .dropdown-role {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.875rem;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .role-badge.admin {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        color: white;
    }

    .role-badge.assistant {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        color: white;
    }

    .role-badge.volunteer {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
    }

    .role-badge.default {
        background: #E5E7EB;
        color: #374151;
    }

    .dropdown-body {
        padding: 0.5rem;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.875rem;
        padding: 0.75rem 1rem;
        color: #1F2937;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.2s ease;
        font-size: 0.9375rem;
        font-weight: 500;
        margin: 0.125rem 0;
        position: relative;
    }

    .dropdown-item span {
        flex: 1;
    }

    .dropdown-item i {
        font-size: 1.125rem;
        width: 24px;
        text-align: center;
        color: #6B7280;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background: #F3F4F6;
        color: #1F2937;
    }

    .dropdown-item:hover i {
        color: #667eea;
    }

    .dropdown-item.danger {
        color: #DC2626;
    }

    .dropdown-item.danger i {
        color: #DC2626;
    }

    .dropdown-item.danger:hover {
        background: #FEE2E2;
        color: #991B1B;
    }

    .dropdown-item.danger:hover i {
        color: #991B1B;
    }

    .dropdown-divider {
        height: 1px;
        background: #E5E7EB;
        margin: 0.5rem 0.75rem;
    }

    @media (max-width: 991px) {
        .navbar-collapse {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-link-custom {
            padding: 0.75rem 1rem !important;
            margin-bottom: 0.25rem;
        }

        .btn-login-nav {
            width: 100%;
            justify-content: center;
            margin-top: 0.5rem;
        }

        .user-menu {
            flex-direction: column;
            width: 100%;
            margin-top: 0.5rem;
            position: relative;
        }

        .user-info {
            width: 100%;
            justify-content: center;
        }

        .user-dropdown {
            position: static;
            width: 100%;
            margin-top: 0.5rem;
            box-shadow: none;
            border: 1px solid var(--m3-surface-variant);
        }
    }

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
</style>

<body class="bg-light">
<nav class="navbar navbar-expand-lg main-navbar sticky-top" id="mainNavbar">
  <div class="container">
    <a class="navbar-brand-custom" href="<?= $this->Url->build(['controller'=>'Public','action'=>'home']) ?>">
      <div class="navbar-brand-icon">
        <i class="bi bi-people-fill"></i>
      </div>
      <span>CommunityLink</span>
    </a>
    
    <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon navbar-toggler-icon-custom"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav navbar-nav-custom ms-auto align-items-center">
        <?php
        // Build navigation links
        $navLinks = [
            ['action' => 'home', 'label' => 'Home', 'icon' => 'bi-house-door'],
            ['action' => 'publicEvents', 'label' => 'Events', 'icon' => 'bi-calendar-event'],
        ];
        
        // Only show Volunteer and Organisation registration links if user is NOT authenticated
        // These links should be hidden when user is logged in (volunteer, admin, or assistant)
        if (!$isAuthenticated) {
            $navLinks[] = ['action' => 'volunteerRegister', 'label' => 'Volunteer', 'icon' => 'bi-person-plus'];
            $navLinks[] = ['action' => 'organisationRegister', 'label' => 'Organisation', 'icon' => 'bi-building'];
        }
        
        // Contact Us is always visible
        $navLinks[] = ['action' => 'contact', 'label' => 'Contact Us', 'icon' => 'bi-envelope'];
        
        foreach ($navLinks as $link):
            $isActive = ($currentController === 'Public' && $currentAction === $link['action']);
        ?>
            <?= $this->Html->link(
                '<i class="bi ' . $link['icon'] . '"></i> ' . $link['label'],
                ['controller' => 'Public', 'action' => $link['action']],
                [
                    'class' => 'nav-link-custom' . ($isActive ? ' active' : ''),
                    'escape' => false
                ]
            ) ?>
        <?php endforeach; ?>
        
        <?php
        // Get user role if authenticated
        $currentUserRole = null;
        if ($isAuthenticated && isset($this->Identity)) {
            try {
                $currentUserRole = $this->Identity->get('role');
            } catch (\Exception $e) {
                // Try alternative method
                try {
                    $identity = $this->request->getAttribute('identity');
                    if ($identity) {
                        if (is_object($identity)) {
                            $currentUserRole = $identity->role ?? null;
                        } elseif (is_array($identity)) {
                            $currentUserRole = $identity['role'] ?? $identity['data']['role'] ?? null;
                        }
                    }
                } catch (\Exception $e2) {
                    // Ignore
                }
            }
        }
        $isVolunteer = strtolower($currentUserRole ?? '') === 'volunteer';
        $isAdminOrAssistant = in_array(strtolower($currentUserRole ?? ''), ['admin', 'assistant']);
        ?>
        <?php if (!$isAuthenticated): ?>
            <?= $this->Html->link(
                '<i class="bi bi-box-arrow-in-right"></i> Login',
                ['controller' => 'Users', 'action' => 'login'],
                ['class' => 'btn-login-nav', 'escape' => false]
            ) ?>
        <?php else: ?>
            <?php
            // Get user info for dropdown
            $username = null;
            $userId = null;
            try {
                if (isset($this->Identity)) {
                    $username = $this->Identity->get('username');
                    $userId = $this->Identity->get('id');
                }
                if (!$username || !$userId) {
                    $identity = $this->request->getAttribute('identity');
                    if ($identity) {
                        if (is_object($identity)) {
                            $username = $identity->username ?? $username;
                            $userId = $identity->id ?? $userId;
                        } elseif (is_array($identity)) {
                            $username = $identity['username'] ?? $identity['data']['username'] ?? $username;
                            $userId = $identity['id'] ?? $identity['data']['id'] ?? $userId;
                        }
                    }
                }
            } catch (\Exception $e) {
                // Ignore
            }
            
            $userRole = strtolower($currentUserRole ?? 'user');
            $roleClass = $userRole;
            $roleLabel = ucfirst($userRole);
            $isAdmin = ($roleClass === 'admin');
            
            // Determine profile link based on role
            $profileLink = ['controller' => 'Public', 'action' => 'home'];
            if ($isVolunteer && $userId) {
                $profileLink = ['controller' => 'Public', 'action' => 'profile', $userId];
            } elseif ($isAdminOrAssistant) {
                $profileLink = ['controller' => 'Pages', 'action' => 'dashboard'];
            } elseif ($userId) {
                $profileLink = ['controller' => 'Public', 'action' => 'profile', $userId];
            }
            ?>
            <div class="user-menu">
                <div class="user-info" id="userInfoToggle">
                    <div class="user-avatar">
                        <?php if ($isAdmin): ?>
                            <i class="bi bi-shield-check-fill"></i>
                        <?php elseif ($roleClass === 'assistant'): ?>
                            <i class="bi bi-person-badge-fill"></i>
                        <?php else: ?>
                            <i class="bi bi-person-fill"></i>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div style="font-weight: 600;"><?= h($username ?? 'User') ?></div>
                        <small style="opacity: 0.8; font-size: 0.8rem;">
                            <?= h($roleLabel) ?>
                        </small>
                    </div>
                </div>
                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-header">
                        <div class="dropdown-header-avatar">
                            <?php if ($isAdmin): ?>
                                <i class="bi bi-shield-check-fill"></i>
                            <?php elseif ($roleClass === 'assistant'): ?>
                                <i class="bi bi-person-badge-fill"></i>
                            <?php else: ?>
                                <i class="bi bi-person-fill"></i>
                            <?php endif; ?>
                        </div>
                        <div class="dropdown-header-content">
                            <div class="dropdown-username"><?= h($username ?? 'User') ?></div>
                            <div class="dropdown-role">
                                <span class="role-badge <?= $roleClass ?>">
                                    <?php if ($isAdmin): ?>
                                        <i class="bi bi-shield-check"></i>
                                    <?php elseif ($roleClass === 'assistant'): ?>
                                        <i class="bi bi-person-badge"></i>
                                    <?php else: ?>
                                        <i class="bi bi-person"></i>
                                    <?php endif; ?>
                                    <?= h($roleLabel) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <?= $this->Html->link(
                            '<i class="bi bi-person-circle"></i> <span>' . ($isAdminOrAssistant ? 'Dashboard' : 'Profile') . '</span>',
                            $profileLink,
                            ['class' => 'dropdown-item', 'escape' => false]
                        ) ?>
                        <div class="dropdown-divider"></div>
                        <?= $this->Html->link(
                            '<i class="bi bi-box-arrow-right"></i> <span>Logout</span>',
                            ['controller' => 'Users', 'action' => 'logout'],
                            ['class' => 'dropdown-item danger', 'escape' => false]
                        ) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<?php
$isHomePage = $this->request->getParam('controller') === 'Public' && $this->request->getParam('action') === 'home';
?>

<?php if (!$isHomePage): ?>
<div class="container py-5">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
<?php else: ?>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
<?php endif; ?>

<footer class="bg-dark text-white-50 py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <h5 class="text-white mb-3"><i class="bi bi-people-fill me-2"></i>CommunityLink</h5>
                <p class="mb-0">Connecting volunteers, organisations, and communities together for a better tomorrow.</p>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <h6 class="text-white mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><?= $this->Html->link('Events', ['controller' => 'Public', 'action' => 'publicEvents'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                    <li class="mb-2"><?= $this->Html->link('Volunteer Registration', ['controller' => 'Public', 'action' => 'volunteerRegister'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                    <li class="mb-2"><?= $this->Html->link('Organisation Registration', ['controller' => 'Public', 'action' => 'organisationRegister'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="text-white mb-3">Contact</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><?= $this->Html->link('Contact Us', ['controller' => 'Public', 'action' => 'contact'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                </ul>
            </div>
        </div>
        <hr class="my-4 bg-white-50">
        <div class="text-center">
            <small>&copy; <?= date('Y') ?> CommunityLink. All rights reserved.</small>
        </div>
    </div>
</footer>

<?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') ?>
<script>
    // Navbar scroll effect
    document.addEventListener('DOMContentLoaded', function() {
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-link-custom, .btn-login-nav').forEach(link => {
            link.addEventListener('click', function() {
                const navbarCollapse = document.getElementById('navbarNav');
                if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                    // Use Bootstrap's collapse method
                    if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    } else {
                        // Fallback if Bootstrap is not loaded yet
                        navbarCollapse.classList.remove('show');
                    }
                }
            });
        });

        // User dropdown toggle
        const userInfoToggle = document.getElementById('userInfoToggle');
        const userDropdown = document.getElementById('userDropdown');
        
        if (userInfoToggle && userDropdown) {
            // Toggle dropdown when clicking on user-info
            userInfoToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                userDropdown.classList.toggle('show');
            });

            // Close dropdown when clicking on dropdown items
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    userDropdown.classList.remove('show');
                    
                    // Also close mobile menu if open
                    const navbarCollapse = document.getElementById('navbarNav');
                    if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                        if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                            const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                                toggle: false
                            });
                            bsCollapse.hide();
                        } else {
                            navbarCollapse.classList.remove('show');
                        }
                    }
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!userInfoToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('show');
                }
            });
        }
    });
</script>
<?= $this->fetch('script') ?>
</body>
</html>

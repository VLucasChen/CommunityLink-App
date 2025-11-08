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
// Check if user is authenticated
$isAuthenticated = false;
if (isset($this->Identity) && method_exists($this->Identity, 'isLoggedIn')) {
    try {
        $isAuthenticated = $this->Identity->isLoggedIn();
    } catch (\Exception $e) {
        $isAuthenticated = false;
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

    .btn-logout-nav {
        background: rgba(255, 255, 255, 0.1) !important;
        color: white !important;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 0.625rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-logout-nav:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        color: white !important;
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
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

        .btn-login-nav,
        .btn-logout-nav {
            width: 100%;
            justify-content: center;
            margin-top: 0.5rem;
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
        $navLinks = [
            ['action' => 'home', 'label' => 'Home', 'icon' => 'bi-house-door'],
            ['action' => 'publicEvents', 'label' => 'Events', 'icon' => 'bi-calendar-event'],
            ['action' => 'volunteerRegister', 'label' => 'Volunteer', 'icon' => 'bi-person-plus'],
            ['action' => 'organisationRegister', 'label' => 'Organisation', 'icon' => 'bi-building'],
            ['action' => 'contact', 'label' => 'Contact Us', 'icon' => 'bi-envelope'],
        ];
        
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
        
        <?php if (!$isAuthenticated): ?>
            <?= $this->Html->link(
                '<i class="bi bi-box-arrow-in-right"></i> Login',
                ['controller' => 'Users', 'action' => 'login'],
                ['class' => 'btn-login-nav', 'escape' => false]
            ) ?>
        <?php else: ?>
            <?= $this->Html->link(
                '<i class="bi bi-person-circle"></i> Dashboard',
                ['controller' => 'Pages', 'action' => 'dashboard'],
                ['class' => 'btn-login-nav', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="bi bi-box-arrow-right"></i> Logout',
                ['controller' => 'Users', 'action' => 'logout'],
                ['class' => 'btn-logout-nav', 'escape' => false]
            ) ?>
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
        document.querySelectorAll('.nav-link-custom, .btn-login-nav, .btn-logout-nav').forEach(link => {
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
    });
</script>
<?= $this->fetch('script') ?>
</body>
</html>

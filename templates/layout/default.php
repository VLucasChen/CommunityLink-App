<?php
/**
 * CakePHP(tm) : Rapid Development Framework[](https://cakephp.org)
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CommunityLink';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        CommunityLink | <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Bootstrap 5 CSS -->
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css') ?>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<?php
$isLoginPage = $this->request->getParam('controller') === 'Users' && $this->request->getParam('action') === 'login';
?>
<body class="bg-light <?= $isLoginPage ? 'login-page' : '' ?>">

    <?php
    $currentController = $this->request->getParam('controller');
    $currentAction = $this->request->getParam('action');
    $isAuthenticated = false;
    $user = null;
    if (isset($this->Identity) && method_exists($this->Identity, 'isLoggedIn')) {
        try {
            $isAuthenticated = $this->Identity->isLoggedIn();
            if ($isAuthenticated) {
                $user = $this->Identity->get('originalData') ?? $this->Identity->get('data');
            }
        } catch (\Exception $e) {
            $isAuthenticated = false;
        }
    }
    ?>
    <?php if (!$isLoginPage): ?>
    <style>
        :root {
            --navbar-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --m3-primary: #6750A4;
        }

        .admin-navbar {
            background: var(--navbar-gradient) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 0;
            transition: all 0.3s ease;
        }

        .admin-navbar.scrolled {
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
        }

        .navbar-brand-admin {
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

        .navbar-brand-admin:hover {
            transform: translateY(-2px);
            color: white !important;
        }

        .navbar-brand-icon-admin {
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

        .navbar-brand-admin:hover .navbar-brand-icon-admin {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .nav-link-admin {
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

        .nav-link-admin::before {
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

        .nav-link-admin:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .nav-link-admin.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .nav-link-admin.active::before {
            transform: translateX(-50%) scaleX(1);
        }

        .navbar-toggler-admin {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 0.5rem 0.75rem;
            transition: all 0.3s ease;
        }

        .navbar-toggler-admin:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .navbar-toggler-icon-admin {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            font-size: 0.9rem;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .btn-logout-admin {
            background: rgba(255, 255, 255, 0.1);
            color: white;
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

        .btn-logout-admin:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                margin-top: 1rem;
                padding-top: 1rem;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            .nav-link-admin {
                padding: 0.75rem 1rem !important;
                margin-bottom: 0.25rem;
            }

            .user-menu {
                flex-direction: column;
                width: 100%;
                margin-top: 0.5rem;
            }

            .user-info,
            .btn-logout-admin {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg admin-navbar sticky-top" id="adminNavbar">
        <div class="container">
            <a class="navbar-brand-admin" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']) ?>">
                <div class="navbar-brand-icon-admin">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <span>CommunityLink</span>
            </a>
            
            <button class="navbar-toggler navbar-toggler-admin" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbarNav" aria-controls="adminNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-toggler-icon-admin"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="adminNavbarNav">
                <div class="navbar-nav navbar-nav-custom ms-auto align-items-center">
                    <?php
                    $adminNavLinks = [
                        ['controller' => 'Pages', 'action' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'bi-speedometer2'],
                        ['controller' => 'Events', 'action' => 'index', 'label' => 'Events', 'icon' => 'bi-calendar-event'],
                        ['controller' => 'Volunteers', 'action' => 'index', 'label' => 'Volunteers', 'icon' => 'bi-people'],
                        ['controller' => 'VolunteerSignups', 'action' => 'index', 'label' => 'Signups', 'icon' => 'bi-person-plus'],
                        ['controller' => 'Organisations', 'action' => 'index', 'label' => 'Partners', 'icon' => 'bi-building'],
                        ['controller' => 'ContactMessages', 'action' => 'index', 'label' => 'Contacts', 'icon' => 'bi-envelope'],
                    ];
                    
                    // Add Users link for admin only
                    if ($isAuthenticated && $user && isset($user->role) && $user->role === 'admin') {
                        $adminNavLinks[] = ['controller' => 'Users', 'action' => 'index', 'label' => 'Users', 'icon' => 'bi-person-gear'];
                    }
                    
                    foreach ($adminNavLinks as $link):
                        $isActive = ($currentController === $link['controller'] && $currentAction === $link['action']);
                    ?>
                        <?= $this->Html->link(
                            '<i class="bi ' . $link['icon'] . '"></i> ' . $link['label'],
                            ['controller' => $link['controller'], 'action' => $link['action']],
                            [
                                'class' => 'nav-link-admin' . ($isActive ? ' active' : ''),
                                'escape' => false
                            ]
                        ) ?>
                    <?php endforeach; ?>
                    
                    <div class="user-menu">
                        <?php if ($isAuthenticated && $user): ?>
                            <div class="user-info">
                                <div class="user-avatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;"><?= h($user->username ?? 'User') ?></div>
                                    <small style="opacity: 0.8; font-size: 0.8rem;">
                                        <?= h(ucfirst($user->role ?? 'User')) ?>
                                    </small>
                                </div>
                            </div>
                            <?= $this->Html->link(
                                '<i class="bi bi-box-arrow-right"></i> Logout',
                                ['controller' => 'Users', 'action' => 'logout'],
                                ['class' => 'btn-logout-admin', 'escape' => false]
                            ) ?>
                        <?php else: ?>
                            <?= $this->Html->link(
                                '<i class="bi bi-box-arrow-in-right"></i> Login',
                                ['controller' => 'Users', 'action' => 'login'],
                                ['class' => 'btn-logout-admin', 'escape' => false]
                            ) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navbar scroll effect
            const navbar = document.getElementById('adminNavbar');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });

                // Close mobile menu when clicking on a link
                document.querySelectorAll('.nav-link-admin, .btn-logout-admin').forEach(link => {
                    link.addEventListener('click', function() {
                        const navbarCollapse = document.getElementById('adminNavbarNav');
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
            }
        });
    </script>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="<?= $isLoginPage ? '' : 'py-4' ?>">
        <?php if (!$isLoginPage): ?>
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <?php else: ?>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        <?php endif; ?>
    </main>

    <?php if (!$isLoginPage): ?>
    <!-- Footer -->
    <footer class="bg-dark text-white-50 py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="text-white mb-3"><i class="bi bi-people-fill me-2"></i>CommunityLink</h5>
                    <p class="mb-0">Connecting volunteers, organisations, and communities together.</p>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <h6 class="text-white mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><?= $this->Html->link('Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                        <li class="mb-2"><?= $this->Html->link('Events', ['controller' => 'Events', 'action' => 'index'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                        <li class="mb-2"><?= $this->Html->link('Volunteers', ['controller' => 'Volunteers', 'action' => 'index'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="text-white mb-3">System</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><?= $this->Html->link('Partners', ['controller' => 'Organisations', 'action' => 'index'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                        <li class="mb-2"><?= $this->Html->link('Contacts', ['controller' => 'ContactMessages', 'action' => 'index'], ['class' => 'text-white-50 text-decoration-none']) ?></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-white-50">
            <div class="text-center">
                <small>&copy; <?= date('Y') ?> CommunityLink. All rights reserved.</small>
            </div>
        </div>
    </footer>
    <?php endif; ?>

    <!-- Bootstrap 5 JS (Bundle includes Popper) -->
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js') ?>

    <!-- Custom JS -->
    <?= $this->fetch('script') ?>
</body>
</html>
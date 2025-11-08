<?php
/**
 * Login page for CommunityLink system - A5 CakePHP version
 * Based on A3 login.php, adapted for CakePHP form helpers
 * 
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - CommunityLink</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons (same as A3) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-card">
                    <div class="login-header text-center">
                        <h2><i class="fas fa-hands-helping me-2"></i>CommunityLink</h2>
                        <p class="mb-0">Admin Login</p>
                    </div>
                    <div class="card-body p-4">
                        <?php 
                        // Display flash messages (errors) - A3 style
                        $flashMessages = $this->Flash->render();
                        $error = '';
                        if ($flashMessages) {
                            $flashMessages = strip_tags($flashMessages);
                            if (stripos($flashMessages, 'Invalid') !== false || 
                                stripos($flashMessages, 'error') !== false) {
                                $error = $flashMessages;
                            }
                        }
                        if ($error): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= h($error) ?>
                            </div>
                        <?php endif; ?>
                        
                        <?= $this->Form->create(null, ['method' => 'post']) ?>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" 
                                           name="username" 
                                           id="username" 
                                           class="form-control" 
                                           maxlength="50" 
                                           required 
                                           placeholder="Enter username" 
                                           value="<?= h($this->request->getData('username') ?? '') ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" 
                                           name="password" 
                                           id="password" 
                                           class="form-control" 
                                           maxlength="255" 
                                           required 
                                           placeholder="Enter password">
                                </div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </button>
                            </div>
                        <?= $this->Form->end() ?>
                        
                        <div class="text-center mt-3">
                            <?= $this->Html->link(
                                '<i class="fas fa-arrow-left me-1"></i>Back to Home',
                                ['controller' => 'Pages', 'action' => 'home'],
                                ['class' => 'text-decoration-none', 'escape' => false]
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<style>
    :root {
        --m3-primary: #6750A4;
        --m3-primary-container: #EADDFF;
        --m3-surface: #FFFBFE;
        --m3-surface-variant: #E7E0EC;
        --m3-on-primary: #FFFFFF;
        --m3-on-surface: #1C1B1F;
        --m3-outline: #79747E;
        --m3-secondary: #625B71;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 0;
        color: white;
        margin-bottom: 3rem;
        border-radius: 0 0 24px 24px;
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .dashboard-subtitle {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid var(--m3-surface-variant);
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        margin-bottom: 1rem;
    }

    .stat-icon.primary {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
    }

    .stat-icon.success {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    }

    .stat-icon.warning {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
    }

    .stat-icon.info {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--m3-on-surface);
        margin-bottom: 0.25rem;
    }

    .stat-label {
        color: var(--m3-outline);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .section-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        border: 1px solid var(--m3-surface-variant);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--m3-primary);
        font-size: 1.75rem;
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-modern thead {
        background: var(--m3-primary-container);
    }

    .table-modern th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: var(--m3-on-surface);
        border-bottom: 2px solid var(--m3-surface-variant);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-modern td {
        padding: 1rem;
        border-bottom: 1px solid var(--m3-surface-variant);
        color: var(--m3-on-surface);
    }

    .table-modern tbody tr {
        transition: background 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background: var(--m3-primary-container);
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    .rank-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        margin-right: 1rem;
    }

    .rank-badge.gold {
        background: linear-gradient(135deg, #FCD34D 0%, #FBBF24 100%);
        color: #92400E;
    }

    .rank-badge.silver {
        background: linear-gradient(135deg, #E5E7EB 0%, #D1D5DB 100%);
        color: #374151;
    }

    .rank-badge.bronze {
        background: linear-gradient(135deg, #FCA5A5 0%, #F87171 100%);
        color: #991B1B;
    }

    .rank-badge.default {
        background: var(--m3-surface-variant);
        color: var(--m3-on-surface);
    }

    .skill-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background: var(--m3-surface-variant);
        border-radius: 12px;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
    }

    .skill-item:hover {
        background: var(--m3-primary-container);
        transform: translateX(4px);
    }

    .skill-item:last-child {
        margin-bottom: 0;
    }

    .skill-name {
        font-weight: 500;
        color: var(--m3-on-surface);
    }

    .skill-count {
        background: var(--m3-primary);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .status-badge.preparing {
        background: #FEF3C7;
        color: #92400E;
    }

    .status-badge.ready {
        background: #D1FAE5;
        color: #065F46;
    }

    .status-badge.archive {
        background: #E0E7FF;
        color: #3730A3;
    }

    .status-badge.failed {
        background: #FEE2E2;
        color: #991B1B;
    }

    .chart-bar {
        height: 8px;
        background: var(--m3-surface-variant);
        border-radius: 4px;
        overflow: hidden;
        margin-top: 0.5rem;
    }

    .chart-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--m3-primary) 0%, #764ba2 100%);
        border-radius: 4px;
        transition: width 0.5s ease;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--m3-outline);
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2rem;
        }

        .section-card {
            padding: 1.5rem;
        }

        .table-modern {
            font-size: 0.85rem;
        }

        .table-modern th,
        .table-modern td {
            padding: 0.75rem 0.5rem;
        }
    }
</style>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="container">
        <h1 class="dashboard-title">
            <i class="bi bi-speedometer2 me-3"></i>Dashboard
        </h1>
        <p class="dashboard-subtitle">
            Welcome back, <?= h($user->username) ?>! Here's an overview of your community platform.
        </p>
    </div>
</div>

<div class="container">
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon primary">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-value"><?= count($topVolunteersList) ?></div>
                <div class="stat-label">Top Volunteers</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon success">
                    <i class="bi bi-building-fill"></i>
                </div>
                <div class="stat-value"><?= count($topPartnersList) ?></div>
                <div class="stat-label">Top Partners</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon warning">
                    <i class="bi bi-tools"></i>
                </div>
                <div class="stat-value"><?= count($skillsDistribution) ?></div>
                <div class="stat-label">Skill Categories</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon info">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <div class="stat-value"><?= array_sum($eventsByStatus) ?></div>
                <div class="stat-label">Events Next Month</div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Top 10 Volunteers -->
        <div class="col-lg-6">
            <div class="section-card">
                <h2 class="section-title">
                    <i class="bi bi-trophy-fill"></i>
                    Top 10 Volunteers
                </h2>
                <?php if (!empty($topVolunteersList)): ?>
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">Rank</th>
                                    <th>Volunteer</th>
                                    <th style="text-align: center; width: 100px;">Events</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($topVolunteersList as $index => $item): 
                                    $rank = $index + 1;
                                    $rankClass = $rank === 1 ? 'gold' : ($rank === 2 ? 'silver' : ($rank === 3 ? 'bronze' : 'default'));
                                ?>
                                    <tr>
                                        <td>
                                            <span class="rank-badge <?= $rankClass ?>">
                                                <?= $rank ?>
                                            </span>
                                        </td>
                                        <td>
                                            <strong><?= h($item['volunteer']->first_name . ' ' . $item['volunteer']->last_name) ?></strong>
                                            <br>
                                            <small class="text-muted"><?= h($item['volunteer']->email) ?></small>
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="badge bg-primary" style="font-size: 1rem; padding: 0.5rem 0.75rem;">
                                                <?= $item['event_count'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>No volunteer data available yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Top 10 Partners -->
        <div class="col-lg-6">
            <div class="section-card">
                <h2 class="section-title">
                    <i class="bi bi-award-fill"></i>
                    Top 10 Partners
                </h2>
                <?php if (!empty($topPartnersList)): ?>
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">Rank</th>
                                    <th>Organisation</th>
                                    <th style="text-align: center; width: 100px;">Events</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($topPartnersList as $index => $item): 
                                    $rank = $index + 1;
                                    $rankClass = $rank === 1 ? 'gold' : ($rank === 2 ? 'silver' : ($rank === 3 ? 'bronze' : 'default'));
                                ?>
                                    <tr>
                                        <td>
                                            <span class="rank-badge <?= $rankClass ?>">
                                                <?= $rank ?>
                                            </span>
                                        </td>
                                        <td>
                                            <strong><?= h($item['organisation']->org_name) ?></strong>
                                            <br>
                                            <small class="text-muted"><?= h($item['organisation']->industry) ?></small>
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="badge bg-success" style="font-size: 1rem; padding: 0.5rem 0.75rem;">
                                                <?= $item['event_count'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>No partner data available yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Skills Distribution -->
        <div class="col-lg-6">
            <div class="section-card">
                <h2 class="section-title">
                    <i class="bi bi-pie-chart-fill"></i>
                    Volunteers by Skills
                </h2>
                <?php if (!empty($skillsDistribution)): 
                    $maxCount = max($skillsDistribution);
                ?>
                    <div>
                        <?php foreach ($skillsDistribution as $skill => $count): 
                            $percentage = ($count / $maxCount) * 100;
                        ?>
                            <div class="skill-item">
                                <div>
                                    <div class="skill-name"><?= h($skill) ?></div>
                                    <div class="chart-bar">
                                        <div class="chart-bar-fill" style="width: <?= $percentage ?>%"></div>
                                    </div>
                                </div>
                                <span class="skill-count"><?= $count ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>No skills data available yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Events by Status (Next Month) -->
        <div class="col-lg-6">
            <div class="section-card">
                <h2 class="section-title">
                    <i class="bi bi-calendar-month-fill"></i>
                    Events Next Month (by Status)
                </h2>
                <?php if (array_sum($eventsByStatus) > 0): ?>
                    <div>
                        <?php 
                        $statusConfig = [
                            'Preparing' => ['class' => 'preparing', 'icon' => 'bi-hourglass-split', 'label' => 'Preparing'],
                            'Ready to go' => ['class' => 'ready', 'icon' => 'bi-check-circle', 'label' => 'Ready to go'],
                            'Archive' => ['class' => 'archive', 'icon' => 'bi-archive', 'label' => 'Archive'],
                            'Failed' => ['class' => 'failed', 'icon' => 'bi-x-circle', 'label' => 'Failed']
                        ];
                        foreach ($eventsByStatus as $status => $count): 
                            if ($count > 0):
                                $config = $statusConfig[$status] ?? ['class' => 'default', 'icon' => 'bi-circle', 'label' => $status];
                        ?>
                            <div class="skill-item">
                                <div>
                                    <div class="skill-name">
                                        <span class="status-badge <?= $config['class'] ?>">
                                            <i class="bi <?= $config['icon'] ?>"></i>
                                            <?= h($config['label']) ?>
                                        </span>
                                    </div>
                                </div>
                                <span class="skill-count"><?= $count ?></span>
                            </div>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-calendar-x"></i>
                        <p>No events scheduled for next month.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

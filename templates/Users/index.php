<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>

<style>
    :root {
        --m3-primary: #6750A4;
        --m3-primary-container: #EADDFF;
        --m3-surface: #FFFBFE;
        --m3-surface-variant: #E7E0EC;
        --m3-on-surface: #1C1B1F;
        --m3-outline: #79747E;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2.5rem 0;
        color: white;
        margin-bottom: 2rem;
        border-radius: 0 0 24px 24px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-title i {
        font-size: 2.25rem;
    }

    .page-subtitle {
        font-size: 1rem;
        opacity: 0.95;
    }

    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .btn-action {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .table-container {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--m3-surface-variant);
        overflow-x: auto;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .table-responsive table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }

    .table-responsive thead {
        background: var(--m3-surface-variant);
    }

    .table-responsive th {
        padding: 1rem;
        text-align: left;
        font-weight: 700;
        color: var(--m3-on-surface);
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--m3-primary);
    }

    .table-responsive th a {
        color: var(--m3-on-surface);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-responsive th a:hover {
        color: var(--m3-primary);
    }

    .table-responsive td {
        padding: 1rem;
        border-bottom: 1px solid var(--m3-surface-variant);
        color: var(--m3-on-surface);
    }

    .table-responsive tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-responsive tbody tr:hover {
        background: var(--m3-primary-container);
    }

    .table-responsive tbody tr:last-child td {
        border-bottom: none;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .role-badge.admin {
        background: #FEE2E2;
        color: #991B1B;
    }

    .role-badge.assistant {
        background: #DBEAFE;
        color: #1E40AF;
    }

    .role-badge.volunteer {
        background: #D1FAE5;
        color: #065F46;
    }

    .user-info-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar-table {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
        flex-shrink: 0;
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        color: var(--m3-on-surface);
    }

    .user-email {
        font-size: 0.875rem;
        color: var(--m3-outline);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .actions {
        white-space: nowrap;
    }

    .actions a,
    .actions form {
        display: inline-block;
        margin-right: 0.5rem;
    }

    .btn-icon {
        padding: 0.5rem;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        font-size: 0.875rem;
        min-width: 36px;
        height: 36px;
    }

    .btn-icon.view {
        background: var(--m3-primary-container);
        color: var(--m3-primary);
    }

    .btn-icon.view:hover {
        background: var(--m3-primary);
        color: white;
    }

    .btn-icon.edit {
        background: #DBEAFE;
        color: #1E40AF;
    }

    .btn-icon.edit:hover {
        background: #1E40AF;
        color: white;
    }

    .btn-icon.delete {
        background: #FEE2E2;
        color: #991B1B;
    }

    .btn-icon.delete:hover {
        background: #991B1B;
        color: white;
    }

    .paginator {
        margin-top: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    .paginator ul {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .paginator li {
        display: inline-block;
    }

    .paginator a,
    .paginator span {
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        text-decoration: none;
        color: var(--m3-on-surface);
        background: white;
        border: 2px solid var(--m3-surface-variant);
        transition: all 0.2s ease;
        display: inline-block;
    }

    .paginator a:hover {
        background: var(--m3-primary);
        color: white;
        border-color: var(--m3-primary);
    }

    .paginator .current {
        background: var(--m3-primary);
        color: white;
        border-color: var(--m3-primary);
    }

    .paginator p {
        color: var(--m3-outline);
        font-size: 0.875rem;
        margin: 0;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--m3-outline);
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }

        .page-title i {
            font-size: 1.75rem;
        }

        .action-bar {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .table-container {
            padding: 1rem;
        }

        .table-responsive {
            font-size: 0.875rem;
        }

        .table-responsive th,
        .table-responsive td {
            padding: 0.75rem 0.5rem;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <i class="bi bi-people-fill"></i>
            Users Management
        </h1>
        <p class="page-subtitle">Manage system users and their roles</p>
    </div>
</div>

<div class="container">
    <!-- Action Bar -->
    <div class="action-bar">
        <div></div>
        <div>
            <?= $this->Html->link(
                '<i class="bi bi-plus-circle"></i> New User',
                ['action' => 'add'],
                ['class' => 'btn-action btn-primary', 'escape' => false]
            ) ?>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('username', 'Username') ?></th>
                        <th><?= $this->Paginator->sort('role', 'Role') ?></th>
                        <th><?= $this->Paginator->sort('volunteer_id', 'Volunteer') ?></th>
                        <th><?= $this->Paginator->sort('created', 'Created') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (iterator_count($users) > 0): ?>
                        <?php foreach ($users as $user): ?>
                            <?php
                            $initials = strtoupper(substr($user->username ?? '', 0, 2));
                            $role = strtolower($user->role ?? 'volunteer');
                            ?>
                            <tr>
                                <td>
                                    <div class="user-info-cell">
                                        <div class="user-avatar-table">
                                            <?= $initials ?: 'U' ?>
                                        </div>
                                        <div class="user-details">
                                            <div class="user-name">
                                                <?= h($user->username) ?>
                                            </div>
                                            <div class="user-email">
                                                <i class="bi bi-key"></i>
                                                ID: <?= substr(h($user->id), 0, 8) ?>...
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge <?= $role ?>">
                                        <?php if ($role === 'admin'): ?>
                                            <i class="bi bi-shield-check"></i>
                                        <?php elseif ($role === 'assistant'): ?>
                                            <i class="bi bi-person-badge"></i>
                                        <?php else: ?>
                                            <i class="bi bi-person"></i>
                                        <?php endif; ?>
                                        <?= h(ucfirst($user->role)) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($user->has('volunteer') && $user->volunteer): ?>
                                        <div class="user-email">
                                            <i class="bi bi-person-circle"></i>
                                            <?= $this->Html->link(
                                                $user->volunteer->first_name . ' ' . $user->volunteer->last_name,
                                                ['controller' => 'Volunteers', 'action' => 'view', $user->volunteer->id],
                                                ['style' => 'color: var(--m3-primary); text-decoration: none;']
                                            ) ?>
                                        </div>
                                    <?php else: ?>
                                        <span style="color: var(--m3-outline);">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="user-email">
                                        <i class="bi bi-calendar3"></i>
                                        <?= $user->created ? $user->created->format('M d, Y') : '—' ?>
                                    </div>
                                </td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="bi bi-eye"></i>',
                                        ['action' => 'view', $user->id],
                                        ['class' => 'btn-icon view', 'title' => 'View', 'escape' => false]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="bi bi-pencil"></i>',
                                        ['action' => 'edit', $user->id],
                                        ['class' => 'btn-icon edit', 'title' => 'Edit', 'escape' => false]
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="bi bi-trash"></i>',
                                        ['action' => 'delete', $user->id],
                                        [
                                            'class' => 'btn-icon delete',
                                            'title' => 'Delete',
                                            'confirm' => __('Are you sure you want to delete user "{0}"?', $user->username),
                                            'escape' => false
                                        ]
                                    ) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>No users found.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginator -->
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<i class="bi bi-chevron-double-left"></i> ' . __('first'), ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="bi bi-chevron-left"></i> ' . __('previous'), ['escape' => false]) ?>
            <?= $this->Paginator->numbers(['modulus' => 5]) ?>
            <?= $this->Paginator->next(__('next') . ' <i class="bi bi-chevron-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last(__('last') . ' <i class="bi bi-chevron-double-right"></i>', ['escape' => false]) ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

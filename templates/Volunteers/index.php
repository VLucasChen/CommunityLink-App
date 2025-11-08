<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Volunteer> $volunteers
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

    .search-box {
        position: relative;
        flex: 1;
        max-width: 400px;
    }

    .search-box input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 3rem;
        border: 2px solid var(--m3-surface-variant);
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--m3-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--m3-outline);
        font-size: 1.1rem;
    }

    .search-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .btn-add {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .table-modern thead {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    }

    .table-modern th {
        padding: 1.25rem 1rem;
        text-align: left;
        font-weight: 600;
        color: var(--m3-on-surface);
        border-bottom: 2px solid var(--m3-surface-variant);
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-modern td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid var(--m3-surface-variant);
        color: var(--m3-on-surface);
        vertical-align: middle;
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

    .user-info-cell {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar-table {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .user-details {
        flex: 1;
    }

    .user-name {
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 0.25rem;
    }

    .user-email {
        font-size: 0.875rem;
        color: var(--m3-outline);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .status-badge.pending {
        background: #FEF3C7;
        color: #92400E;
    }

    .status-badge.approved {
        background: #D1FAE5;
        color: #065F46;
    }

    .status-badge.rejected {
        background: #FEE2E2;
        color: #991B1B;
    }

    .status-badge.default {
        background: var(--m3-surface-variant);
        color: var(--m3-on-surface);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        justify-content: center;
    }

    .btn-action {
        padding: 0.5rem;
        border-radius: 10px;
        border: none;
        background: transparent;
        color: var(--m3-outline);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        width: 36px;
        height: 36px;
    }

    .btn-action:hover {
        background: var(--m3-primary-container);
        color: var(--m3-primary);
        transform: scale(1.1);
    }

    .btn-action.danger:hover {
        background: #FEE2E2;
        color: #DC2626;
    }

    .file-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--m3-outline);
    }

    .file-info i {
        color: var(--m3-primary);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--m3-outline);
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
        font-size: 1.5rem;
    }

    .empty-state p {
        color: var(--m3-outline);
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination li {
        margin: 0;
    }

    .pagination a,
    .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0.5rem 0.75rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .pagination a {
        background: white;
        color: var(--m3-on-surface);
        border: 1px solid var(--m3-surface-variant);
    }

    .pagination a:hover {
        background: var(--m3-primary-container);
        color: var(--m3-primary);
        border-color: var(--m3-primary);
    }

    .pagination .current {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        color: white;
        border: none;
    }

    .pagination-info {
        color: var(--m3-outline);
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .table-modern {
            font-size: 0.85rem;
        }

        .table-modern th,
        .table-modern td {
            padding: 0.75rem 0.5rem;
        }

        .user-info-cell {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <i class="bi bi-people-fill"></i>
            Volunteers Management
        </h1>
        <p class="page-subtitle">Manage all volunteers</p>
    </div>
</div>

<div class="container">
    <!-- Action Bar -->
    <div class="action-bar">
        <div class="search-box">
            <?= $this->Form->create(null, [
                'type' => 'get',
                'url' => ['action' => 'index'],
                'class' => 'search-form'
            ]) ?>
            <i class="bi bi-search"></i>
            <?= $this->Form->text('search', [
                'value' => $this->request->getQuery('search') ?? '',
                'placeholder' => 'Search by name, email, phone, or status...',
                'class' => 'form-control'
            ]) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="search-actions">
            <?= $this->Html->link(
                '<i class="bi bi-plus-circle"></i> New Volunteer',
                ['action' => 'add'],
                ['class' => 'btn-add', 'escape' => false]
            ) ?>
        </div>
    </div>

    <!-- Table -->
    <?php if (count($volunteers) > 0): ?>
    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Volunteer</th>
                    <th>Contact</th>
                    <th>Phone</th>
                    <th>Documents</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($volunteers as $volunteer): 
                    $initials = strtoupper(substr($volunteer->first_name ?? '', 0, 1) . substr($volunteer->last_name ?? '', 0, 1));
                    $status = strtolower($volunteer->status ?? 'pending');
                    $statusClass = match($status) {
                        'approved' => 'approved',
                        'rejected' => 'rejected',
                        default => 'pending'
                    };
                ?>
                    <tr>
                        <td>
                            <div class="user-info-cell">
                                <div class="user-avatar-table">
                                    <?= $initials ?: '?' ?>
                                </div>
                                <div class="user-details">
                                    <div class="user-name">
                                        <?= h($volunteer->first_name . ' ' . $volunteer->last_name) ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-email">
                                <i class="bi bi-envelope me-1"></i>
                                <?= h($volunteer->email) ?>
                            </div>
                        </td>
                        <td>
                            <div class="user-email">
                                <i class="bi bi-telephone me-1"></i>
                                <?= h($volunteer->phone) ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($volunteer->documents): ?>
                                <div class="file-info">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <span>Available</span>
                                </div>
                            <?php else: ?>
                                <span style="color: var(--m3-outline);">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="status-badge <?= $statusClass ?>">
                                <?php if ($statusClass === 'approved'): ?>
                                    <i class="bi bi-check-circle"></i>
                                <?php elseif ($statusClass === 'rejected'): ?>
                                    <i class="bi bi-x-circle"></i>
                                <?php else: ?>
                                    <i class="bi bi-clock"></i>
                                <?php endif; ?>
                                <?= h(ucfirst($volunteer->status ?? 'Pending')) ?>
                            </span>
                        </td>
                        <td>
                            <div class="user-email">
                                <i class="bi bi-calendar3 me-1"></i>
                                <?= $volunteer->date_submitted ? $volunteer->date_submitted->format('M d, Y') : ($volunteer->created ? $volunteer->created->format('M d, Y') : '-') ?>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <?= $this->Html->link(
                                    '<i class="bi bi-eye"></i>',
                                    ['action' => 'view', $volunteer->volunteer_id],
                                    ['class' => 'btn-action', 'title' => 'View', 'escape' => false]
                                ) ?>
                                <?= $this->Html->link(
                                    '<i class="bi bi-pencil"></i>',
                                    ['action' => 'edit', $volunteer->volunteer_id],
                                    ['class' => 'btn-action', 'title' => 'Edit', 'escape' => false]
                                ) ?>
                                <?= $this->Form->postLink(
                                    '<i class="bi bi-trash"></i>',
                                    ['action' => 'delete', $volunteer->volunteer_id],
                                    [
                                        'class' => 'btn-action danger',
                                        'title' => 'Delete',
                                        'confirm' => __('Are you sure you want to delete volunteer {0}?', $volunteer->first_name . ' ' . $volunteer->last_name),
                                        'escape' => false
                                    ]
                                ) ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        <ul class="pagination">
            <?= $this->Paginator->first('<i class="bi bi-chevron-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="bi bi-chevron-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="bi bi-chevron-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="bi bi-chevron-double-right"></i>', ['escape' => false]) ?>
        </ul>
        <div class="pagination-info">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
    </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h3>No Volunteers Found</h3>
            <p>There are no volunteers at the moment. Try adjusting your search or add a new volunteer.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('.search-box input');
        if (searchInput) {
            // Auto submit on Enter key
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    this.closest('form').submit();
                }
            });
        }
    });
</script>

<?= $this->element('success_modal', [
    'modalId' => 'volunteerSuccessModal',
    'title' => 'Success!',
    'message' => 'The operation was completed successfully.',
    'actionLink' => null,
    'actionText' => null
]) ?>

<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\VolunteerSignup> $volunteerSignups
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

    .filters-section {
        display: flex;
        gap: 1rem;
        align-items: flex-end;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        padding: 1.5rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        flex: 1;
        min-width: 150px;
    }

    .filter-group:has(input[name="date_from"]) {
        min-width: 280px;
    }

    .filter-group-button {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        flex: 0;
        min-height: 100%;
    }

    .filter-group-button::before {
        content: '';
        height: 1.5rem;
        display: block;
    }

    .filter-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--m3-on-surface);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-label i {
        color: var(--m3-primary);
    }

    .filter-select,
    .filter-input {
        padding: 0.75rem 1rem;
        border: 2px solid var(--m3-surface-variant);
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
        height: 48px;
        box-sizing: border-box;
    }

    .filter-select:focus,
    .filter-input:focus {
        outline: none;
        border-color: var(--m3-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-filter {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        white-space: nowrap;
        height: 48px;
        box-sizing: border-box;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-clear-filters {
        background: white;
        color: var(--m3-on-surface);
        border: 2px solid var(--m3-surface-variant);
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
        height: 48px;
        box-sizing: border-box;
    }

    .btn-clear-filters:hover {
        background: var(--m3-surface-variant);
        color: var(--m3-on-surface);
        border-color: var(--m3-outline);
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

    .status-badge.hired {
        background: #D1FAE5;
        color: #065F46;
    }

    .status-badge.declined {
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

    .empty-state .btn-add {
        padding: 0.5rem 0.875rem;
        font-size: 0.8rem;
        box-shadow: 0 2px 6px rgba(102, 126, 234, 0.2);
        height: auto;
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
            <i class="bi bi-person-plus-fill"></i>
            Volunteer Signups
        </h1>
        <p class="page-subtitle">Manage volunteer registration requests</p>
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
                'value' => $search ?? '',
                'placeholder' => 'Search by name, email, phone, or status...',
                'class' => 'form-control'
            ]) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="search-actions">
            <?php if (!empty($search) || !empty($statusFilter) || !empty($dateFrom) || !empty($dateTo)): ?>
                <?= $this->Html->link(
                    '<i class="bi bi-x-circle"></i> Clear All',
                    ['action' => 'index'],
                    ['class' => 'btn-add', 'escape' => false, 'style' => 'background: #6B7280;']
                ) ?>
            <?php endif; ?>
            <?= $this->Html->link(
                '<i class="bi bi-plus-circle"></i> New Signup',
                ['action' => 'add'],
                ['class' => 'btn-add', 'escape' => false]
            ) ?>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="filters-section">
        <?= $this->Form->create(null, [
            'type' => 'get',
            'url' => ['action' => 'index'],
            'class' => 'filters-form',
            'style' => 'display: contents;'
        ]) ?>
        
        <?php if (!empty($search)): ?>
            <?= $this->Form->hidden('search', ['value' => $search]) ?>
        <?php endif; ?>
        <?php if (!empty($dateFrom)): ?>
            <?= $this->Form->hidden('date_from', ['value' => $dateFrom]) ?>
        <?php endif; ?>
        <?php if (!empty($dateTo)): ?>
            <?= $this->Form->hidden('date_to', ['value' => $dateTo]) ?>
        <?php endif; ?>
        
        <div class="filter-group">
            <label class="filter-label">
                <i class="bi bi-funnel"></i>
                Status
            </label>
            <?= $this->Form->select('status', [
                'all' => 'All Status',
                'pending' => 'Pending',
                'hired' => 'Hired',
                'declined' => 'Declined'
            ], [
                'class' => 'filter-select',
                'value' => $statusFilter ?? 'all',
                'empty' => false
            ]) ?>
        </div>
        
        <div class="filter-group">
            <label class="filter-label">
                <i class="bi bi-calendar3"></i>
                Submit Date Range
            </label>
            <div style="display: flex; gap: 0.5rem; align-items: center;">
                <?= $this->Form->date('date_from', [
                    'class' => 'filter-input',
                    'value' => $dateFrom ?? '',
                    'max' => date('Y-m-d'),
                    'style' => 'flex: 1;'
                ]) ?>
                <span style="color: var(--m3-outline); font-weight: 600;">to</span>
                <?= $this->Form->date('date_to', [
                    'class' => 'filter-input',
                    'value' => $dateTo ?? '',
                    'max' => date('Y-m-d'),
                    'style' => 'flex: 1;'
                ]) ?>
            </div>
        </div>
        
        <div class="filter-group-button">
            <button type="submit" class="btn-filter">
                <i class="bi bi-funnel-fill"></i> Apply Filters
            </button>
        </div>
        
        <?php if (!empty($statusFilter) || !empty($dateFrom) || !empty($dateTo)): ?>
            <div class="filter-group-button">
                <?= $this->Html->link(
                    '<i class="bi bi-x-circle"></i> Clear Filters',
                    ['action' => 'index', '?' => ['search' => $search]],
                    ['class' => 'btn-clear-filters', 'escape' => false]
                ) ?>
            </div>
        <?php endif; ?>
        
        <?= $this->Form->end() ?>
    </div>

    <!-- Table -->
    <?php if (count($volunteerSignups) > 0): ?>
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
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($volunteerSignups as $volunteerSignup): 
                        $initials = strtoupper(substr($volunteerSignup->first_name ?? '', 0, 1) . substr($volunteerSignup->last_name ?? '', 0, 1));
                        $status = strtolower($volunteerSignup->status ?? 'pending');
                        $statusClass = $status === 'hired' ? 'hired' : ($status === 'declined' ? 'declined' : 'pending');
                    ?>
                        <tr>
                            <td>
                                <div class="user-info-cell">
                                    <div class="user-avatar-table">
                                        <?= $initials ?: '?' ?>
                                    </div>
                                    <div class="user-details">
                                        <div class="user-name">
                                            <?= h($volunteerSignup->first_name . ' ' . $volunteerSignup->last_name) ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-email">
                                    <i class="bi bi-envelope me-1"></i>
                                    <?= h($volunteerSignup->email) ?>
                                </div>
                            </td>
                            <td>
                                <div class="user-email">
                                    <i class="bi bi-telephone me-1"></i>
                                    <?= h($volunteerSignup->phone) ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($volunteerSignup->documents): ?>
                                    <div class="file-info">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <span>Available</span>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="status-badge <?= $statusClass ?>">
                                    <?php if ($statusClass === 'hired'): ?>
                                        <i class="bi bi-check-circle"></i>
                                    <?php elseif ($statusClass === 'declined'): ?>
                                        <i class="bi bi-x-circle"></i>
                                    <?php else: ?>
                                        <i class="bi bi-clock"></i>
                                    <?php endif; ?>
                                    <?= h(ucfirst($volunteerSignup->status ?? 'Pending')) ?>
                                </span>
                            </td>
                            <td>
                                <div class="user-email">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    <?= $volunteerSignup->created ? $volunteerSignup->created->format('M d, Y') : '-' ?>
                                </div>
                            </td>
                    <td class="actions">
                                <div class="action-buttons">
                                    <?= $this->Html->link(
                                        '<i class="bi bi-eye"></i>',
                                        ['action' => 'view', $volunteerSignup->id],
                                        ['class' => 'btn-action', 'title' => 'View', 'escape' => false]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="bi bi-pencil"></i>',
                                        ['action' => 'edit', $volunteerSignup->id],
                                        ['class' => 'btn-action', 'title' => 'Edit', 'escape' => false]
                                    ) ?>
                        <?= $this->Form->postLink(
                                        '<i class="bi bi-trash"></i>',
                            ['action' => 'delete', $volunteerSignup->id],
                            [
                                            'class' => 'btn-action danger',
                                            'title' => 'Delete',
                                            'confirm' => __('Are you sure you want to delete signup for {0}?', $volunteerSignup->first_name . ' ' . $volunteerSignup->last_name),
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
            <h3>No Volunteer Signups</h3>
            <p>There are no volunteer signup requests at the moment.</p>
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

        // Auto submit filters when status changes
        const statusSelect = document.querySelector('.filter-select[name="status"]');
        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                // Keep existing filter values
                const urlParams = new URLSearchParams(window.location.search);
                const form = this.closest('form');
                
                if (urlParams.get('search')) {
                    if (!form.querySelector('input[name="search"]')) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'search';
                        input.value = urlParams.get('search');
                        form.appendChild(input);
                    }
                }
                if (urlParams.get('date_from')) {
                    if (!form.querySelector('input[name="date_from"]')) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'date_from';
                        input.value = urlParams.get('date_from');
                        form.appendChild(input);
                    }
                }
                if (urlParams.get('date_to')) {
                    if (!form.querySelector('input[name="date_to"]')) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'date_to';
                        input.value = urlParams.get('date_to');
                        form.appendChild(input);
                    }
                }
                
                form.submit();
            });
        }

        // Date range validation and auto submit
        const dateFromInput = document.querySelector('.filter-input[name="date_from"]');
        const dateToInput = document.querySelector('.filter-input[name="date_to"]');
        
        function validateDateRange() {
            if (dateFromInput && dateToInput && dateFromInput.value && dateToInput.value) {
                const fromDate = new Date(dateFromInput.value);
                const toDate = new Date(dateToInput.value);
                const diffTime = Math.abs(toDate - fromDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                if (diffDays > 15) {
                    alert('Date range cannot exceed 15 days. Please select a smaller range.');
                    dateToInput.value = '';
                    return false;
                }
                
                if (fromDate > toDate) {
                    alert('Start date must be before or equal to end date.');
                    dateToInput.value = '';
                    return false;
                }
            }
            return true;
        }
        
        function preserveFilters(form) {
            const urlParams = new URLSearchParams(window.location.search);
            
            if (urlParams.get('search')) {
                if (!form.querySelector('input[name="search"]')) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'search';
                    input.value = urlParams.get('search');
                    form.appendChild(input);
                }
            }
            if (urlParams.get('status') && urlParams.get('status') !== 'all') {
                if (!form.querySelector('input[name="status"]')) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'status';
                    input.value = urlParams.get('status');
                    form.appendChild(input);
                }
            }
        }
        
        if (dateFromInput) {
            dateFromInput.addEventListener('change', function() {
                if (dateToInput && dateToInput.value) {
                    if (!validateDateRange()) {
                        return;
                    }
                }
                const form = this.closest('form');
                preserveFilters(form);
                form.submit();
            });
        }
        
        if (dateToInput) {
            dateToInput.addEventListener('change', function() {
                if (!validateDateRange()) {
                    return;
                }
                const form = this.closest('form');
                preserveFilters(form);
                form.submit();
            });
        }
    });
</script>

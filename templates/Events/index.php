<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Event> $events
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

    .event-title-cell {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .event-title {
        font-weight: 600;
        color: var(--m3-on-surface);
        font-size: 1rem;
    }

    .event-host {
        font-size: 0.875rem;
        color: var(--m3-outline);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .event-host i {
        color: var(--m3-primary);
    }

    .event-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        color: var(--m3-on-surface);
    }

    .event-info i {
        color: var(--m3-primary);
    }

    .organisation-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.875rem;
        background: var(--m3-primary-container);
        color: var(--m3-primary);
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

    .status-badge.preparing {
        background: #FEF3C7;
        color: #92400E;
    }

    .status-badge.ready {
        background: #D1FAE5;
        color: #065F46;
    }

    .status-badge.archive {
        background: var(--m3-surface-variant);
        color: var(--m3-on-surface);
    }

    .status-badge.failed {
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

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <i class="bi bi-calendar-event-fill"></i>
            Events Management
        </h1>
        <p class="page-subtitle">Manage and organize all your events</p>
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
            <?= $this->Form->text('keyword', [
                'value' => $keyword ?? '',
                'placeholder' => 'Search by title, location, or organisation...',
                'class' => 'form-control'
            ]) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="search-actions">
            <?= $this->Html->link(
                '<i class="bi bi-plus-circle"></i> New Event',
                ['action' => 'add'],
                ['class' => 'btn-add', 'escape' => false]
            ) ?>
        </div>
    </div>

    <!-- Table -->
    <?php if (count($events) > 0): ?>
    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('title', 'Event Title') ?></th>
                    <th><?= $this->Paginator->sort('location', 'Location') ?></th>
                    <th><?= $this->Paginator->sort('event_date', 'Date') ?></th>
                    <th>Organisation</th>
                    <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): 
                    $status = strtolower(str_replace(' ', '-', $event->status ?? ''));
                    $statusClass = match($status) {
                        'preparing' => 'preparing',
                        'ready-to-go' => 'ready',
                        'archive' => 'archive',
                        'failed' => 'failed',
                        default => 'default'
                    };
                ?>
                    <tr>
                        <td>
                            <div class="event-title-cell">
                                <div class="event-title"><?= h($event->title) ?></div>
                                <?php if ($event->host): ?>
                                    <div class="event-host">
                                        <i class="bi bi-person"></i>
                                        <?= h($event->host) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <div class="event-info">
                                <i class="bi bi-geo-alt"></i>
                                <span><?= h($event->location) ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="event-info">
                                <i class="bi bi-calendar3"></i>
                                <span><?= $event->event_date ? $event->event_date->format('M d, Y') : '—' ?></span>
                            </div>
                        </td>
                        <td>
                            <?php if ($event->organisation): ?>
                                <span class="organisation-badge">
                                    <i class="bi bi-building"></i>
                                    <?= h($event->organisation->org_name) ?>
                                </span>
                            <?php else: ?>
                                <span style="color: var(--m3-outline);">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="status-badge <?= $statusClass ?>">
                                <?php if ($statusClass === 'preparing'): ?>
                                    <i class="bi bi-tools"></i>
                                <?php elseif ($statusClass === 'ready'): ?>
                                    <i class="bi bi-check-circle"></i>
                                <?php elseif ($statusClass === 'archive'): ?>
                                    <i class="bi bi-archive"></i>
                                <?php elseif ($statusClass === 'failed'): ?>
                                    <i class="bi bi-x-circle"></i>
                                <?php else: ?>
                                    <i class="bi bi-circle"></i>
                                <?php endif; ?>
                                <?= h($event->status) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <?= $this->Html->link(
                                    '<i class="bi bi-eye"></i>',
                                    ['action' => 'view', $event->id],
                                    ['class' => 'btn-action', 'title' => 'View', 'escape' => false]
                                ) ?>
                                <?= $this->Html->link(
                                    '<i class="bi bi-pencil"></i>',
                                    ['action' => 'edit', $event->id],
                                    ['class' => 'btn-action', 'title' => 'Edit', 'escape' => false]
                                ) ?>
                                <?= $this->Form->postLink(
                                    '<i class="bi bi-trash"></i>',
                                    ['action' => 'delete', $event->id],
                                    [
                                        'class' => 'btn-action danger',
                                        'title' => 'Delete',
                                        'confirm' => __('Are you sure you want to delete "{0}"?', $event->title),
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
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} event(s) out of {{count}} total')) ?>
        </div>
    </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h3>No Events Found</h3>
            <p>There are no events at the moment. Try adjusting your search or add a new event.</p>
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

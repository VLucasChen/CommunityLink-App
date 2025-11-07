<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary"><i class="bi bi-calendar-event"></i> Events Management</h2>
        <?= $this->Html->link('➕ Add Event', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
    </div>

    <!-- Search -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-2 align-items-center']) ?>
            <div class="col-md-10">
                <?= $this->Form->control('keyword', [
                    'label' => false,
                    'value' => $keyword,
                    'placeholder' => 'Search by title, location, or organisation...',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-2">
                <?= $this->Form->button('Search', ['class' => 'btn btn-primary w-100']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th><?= $this->Paginator->sort('title', 'Title') ?></th>
                        <th><?= $this->Paginator->sort('location', 'Location') ?></th>
                        <th><?= $this->Paginator->sort('event_date', 'Date') ?></th>
                        <th>Organisation</th>
                        <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?= h($event->title) ?></td>
                            <td><?= h($event->location) ?></td>
                            <td><?= h($event->event_date) ?></td>
                            <td><?= $event->organisation ? h($event->organisation->org_name) : '—' ?></td>
                            <td>
                                <?php
                                    $badge = match ($event->status) {
                                        'Preparing' => 'warning',
                                        'Ready to go' => 'success',
                                        'Archive' => 'secondary',
                                        'Failed' => 'danger',
                                        default => 'light'
                                    };
                                ?>
                                <span class="badge bg-<?= $badge ?>"><?= h($event->status) ?></span>
                            </td>
                            <td class="text-center">
                                <?= $this->Html->link('View', ['action' => 'view', $event->id], ['class' => 'btn btn-sm btn-outline-primary me-1']) ?>
                                <?= $this->Html->link('Edit', ['action' => 'edit', $event->id], ['class' => 'btn btn-sm btn-outline-warning me-1']) ?>
                                <?= $this->Form->postLink('Delete', ['action' => 'delete', $event->id], [
                                    'confirm' => 'Are you sure?',
                                    'class' => 'btn btn-sm btn-outline-danger'
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between align-items-center">
        <div><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} events out of {{count}}')) ?></div>
        <ul class="pagination mb-0">
            <?= $this->Paginator->first('<< First') ?>
            <?= $this->Paginator->prev('< Prev') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('Next >') ?>
            <?= $this->Paginator->last('Last >>') ?>
        </ul>
    </div>
</div>

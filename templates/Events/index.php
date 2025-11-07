<div class="events index content">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><?= __('Events') ?></h2>
        <?= $this->Html->link(__('Add Event'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>

    <!-- Form tìm kiếm -->
    <?= $this->Form->create(null, ['type' => 'get', 'class' => 'mb-3 d-flex']) ?>
        <?= $this->Form->control('keyword', [
            'label' => false,
            'value' => $keyword,
            'placeholder' => 'Search by event or organisation...',
            'class' => 'form-control me-2'
        ]) ?>
        <?= $this->Form->button(__('Search'), ['class' => 'btn btn-success']) ?>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary ms-2">Clear</a>
    <?= $this->Form->end() ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name', 'Event Name') ?></th>
                    <th><?= $this->Paginator->sort('start_date') ?></th>
                    <th><?= $this->Paginator->sort('end_date') ?></th>
                    <th><?= __('Organisation') ?></th>
                    <th><?= __('Status') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= h($event->id) ?></td>
                    <td><?= h($event->name) ?></td>
                    <td><?= h($event->start_date) ?></td>
                    <td><?= h($event->end_date) ?></td>
                    <td><?= h($event->organisation->name ?? '-') ?></td>
                    <td>
                        <?php if ($event->status === 'Archived'): ?>
                            <span class="badge bg-secondary">Archived</span>
                        <?php else: ?>
                            <span class="badge bg-success">Active</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $event->id], ['class' => 'btn btn-sm btn-outline-info']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id], ['class' => 'btn btn-sm btn-outline-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], [
                            'confirm' => __('Are you sure you want to delete # {0}?', $event->id),
                            'class' => 'btn btn-sm btn-outline-danger'
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="paginator mt-4">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('<<') ?>
            <?= $this->Paginator->prev('<') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('>') ?>
            <?= $this->Paginator->last('>>') ?>
        </ul>
        <p class="text-center text-muted">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </p>
    </div>
</div>

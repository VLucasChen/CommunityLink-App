<div class="events index content">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><?= __('Events') ?></h2>
        <?= $this->Html->link(__('Add Event'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?= $this->Form->create(null, ['type' => 'get', 'class' => 'mb-3 d-flex']) ?>
        <?= $this->Form->control('keyword', [
            'label' => false,
            'value' => $keyword,
            'placeholder' => 'Search by title, location, or organisation...',
            'class' => 'form-control me-2'
        ]) ?>
        <?= $this->Form->button(__('Search'), ['class' => 'btn btn-success']) ?>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary ms-2">Clear</a>
    <?= $this->Form->end() ?>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('location') ?></th>
                    <th><?= $this->Paginator->sort('event_date') ?></th>
                    <th><?= __('Organisation') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= h($event->title) ?></td>
                    <td><?= h($event->location) ?></td>
                    <td><?= h($event->event_date) ?></td>
                    <td><?= h($event->organisation->org_name ?? '-') ?></td>
                    <td><?= h($event->status) ?></td>
                    <td class="text-center">
                        <?= $this->Html->link('View', ['action' => 'view', $event->id], ['class' => 'btn btn-sm btn-outline-info']) ?>
                        <?= $this->Html->link('Edit', ['action' => 'edit', $event->id], ['class' => 'btn btn-sm btn-outline-warning']) ?>
                        <?= $this->Form->postLink('Delete', ['action' => 'delete', $event->id], [
                            'confirm' => __('Are you sure you want to delete "{0}"?', $event->title),
                            'class' => 'btn btn-sm btn-outline-danger'
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="paginator mt-3">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('<<') ?>
            <?= $this->Paginator->prev('<') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('>') ?>
            <?= $this->Paginator->last('>>') ?>
        </ul>
        <p class="text-center text-muted">
            <?= $this->Paginator->counter('{{current}} of {{count}} total') ?>
        </p>
    </div>
</div>

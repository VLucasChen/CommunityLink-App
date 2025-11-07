<div class="events view content">
    <h3><?= h($event->name) ?></h3>
    <table class="table table-bordered table-striped">
        <tr><th><?= __('ID') ?></th><td><?= h($event->id) ?></td></tr>
        <tr><th><?= __('Organisation') ?></th><td><?= h($event->organisation->name ?? '-') ?></td></tr>
        <tr><th><?= __('Start Date') ?></th><td><?= h($event->start_date) ?></td></tr>
        <tr><th><?= __('End Date') ?></th><td><?= h($event->end_date) ?></td></tr>
        <tr><th><?= __('Status') ?></th><td><?= h($event->status ?? 'Active') ?></td></tr>
        <tr><th><?= __('Description') ?></th><td><?= nl2br(h($event->description)) ?></td></tr>
    </table>

    <div class="mt-3">
        <?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id], ['class' => 'btn btn-warning']) ?>
        <?= $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
    </div>
</div>

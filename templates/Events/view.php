<div class="events view content">
    <h2><?= h($event->title) ?></h2>
    <table class="table table-bordered">
        <tr><th>Location</th><td><?= h($event->location) ?></td></tr>
        <tr><th>Date</th><td><?= h($event->event_date) ?></td></tr>
        <tr><th>Host</th><td><?= h($event->host) ?></td></tr>
        <tr><th>Organisation</th><td><?= h($event->organisation->org_name ?? '-') ?></td></tr>
        <tr><th>Status</th><td><?= h($event->status) ?></td></tr>
        <tr><th>Description</th><td><?= h($event->event_description) ?></td></tr>
        <tr><th>Required Equipment</th><td><?= h($event->required_equipment) ?></td></tr>
        <tr><th>Required Skills</th><td><?= h($event->required_skills) ?></td></tr>
        <tr><th>Number of Required Crews</th><td><?= h($event->number_of_required_crews) ?></td></tr>
        <tr><th>Contact Person</th><td><?= h($event->contact_person_full_name) ?> (<?= h($event->contact_person_email) ?>)</td></tr>
    </table>

    <div class="d-flex gap-2">
        <?= $this->Html->link('Edit', ['action' => 'edit', $event->id], ['class' => 'btn btn-warning']) ?>
        <?= $this->Form->postLink('Delete', ['action' => 'delete', $event->id], [
            'confirm' => __('Are you sure you want to delete "{0}"?', $event->title),
            'class' => 'btn btn-danger'
        ]) ?>
        <?= $this->Html->link('Back to List', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
    </div>
</div>

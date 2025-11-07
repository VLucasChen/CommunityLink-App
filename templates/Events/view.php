<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary"><i class="bi bi-info-circle"></i> Event Details</h2>
        <?= $this->Html->link('← Back', ['action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold text-primary mb-3"><?= h($event->title) ?></h4>
            <table class="table table-borderless">
                <tbody>
                    <tr><th>ID</th><td><?= h($event->id) ?></td></tr>
                    <tr><th>Title</th><td><?= h($event->title) ?></td></tr>
                    <tr><th>Location</th><td><?= h($event->location) ?></td></tr>
                    <tr><th>Host</th><td><?= h($event->host) ?></td></tr>
                    <tr><th>Date</th><td><?= h($event->event_date) ?></td></tr>
                    <tr><th>Event Size</th><td><?= h($event->event_size) ?></td></tr>
                    <tr><th>Contact Person</th><td><?= h($event->contact_person_full_name) ?></td></tr>
                    <tr><th>Email</th><td><?= h($event->contact_person_email) ?></td></tr>
                    <tr><th>Description</th><td><?= nl2br(h($event->event_description)) ?></td></tr>
                    <tr><th>Required Equipment</th><td><?= nl2br(h($event->required_equipment)) ?></td></tr>
                    <tr><th>Required Skills</th><td><?= nl2br(h($event->required_skills)) ?></td></tr>
                    <tr><th>Crews Needed</th><td><?= h($event->number_of_required_crews) ?></td></tr>
                    <tr>
                        <th>Status</th>
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
                    </tr>
                    <tr><th>Organisation</th><td><?= $event->organisation ? h($event->organisation->org_name) : '—' ?></td></tr>
                    <tr><th>Created</th><td><?= h($event->created) ?></td></tr>
                    <tr><th>Modified</th><td><?= h($event->modified) ?></td></tr>
                </tbody>
            </table>

            <div class="mt-3">
                <?= $this->Html->link('✏️ Edit', ['action' => 'edit', $event->id], ['class' => 'btn btn-warning me-2']) ?>
                <?= $this->Form->postLink('🗑 Delete', ['action' => 'delete', $event->id], [
                    'confirm' => 'Are you sure you want to delete this event?',
                    'class' => 'btn btn-danger me-2'
                ]) ?>
                <?= $this->Html->link('📋 All Events', ['action' => 'index'], ['class' => 'btn btn-outline-primary']) ?>
            </div>
        </div>
    </div>
</div>

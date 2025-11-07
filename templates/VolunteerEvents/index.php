<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\VolunteerEvent> $volunteerEvents
 * @var \App\Model\Entity\VolunteerEvent $volunteerEvent
 * @var array $events
 * @var array $volunteers
 */
$this->Html->css([
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css'
], ['block' => true]);

$modalId = 'veModal';
?>

<div class="container-fluid py-4">

    <?= $this->Flash->render() ?>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>" onclick="setModal('add')">
            Assign Volunteer
        </button>
    </div>

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient bg-primary text-white py-3">
            <h4 class="mb-0">Volunteer Assignments</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Event</th>
                            <th>Volunteer</th>
                            <th>Assigned</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($volunteerEvents)): ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                No assignments.
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($volunteerEvents as $ve): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-semibold">
                                    <?= $ve->hasValue('event')
                                        ? $this->Html->link(
                                            h($ve->event->title),
                                            ['controller' => 'Events', 'action' => 'view', $ve->event->id],
                                            ['class' => 'text-decoration-none']
                                          )
                                        : '<em>—</em>' ?>
                                </div>
                                <small class="text-muted">ID: <?= h(substr($ve->id, 0, 8)) ?>...</small>
                            </td>
                            <td>
                                <?= $ve->hasValue('volunteer')
                                    ? $this->Html->link(
                                        h($ve->volunteer->first_name . ' ' . $ve->volunteer->last_name),
                                        ['controller' => 'Volunteers', 'action' => 'view', $ve->volunteer->id],
                                        ['class' => 'text-decoration-none']
                                      )
                                    : '<em>—</em>' ?>
                            </td>
                            <td><?= $ve->created?->format('d/m/Y H:i') ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-info btn-sm" onclick="setModal('view', '<?= $ve->id ?>')">
                                        View
                                    </button>
                                    <button class="btn btn-outline-warning btn-sm" onclick="setModal('edit', '<?= $ve->id ?>')">
                                        Edit
                                    </button>
                                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $ve->id], [
                                        'class' => 'btn btn-outline-danger btn-sm',
                                        'confirm' => 'Remove assignment?',
                                        'escape' => false
                                    ]) ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <div class="text-muted me-3">
            <?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} of {{count}}') ?>
        </div>
        <nav>
            <ul class="pagination shadow-sm">
                <?= $this->Paginator->prev('Previous', ['class' => 'page-link']) ?>
                <?= $this->Paginator->numbers(['class' => 'page-link']) ?>
                <?= $this->Paginator->next('Next', ['class' => 'page-link']) ?>
            </ul>
        </nav>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="<?= $modalId ?>" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header bg-gradient bg-primary text-white">
                <h5 class="modal-title fw-bold" id="modalTitle">Assign Volunteer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="modalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div style="display: none;" id="hiddenVEFields">
    <?= $this->Form->control('event_id', [
        'label' => 'Event',
        'options' => $events,
        'class' => 'form-select',
        'required' => true
    ]) ?>
    <?= $this->Form->control('volunteer_id', [
        'label' => 'Volunteer',
        'options' => $volunteers,
        'class' => 'form-select',
        'required' => true
    ]) ?>
</div>

<!-- JS -->
<?php $this->start('script'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof bootstrap === 'undefined') return;

    const veData = <?= json_encode(array_map(function($ve) {
        return [
            'id' => $ve->id,
            'event_id' => $ve->event_id,
            'event_title' => $ve->event?->title ?? null,
            'volunteer_id' => $ve->volunteer_id,
            'volunteer_name' => $ve->volunteer ? ($ve->volunteer->first_name . ' ' . $ve->volunteer->last_name) : null,
            'created' => $ve->created?->format('c')
        ];
    }, iterator_to_array($volunteerEvents))) ?>;

    window.setModal = function(mode, id = null) {
        const modalEl = document.getElementById('<?= $modalId ?>');
        const title = document.getElementById('modalTitle');
        const body = document.getElementById('modalBody');
        const modal = new bootstrap.Modal(modalEl);

        const ve = id ? veData.find(v => v.id === id) : null;
        let html = '';

        if (mode === 'view' && ve) {
            title.textContent = 'Assignment Details';
            html = `
            <div class="row g-3">
                <div class="col-12"><strong>Event:</strong> ${ve.event_title || '<em>None</em>'}</div>
                <div class="col-12"><strong>Volunteer:</strong> ${ve.volunteer_name || '<em>None</em>'}</div>
                <div class="col-12"><strong>Assigned:</strong> ${new Date(ve.created).toLocaleString()}</div>
            </div>
            <div class="text-end mt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>`;
        } else {
            const isEdit = mode === 'edit';
            title.textContent = isEdit ? 'Edit Assignment' : 'Assign Volunteer';

            const getField = (name) => {
                const el = document.querySelector(`[name="${name}"]`);
                return el ? el.closest('.col-12').outerHTML : '';
            };

            html = `
            <?= $this->Form->create(null, ['url' => ['action' => 'index'], 'id' => 'veForm']) ?>
            <?= $this->Form->hidden('id', ['value' => $volunteerEvent->id]) ?>
            <div class="row g-3">
                ${getField('event_id')}
                ${getField('volunteer_id')}
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">${isEdit ? 'Update' : 'Assign'}</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
            <?= $this->Form->end() ?>`;

            if (isEdit && ve) {
                setTimeout(() => {
                    const f = document.getElementById('veForm');
                    if (f) {
                        f.elements['id'].value = ve.id;
                        f.elements['event_id'].value = ve.event_id;
                        f.elements['volunteer_id'].value = ve.volunteer_id;
                    }
                }, 50);
            }
        }

        body.innerHTML = html;
        modal.show();
    };
});
</script>
<?php $this->end(); ?>
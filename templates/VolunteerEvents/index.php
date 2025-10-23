<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\VolunteerEvent> $volunteerEvents
 */
?>
<div class="volunteerEvents index content">
    <?= $this->Html->link(__('New Volunteer Event'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Volunteer Events') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('event_id') ?></th>
                    <th><?= $this->Paginator->sort('volunteer_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($volunteerEvents as $volunteerEvent): ?>
                <tr>
                    <td><?= h($volunteerEvent->id) ?></td>
                    <td><?= $volunteerEvent->hasValue('event') ? $this->Html->link($volunteerEvent->event->title, ['controller' => 'Events', 'action' => 'view', $volunteerEvent->event->event_id]) : '' ?></td>
                    <td><?= $volunteerEvent->hasValue('volunteer') ? $this->Html->link($volunteerEvent->volunteer->full_name, ['controller' => 'Volunteers', 'action' => 'view', $volunteerEvent->volunteer->volunteer_id]) : '' ?></td>
                    <td><?= h($volunteerEvent->created) ?></td>
                    <td><?= h($volunteerEvent->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $volunteerEvent->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $volunteerEvent->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $volunteerEvent->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $volunteerEvent->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
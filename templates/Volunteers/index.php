<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Volunteer> $volunteers
 */
?>
<div class="volunteers index content">
    <?= $this->Html->link(__('New Volunteer'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Volunteers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('phone') ?></th>
                    <th><?= $this->Paginator->sort('profile_picture') ?></th>
                    <th><?= $this->Paginator->sort('documents') ?></th>
                    <th><?= $this->Paginator->sort('date_submitted') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($volunteers as $volunteer): ?>
                <tr>
                    <td><?= h($volunteer->id) ?></td>
                    <td><?= h($volunteer->first_name) ?></td>
                    <td><?= h($volunteer->last_name) ?></td>
                    <td><?= h($volunteer->email) ?></td>
                    <td><?= h($volunteer->phone) ?></td>
                    <td><?= h($volunteer->profile_picture) ?></td>
                    <td><?= h($volunteer->documents) ?></td>
                    <td><?= h($volunteer->date_submitted) ?></td>
                    <td><?= h($volunteer->status) ?></td>
                    <td><?= h($volunteer->created) ?></td>
                    <td><?= h($volunteer->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $volunteer->volunteer_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $volunteer->volunteer_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $volunteer->volunteer_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $volunteer->volunteer_id),
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
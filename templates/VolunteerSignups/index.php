<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\VolunteerSignup> $volunteerSignups
 */
?>
<div class="volunteerSignups index content">
    <?= $this->Html->link(__('New Volunteer Signup'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Volunteer Signups') ?></h3>
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
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($volunteerSignups as $volunteerSignup): ?>
                <tr>
                    <td><?= h($volunteerSignup->id) ?></td>
                    <td><?= h($volunteerSignup->first_name) ?></td>
                    <td><?= h($volunteerSignup->last_name) ?></td>
                    <td><?= h($volunteerSignup->email) ?></td>
                    <td><?= h($volunteerSignup->phone) ?></td>
                    <td><?= h($volunteerSignup->profile_picture) ?></td>
                    <td><?= h($volunteerSignup->documents) ?></td>
                    <td><?= h($volunteerSignup->status) ?></td>
                    <td><?= h($volunteerSignup->created) ?></td>
                    <td><?= h($volunteerSignup->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $volunteerSignup->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $volunteerSignup->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $volunteerSignup->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $volunteerSignup->id),
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
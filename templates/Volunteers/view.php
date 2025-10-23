<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Volunteer $volunteer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Volunteer'), ['action' => 'edit', $volunteer->volunteer_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Volunteer'), ['action' => 'delete', $volunteer->volunteer_id], ['confirm' => __('Are you sure you want to delete # {0}?', $volunteer->volunteer_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Volunteers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Volunteer'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="volunteers view content">
            <h3><?= h($volunteer->full_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($volunteer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($volunteer->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($volunteer->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($volunteer->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($volunteer->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Profile Picture') ?></th>
                    <td><?= h($volunteer->profile_picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Documents') ?></th>
                    <td><?= h($volunteer->documents) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($volunteer->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Submitted') ?></th>
                    <td><?= h($volunteer->date_submitted) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($volunteer->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($volunteer->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Skills') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($volunteer->skills)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Availability') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($volunteer->availability)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Self Intro') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($volunteer->self_intro)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
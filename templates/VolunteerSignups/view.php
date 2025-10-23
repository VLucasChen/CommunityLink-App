<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VolunteerSignup $volunteerSignup
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Volunteer Signup'), ['action' => 'edit', $volunteerSignup->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Volunteer Signup'), ['action' => 'delete', $volunteerSignup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $volunteerSignup->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Volunteer Signups'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Volunteer Signup'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="volunteerSignups view content">
            <h3><?= h($volunteerSignup->first_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($volunteerSignup->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($volunteerSignup->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($volunteerSignup->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($volunteerSignup->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($volunteerSignup->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Profile Picture') ?></th>
                    <td><?= h($volunteerSignup->profile_picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Documents') ?></th>
                    <td><?= h($volunteerSignup->documents) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($volunteerSignup->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($volunteerSignup->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($volunteerSignup->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Skills') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($volunteerSignup->skills)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Interests') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($volunteerSignup->interests)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Message') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($volunteerSignup->message)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
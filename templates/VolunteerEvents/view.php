<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VolunteerEvent $volunteerEvent
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Volunteer Event'), ['action' => 'edit', $volunteerEvent->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Volunteer Event'), ['action' => 'delete', $volunteerEvent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $volunteerEvent->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Volunteer Events'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Volunteer Event'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="volunteerEvents view content">
            <h3><?= h($volunteerEvent->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($volunteerEvent->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Event') ?></th>
                    <td><?= $volunteerEvent->hasValue('event') ? $this->Html->link($volunteerEvent->event->title, ['controller' => 'Events', 'action' => 'view', $volunteerEvent->event->event_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Volunteer') ?></th>
                    <td><?= $volunteerEvent->hasValue('volunteer') ? $this->Html->link($volunteerEvent->volunteer->full_name, ['controller' => 'Volunteers', 'action' => 'view', $volunteerEvent->volunteer->volunteer_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($volunteerEvent->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($volunteerEvent->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
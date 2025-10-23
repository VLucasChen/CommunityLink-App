<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VolunteerEvent $volunteerEvent
 * @var string[]|\Cake\Collection\CollectionInterface $events
 * @var string[]|\Cake\Collection\CollectionInterface $volunteers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $volunteerEvent->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $volunteerEvent->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Volunteer Events'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="volunteerEvents form content">
            <?= $this->Form->create($volunteerEvent) ?>
            <fieldset>
                <legend><?= __('Edit Volunteer Event') ?></legend>
                <?php
                    echo $this->Form->control('event_id', ['options' => $events]);
                    echo $this->Form->control('volunteer_id', ['options' => $volunteers]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

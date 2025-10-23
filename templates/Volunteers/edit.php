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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $volunteer->volunteer_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $volunteer->volunteer_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Volunteers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="volunteers form content">
            <?= $this->Form->create($volunteer) ?>
            <fieldset>
                <legend><?= __('Edit Volunteer') ?></legend>
                <?php
                    echo $this->Form->control('id');
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('skills');
                    echo $this->Form->control('profile_picture');
                    echo $this->Form->control('documents');
                    echo $this->Form->control('availability');
                    echo $this->Form->control('self_intro');
                    echo $this->Form->control('date_submitted', ['empty' => true]);
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

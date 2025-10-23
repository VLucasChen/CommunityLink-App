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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $volunteerSignup->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $volunteerSignup->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Volunteer Signups'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="volunteerSignups form content">
            <?= $this->Form->create($volunteerSignup) ?>
            <fieldset>
                <legend><?= __('Edit Volunteer Signup') ?></legend>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('skills');
                    echo $this->Form->control('interests');
                    echo $this->Form->control('message');
                    echo $this->Form->control('profile_picture');
                    echo $this->Form->control('documents');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

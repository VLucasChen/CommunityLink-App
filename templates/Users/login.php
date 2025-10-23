<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="users form content">
            <h3><?= __('Login to CommunityLink') ?></h3>
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Please enter your username and password') ?></legend>
                <?php
                    echo $this->Form->control('username', ['required' => true]);
                    echo $this->Form->control('password', ['required' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Login')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

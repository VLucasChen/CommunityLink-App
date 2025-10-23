<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organisation $organisation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $organisation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $organisation->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Organisations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="organisations form content">
            <?= $this->Form->create($organisation) ?>
            <fieldset>
                <legend><?= __('Edit Organisation') ?></legend>
                <?php
                    echo $this->Form->control('org_name');
                    echo $this->Form->control('business_address');
                    echo $this->Form->control('contact_person_full_name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('industry');
                    echo $this->Form->control('help_description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

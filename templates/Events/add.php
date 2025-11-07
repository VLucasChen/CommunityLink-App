<div class="events form content">
    <h2><?= isset($event->id) ? __('Edit Event') : __('Add Event') ?></h2>
    <?= $this->Form->create($event) ?>
    <fieldset>
        <?= $this->Form->control('title') ?>
        <?= $this->Form->control('location') ?>
        <?= $this->Form->control('host') ?>
        <?= $this->Form->control('event_date', ['type' => 'date']) ?>
        <?= $this->Form->control('event_size') ?>
        <?= $this->Form->control('contact_person_full_name') ?>
        <?= $this->Form->control('contact_person_email') ?>
        <?= $this->Form->control('event_description', ['type' => 'textarea']) ?>
        <?= $this->Form->control('required_equipment', ['type' => 'textarea']) ?>
        <?= $this->Form->control('required_skills', ['type' => 'textarea']) ?>
        <?= $this->Form->control('number_of_required_crews') ?>
        <?= $this->Form->control('status', [
            'type' => 'select',
            'options' => [
                'Preparing' => 'Preparing',
                'Ready to go' => 'Ready to go',
                'Archive' => 'Archive',
                'Failed' => 'Failed'
            ]
        ]) ?>
        <?= $this->Form->control('organisation_id', [
            'type' => 'select',
            'options' => $organisations,
            'empty' => 'Select Organisation'
        ]) ?>
    </fieldset>
    <div class="mt-3">
        <?= $this->Form->button(__('Save Event'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>

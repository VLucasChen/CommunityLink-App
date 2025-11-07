<div class="events form content">
    <h3><?= __('Add New Event') ?></h3>
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Event Details') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description', ['type' => 'textarea']);
            echo $this->Form->control('start_date', ['type' => 'date']);
            echo $this->Form->control('end_date', ['type' => 'date']);
            echo $this->Form->control('organisation_id', [
                'label' => 'Organisation',
                'options' => $organisations,
                'empty' => true
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save Event'), ['class' => 'btn btn-primary mt-3']) ?>
    <?= $this->Form->end() ?>
</div>

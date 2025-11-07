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
            <?= $this->Html->link(__('Edit Organisation'), ['action' => 'edit', $organisation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Organisation'), ['action' => 'delete', $organisation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organisation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Organisations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Organisation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="organisations view content">
            <h3><?= h($organisation->org_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($organisation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Org Name') ?></th>
                    <td><?= h($organisation->org_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contact Person Full Name') ?></th>
                    <td><?= h($organisation->contact_person_full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($organisation->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($organisation->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Industry') ?></th>
                    <td><?= h($organisation->industry) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($organisation->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($organisation->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Business Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($organisation->business_address)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Help Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($organisation->help_description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Events') ?></h4>
                <?php if (!empty($organisation->events)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Location') ?></th>
                            <th><?= __('Host') ?></th>
                            <th><?= __('Event Date') ?></th>
                            <th><?= __('Event Size') ?></th>
                            <th><?= __('Contact Person Full Name') ?></th>
                            <th><?= __('Contact Person Email') ?></th>
                            <th><?= __('Event Description') ?></th>
                            <th><?= __('Required Equipment') ?></th>
                            <th><?= __('Required Skills') ?></th>
                            <th><?= __('Number Of Required Crews') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Organisation Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organisation->events as $event) : ?>
                        <tr>
                            <td><?= h($event->id) ?></td>
                            <td><?= h($event->title) ?></td>
                            <td><?= h($event->location) ?></td>
                            <td><?= h($event->host) ?></td>
                            <td><?= h($event->event_date) ?></td>
                            <td><?= h($event->event_size) ?></td>
                            <td><?= h($event->contact_person_full_name) ?></td>
                            <td><?= h($event->contact_person_email) ?></td>
                            <td><?= h($event->event_description) ?></td>
                            <td><?= h($event->required_equipment) ?></td>
                            <td><?= h($event->required_skills) ?></td>
                            <td><?= h($event->number_of_required_crews) ?></td>
                            <td><?= h($event->status) ?></td>
                            <td><?= h($event->organisation_id) ?></td>
                            <td><?= h($event->created) ?></td>
                            <td><?= h($event->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Events', 'action' => 'view', $event->event_id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Events', 'action' => 'edit', $event->event_id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Events', 'action' => 'delete', $event->event_id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $event->event_id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
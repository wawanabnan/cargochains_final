<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $location
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Location'), ['action' => 'edit', $location->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Location'), ['action' => 'delete', $location->id], ['confirm' => __('Are you sure you want to delete # {0}?', $location->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Locations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Location'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="locations view content">
            <h3><?= h($location->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($location->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($location->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Kind') ?></th>
                    <td><?= h($location->kind) ?></td>
                </tr>
                <tr>
                    <th><?= __('Parent Location') ?></th>
                    <td><?= $location->hasValue('parent_location') ? $this->Html->link($location->parent_location->name, ['controller' => 'Locations', 'action' => 'view', $location->parent_location->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Iata Code') ?></th>
                    <td><?= h($location->iata_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Unlocode') ?></th>
                    <td><?= h($location->unlocode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($location->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lft') ?></th>
                    <td><?= $this->Number->format($location->lft) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rght') ?></th>
                    <td><?= $this->Number->format($location->rght) ?></td>
                </tr>
                <tr>
                    <th><?= __('Latitude') ?></th>
                    <td><?= $this->Number->format($location->latitude) ?></td>
                </tr>
                <tr>
                    <th><?= __('Longitude') ?></th>
                    <td><?= $this->Number->format($location->longitude) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Locations') ?></h4>
                <?php if (!empty($location->child_locations)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Code') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Kind') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Lft') ?></th>
                            <th><?= __('Rght') ?></th>
                            <th><?= __('Iata Code') ?></th>
                            <th><?= __('Unlocode') ?></th>
                            <th><?= __('Latitude') ?></th>
                            <th><?= __('Longitude') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($location->child_locations as $childLocation) : ?>
                        <tr>
                            <td><?= h($childLocation->id) ?></td>
                            <td><?= h($childLocation->code) ?></td>
                            <td><?= h($childLocation->name) ?></td>
                            <td><?= h($childLocation->kind) ?></td>
                            <td><?= h($childLocation->parent_id) ?></td>
                            <td><?= h($childLocation->lft) ?></td>
                            <td><?= h($childLocation->rght) ?></td>
                            <td><?= h($childLocation->iata_code) ?></td>
                            <td><?= h($childLocation->unlocode) ?></td>
                            <td><?= h($childLocation->latitude) ?></td>
                            <td><?= h($childLocation->longitude) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Locations', 'action' => 'view', $childLocation->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Locations', 'action' => 'edit', $childLocation->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Locations', 'action' => 'delete', $childLocation->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $childLocation->id),
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
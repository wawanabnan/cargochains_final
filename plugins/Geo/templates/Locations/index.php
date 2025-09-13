<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $locations
 */
?>
<div class="locations index content">
    <?= $this->Html->link(__('New Location'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Locations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('kind') ?></th>
                    <th><?= $this->Paginator->sort('parent_id') ?></th>
                    <th><?= $this->Paginator->sort('iata_code') ?></th>
                    <th><?= $this->Paginator->sort('unlocode') ?></th>
                    <th><?= $this->Paginator->sort('latitude') ?></th>
                    <th><?= $this->Paginator->sort('longitude') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($locations as $location): ?>
                <tr>
                    <td><?= $this->Number->format($location->id) ?></td>
                    <td><?= h($location->code) ?></td>
                    <td><?= h($location->name) ?></td>
                    <td><?= h($location->kind) ?></td>
                    <td><?= $location->hasValue('parent_location') ? $this->Html->link($location->parent_location->name, ['controller' => 'Locations', 'action' => 'view', $location->parent_location->id]) : '' ?></td>
                    <td><?= h($location->iata_code) ?></td>
                    <td><?= h($location->unlocode) ?></td>
                   <td><?= $this->Number->format($location->latitude ?? 0, ['places' => 4]) ?></td>
					   <td><?= $this->Number->format($location->longitude ?? 0, ['places' => 4]) ?></td>

					
					
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $location->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $location->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $location->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $location->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $salesServices
 */
?>
<div class="salesServices index content">
    <?= $this->Html->link(__('New Sales Service'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sales Services') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('parent_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('transport_mode') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($salesServices as $salesService): ?>
                <tr>
                    <td><?= $this->Number->format($salesService->id) ?></td>
                    <td><?= $salesService->hasValue('parent_sales_service') ? $this->Html->link($salesService->parent_sales_service->name, ['controller' => 'SalesServices', 'action' => 'view', $salesService->parent_sales_service->id]) : '' ?></td>
                    <td><?= h($salesService->name) ?></td>
                    <td><?= h($salesService->transport_mode) ?></td>
                    <td><?= h($salesService->created) ?></td>
                    <td><?= h($salesService->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $salesService->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $salesService->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $salesService->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $salesService->id),
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
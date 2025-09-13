<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $salesQuotations
 */
?>
<div class="salesQuotations index content">
    <?= $this->Html->link(__('New Sales Quotation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sales Quotations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('number') ?></th>
                    <th><?= $this->Paginator->sort('customer_id') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('currency') ?></th>
                    <th><?= $this->Paginator->sort('subtotal') ?></th>
                    <th><?= $this->Paginator->sort('tax_total') ?></th>
                    <th><?= $this->Paginator->sort('grand_total') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($salesQuotations as $salesQuotation): ?>
                <tr>
                    <td><?= $this->Number->format($salesQuotation->id) ?></td>
                    <td><?= h($salesQuotation->number) ?></td>
                    <td><?= $salesQuotation->customer_id === null ? '' : $this->Number->format($salesQuotation->customer_id) ?></td>
                    <td><?= h($salesQuotation->date) ?></td>
                    <td><?= h($salesQuotation->currency) ?></td>
                    <td><?= $salesQuotation->subtotal === null ? '' : $this->Number->format($salesQuotation->subtotal) ?></td>
                    <td><?= $salesQuotation->tax_total === null ? '' : $this->Number->format($salesQuotation->tax_total) ?></td>
                    <td><?= $salesQuotation->grand_total === null ? '' : $this->Number->format($salesQuotation->grand_total) ?></td>
                    <td><?= h($salesQuotation->status) ?></td>
                    <td><?= h($salesQuotation->created) ?></td>
                    <td><?= h($salesQuotation->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $salesQuotation->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $salesQuotation->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $salesQuotation->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $salesQuotation->id),
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
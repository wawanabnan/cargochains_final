<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $partners
 */
?>
<div class="partners index content">
    <?= $this->Html->link(__('New Partner'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Partners') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('tax_id') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('phone') ?></th>
                    <th><?= $this->Paginator->sort('city') ?></th>
                    <th><?= $this->Paginator->sort('country') ?></th>
                    <th><?= $this->Paginator->sort('is_customer') ?></th>
                    <th><?= $this->Paginator->sort('is_vendor') ?></th>
                    <th><?= $this->Paginator->sort('is_carrier') ?></th>
                    <th><?= $this->Paginator->sort('is_agent') ?></th>
                    <th><?= $this->Paginator->sort('is_shipper') ?></th>
                    <th><?= $this->Paginator->sort('is_consignee') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partners as $partner): ?>
                <tr>
                    <td><?= $this->Number->format($partner->id) ?></td>
                    <td><?= h($partner->code) ?></td>
                    <td><?= h($partner->name) ?></td>
                    <td><?= h($partner->tax_id) ?></td>
                    <td><?= h($partner->email) ?></td>
                    <td><?= h($partner->phone) ?></td>
                    <td><?= h($partner->city) ?></td>
                    <td><?= h($partner->country) ?></td>
                    <td><?= h($partner->is_customer) ?></td>
                    <td><?= h($partner->is_vendor) ?></td>
                    <td><?= h($partner->is_carrier) ?></td>
                    <td><?= h($partner->is_agent) ?></td>
                    <td><?= h($partner->is_shipper) ?></td>
                    <td><?= h($partner->is_consignee) ?></td>
                    <td><?= h($partner->created) ?></td>
                    <td><?= h($partner->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $partner->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partner->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $partner->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $partner->id),
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
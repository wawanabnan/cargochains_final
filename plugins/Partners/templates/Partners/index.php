<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $partners
 */
?>
     <table class="table">
            <thead>
                <tr>
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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partners as $partner): ?>
                <tr>
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

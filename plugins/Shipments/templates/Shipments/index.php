<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $shipments
 */
 
 
?>
<div class="shipments index content">
    <?= $this->Html->link(__('New Shipment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Shipments') ?></h3>
	<a href="/shipments/add" class="button">Tambah Shipment</a>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('number') ?></th>
                    <th><?= $this->Paginator->sort('origin_id') ?></th>
                    <th><?= $this->Paginator->sort('destination_id') ?></th>
                    <th><?= $this->Paginator->sort('weight') ?></th>
                    <th><?= $this->Paginator->sort('volume') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('shipper_id') ?></th>
                    <th><?= $this->Paginator->sort('consignee_id') ?></th>
                    <th><?= $this->Paginator->sort('carrier_id') ?></th>
                    <th><?= $this->Paginator->sort('agency_id') ?></th>
                    <th><?= $this->Paginator->sort('etd') ?></th>
                    <th><?= $this->Paginator->sort('eta') ?></th>
                    <th><?= $this->Paginator->sort('atd') ?></th>
                    <th><?= $this->Paginator->sort('ata') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('is_multimoda') ?></th>
                    <th><?= $this->Paginator->sort('origin') ?></th>
                    <th><?= $this->Paginator->sort('destination') ?></th>
                    <th><?= $this->Paginator->sort('bill_of_lading_no') ?></th>
                    <th><?= $this->Paginator->sort('total') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shipments as $shipment): ?>
                <tr>
                    <td><?= $this->Number->format($shipment->id) ?></td>
                    <td><?= h($shipment->number) ?></td>
                    <td><?= $this->Number->format($shipment->origin_id) ?></td>
                    <td><?= $this->Number->format($shipment->destination_id) ?></td>
                    <td><?= $shipment->weight === null ? '' : $this->Number->format($shipment->weight) ?></td>
                    <td><?= $shipment->volume === null ? '' : $this->Number->format($shipment->volume) ?></td>
                    <td><?= $shipment->qty === null ? '' : $this->Number->format($shipment->qty) ?></td>
                    <td><?= $shipment->hasValue('shipper') ? $this->Html->link($shipment->shipper->name, ['controller' => 'Partners', 'action' => 'view', $shipment->shipper->id]) : '' ?></td>
                    <td><?= $shipment->hasValue('consignee') ? $this->Html->link($shipment->consignee->name, ['controller' => 'Partners', 'action' => 'view', $shipment->consignee->id]) : '' ?></td>
                    <td><?= $shipment->hasValue('carrier') ? $this->Html->link($shipment->carrier->name, ['controller' => 'Partners', 'action' => 'view', $shipment->carrier->id]) : '' ?></td>
                    <td><?= $shipment->hasValue('agency') ? $this->Html->link($shipment->agency->name, ['controller' => 'Partners', 'action' => 'view', $shipment->agency->id]) : '' ?></td>
                    <td><?= h($shipment->etd) ?></td>
                    <td><?= h($shipment->eta) ?></td>
                    <td><?= h($shipment->atd) ?></td>
                    <td><?= h($shipment->ata) ?></td>
                    <td><?= h($shipment->status) ?></td>
                    <td><?= h($shipment->is_multimoda) ?></td>
                    <td><?= h($shipment->origin) ?></td>
                    <td><?= h($shipment->destination) ?></td>
                    <td><?= h($shipment->bill_of_lading_no) ?></td>
                    <td><?= $shipment->total === null ? '' : $this->Number->format($shipment->total) ?></td>
                    <td><?= h($shipment->created) ?></td>
                    <td><?= h($shipment->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $shipment->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $shipment->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $shipment->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $shipment->id),
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
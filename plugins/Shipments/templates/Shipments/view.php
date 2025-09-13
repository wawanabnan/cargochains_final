<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $shipment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Shipment'), ['action' => 'edit', $shipment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Shipment'), ['action' => 'delete', $shipment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shipment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Shipments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Shipment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="shipments view content">
            <h3><?= h($shipment->number) ?></h3>
            <table>
                <tr>
                    <th><?= __('Number') ?></th>
                    <td><?= h($shipment->number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Shipper') ?></th>
                    <td><?= $shipment->hasValue('shipper') ? $this->Html->link($shipment->shipper->name, ['controller' => 'Partners', 'action' => 'view', $shipment->shipper->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Consignee') ?></th>
                    <td><?= $shipment->hasValue('consignee') ? $this->Html->link($shipment->consignee->name, ['controller' => 'Partners', 'action' => 'view', $shipment->consignee->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Carrier') ?></th>
                    <td><?= $shipment->hasValue('carrier') ? $this->Html->link($shipment->carrier->name, ['controller' => 'Partners', 'action' => 'view', $shipment->carrier->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Agency') ?></th>
                    <td><?= $shipment->hasValue('agency') ? $this->Html->link($shipment->agency->name, ['controller' => 'Partners', 'action' => 'view', $shipment->agency->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($shipment->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Origin') ?></th>
                    <td><?= h($shipment->origin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Destination') ?></th>
                    <td><?= h($shipment->destination) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bill Of Lading No') ?></th>
                    <td><?= h($shipment->bill_of_lading_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($shipment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Origin Id') ?></th>
                    <td><?= $this->Number->format($shipment->origin_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Destination Id') ?></th>
                    <td><?= $this->Number->format($shipment->destination_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Weight') ?></th>
                    <td><?= $shipment->weight === null ? '' : $this->Number->format($shipment->weight) ?></td>
                </tr>
                <tr>
                    <th><?= __('Volume') ?></th>
                    <td><?= $shipment->volume === null ? '' : $this->Number->format($shipment->volume) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $shipment->qty === null ? '' : $this->Number->format($shipment->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total') ?></th>
                    <td><?= $shipment->total === null ? '' : $this->Number->format($shipment->total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Etd') ?></th>
                    <td><?= h($shipment->etd) ?></td>
                </tr>
                <tr>
                    <th><?= __('Eta') ?></th>
                    <td><?= h($shipment->eta) ?></td>
                </tr>
                <tr>
                    <th><?= __('Atd') ?></th>
                    <td><?= h($shipment->atd) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ata') ?></th>
                    <td><?= h($shipment->ata) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($shipment->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($shipment->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Multimoda') ?></th>
                    <td><?= $shipment->is_multimoda ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Cargo Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($shipment->cargo_description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Shipment Routes') ?></h4>
                <?php if (!empty($shipment->shipment_routes)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Shipment Id') ?></th>
                            <th><?= __('Origin Id') ?></th>
                            <th><?= __('Destination Id') ?></th>
                            <th><?= __('Transportation Type Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($shipment->shipment_routes as $shipmentRoute) : ?>
                        <tr>
                            <td><?= h($shipmentRoute->id) ?></td>
                            <td><?= h($shipmentRoute->shipment_id) ?></td>
                            <td><?= h($shipmentRoute->origin_id) ?></td>
                            <td><?= h($shipmentRoute->destination_id) ?></td>
                            <td><?= h($shipmentRoute->transportation_type_id) ?></td>
                            <td><?= h($shipmentRoute->created) ?></td>
                            <td><?= h($shipmentRoute->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ShipmentRoutes', 'action' => 'view', $shipmentRoute->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ShipmentRoutes', 'action' => 'edit', $shipmentRoute->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'ShipmentRoutes', 'action' => 'delete', $shipmentRoute->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $shipmentRoute->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Shipment Documents') ?></h4>
                <?php if (!empty($shipment->shipment_documents)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Shipment Id') ?></th>
                            <th><?= __('Doc Type') ?></th>
                            <th><?= __('File Path') ?></th>
                            <th><?= __('Note') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($shipment->shipment_documents as $shipmentDocument) : ?>
                        <tr>
                            <td><?= h($shipmentDocument->id) ?></td>
                            <td><?= h($shipmentDocument->shipment_id) ?></td>
                            <td><?= h($shipmentDocument->doc_type) ?></td>
                            <td><?= h($shipmentDocument->file_path) ?></td>
                            <td><?= h($shipmentDocument->note) ?></td>
                            <td><?= h($shipmentDocument->created) ?></td>
                            <td><?= h($shipmentDocument->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ShipmentDocuments', 'action' => 'view', $shipmentDocument->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ShipmentDocuments', 'action' => 'edit', $shipmentDocument->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'ShipmentDocuments', 'action' => 'delete', $shipmentDocument->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $shipmentDocument->id),
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
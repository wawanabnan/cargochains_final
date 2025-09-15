<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $salesService
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Sales Service'), ['action' => 'edit', $salesService->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Sales Service'), ['action' => 'delete', $salesService->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesService->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Sales Services'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Sales Service'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="salesServices view content">
            <h3><?= h($salesService->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Parent Sales Service') ?></th>
                    <td><?= $salesService->hasValue('parent_sales_service') ? $this->Html->link($salesService->parent_sales_service->name, ['controller' => 'SalesServices', 'action' => 'view', $salesService->parent_sales_service->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($salesService->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Transport Mode') ?></th>
                    <td><?= h($salesService->transport_mode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($salesService->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lft') ?></th>
                    <td><?= $salesService->lft === null ? '' : $this->Number->format($salesService->lft) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rght') ?></th>
                    <td><?= $salesService->rght === null ? '' : $this->Number->format($salesService->rght) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($salesService->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($salesService->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Sales Orders') ?></h4>
                <?php if (!empty($salesService->sales_orders)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Number') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Valid Until') ?></th>
                            <th><?= __('Sales Service Id') ?></th>
                            <th><?= __('Currency Id') ?></th>
                            <th><?= __('Payment Term Id') ?></th>
                            <th><?= __('Notes 1') ?></th>
                            <th><?= __('Notes 2') ?></th>
                            <th><?= __('Subtotal') ?></th>
                            <th><?= __('Tax Total') ?></th>
                            <th><?= __('Grand Total') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Sales User Id') ?></th>
                            <th><?= __('Sales Agency Id') ?></th>
                            <th><?= __('Sales Reseller Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($salesService->sales_orders as $salesOrder) : ?>
                        <tr>
                            <td><?= h($salesOrder->id) ?></td>
                            <td><?= h($salesOrder->number) ?></td>
                            <td><?= h($salesOrder->customer_id) ?></td>
                            <td><?= h($salesOrder->date) ?></td>
                            <td><?= h($salesOrder->valid_until) ?></td>
                            <td><?= h($salesOrder->sales_service_id) ?></td>
                            <td><?= h($salesOrder->currency_id) ?></td>
                            <td><?= h($salesOrder->payment_term_id) ?></td>
                            <td><?= h($salesOrder->notes_1) ?></td>
                            <td><?= h($salesOrder->notes_2) ?></td>
                            <td><?= h($salesOrder->subtotal) ?></td>
                            <td><?= h($salesOrder->tax_total) ?></td>
                            <td><?= h($salesOrder->grand_total) ?></td>
                            <td><?= h($salesOrder->status) ?></td>
                            <td><?= h($salesOrder->sales_user_id) ?></td>
                            <td><?= h($salesOrder->sales_agency_id) ?></td>
                            <td><?= h($salesOrder->sales_reseller_id) ?></td>
                            <td><?= h($salesOrder->created) ?></td>
                            <td><?= h($salesOrder->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SalesOrders', 'action' => 'view', $salesOrder->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SalesOrders', 'action' => 'edit', $salesOrder->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'SalesOrders', 'action' => 'delete', $salesOrder->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $salesOrder->id),
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
                <h4><?= __('Related Sales Quotations') ?></h4>
                <?php if (!empty($salesService->sales_quotations)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Number') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Valid Until') ?></th>
                            <th><?= __('Sales Service Id') ?></th>
                            <th><?= __('Currency Id') ?></th>
                            <th><?= __('Payment Term Id') ?></th>
                            <th><?= __('Notes 1') ?></th>
                            <th><?= __('Notes 2') ?></th>
                            <th><?= __('Subtotal') ?></th>
                            <th><?= __('Tax Total') ?></th>
                            <th><?= __('Grand Total') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Sales User Id') ?></th>
                            <th><?= __('Sales Agency Id') ?></th>
                            <th><?= __('Sales Reseller Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($salesService->sales_quotations as $salesQuotation) : ?>
                        <tr>
                            <td><?= h($salesQuotation->id) ?></td>
                            <td><?= h($salesQuotation->number) ?></td>
                            <td><?= h($salesQuotation->customer_id) ?></td>
                            <td><?= h($salesQuotation->date) ?></td>
                            <td><?= h($salesQuotation->valid_until) ?></td>
                            <td><?= h($salesQuotation->sales_service_id) ?></td>
                            <td><?= h($salesQuotation->currency_id) ?></td>
                            <td><?= h($salesQuotation->payment_term_id) ?></td>
                            <td><?= h($salesQuotation->notes_1) ?></td>
                            <td><?= h($salesQuotation->notes_2) ?></td>
                            <td><?= h($salesQuotation->subtotal) ?></td>
                            <td><?= h($salesQuotation->tax_total) ?></td>
                            <td><?= h($salesQuotation->grand_total) ?></td>
                            <td><?= h($salesQuotation->status) ?></td>
                            <td><?= h($salesQuotation->sales_user_id) ?></td>
                            <td><?= h($salesQuotation->sales_agency_id) ?></td>
                            <td><?= h($salesQuotation->sales_reseller_id) ?></td>
                            <td><?= h($salesQuotation->created) ?></td>
                            <td><?= h($salesQuotation->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SalesQuotations', 'action' => 'view', $salesQuotation->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SalesQuotations', 'action' => 'edit', $salesQuotation->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'SalesQuotations', 'action' => 'delete', $salesQuotation->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $salesQuotation->id),
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
                <h4><?= __('Related Sales Services') ?></h4>
                <?php if (!empty($salesService->child_sales_services)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Lft') ?></th>
                            <th><?= __('Rght') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Transport Mode') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($salesService->child_sales_services as $childSalesService) : ?>
                        <tr>
                            <td><?= h($childSalesService->id) ?></td>
                            <td><?= h($childSalesService->parent_id) ?></td>
                            <td><?= h($childSalesService->lft) ?></td>
                            <td><?= h($childSalesService->rght) ?></td>
                            <td><?= h($childSalesService->name) ?></td>
                            <td><?= h($childSalesService->transport_mode) ?></td>
                            <td><?= h($childSalesService->created) ?></td>
                            <td><?= h($childSalesService->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SalesServices', 'action' => 'view', $childSalesService->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SalesServices', 'action' => 'edit', $childSalesService->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'SalesServices', 'action' => 'delete', $childSalesService->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $childSalesService->id),
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
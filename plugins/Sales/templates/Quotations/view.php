<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $quotation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Quotation'), ['action' => 'edit', $quotation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Quotation'), ['action' => 'delete', $quotation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quotation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Quotations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Quotation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="quotations view content">
            <h3><?= h($quotation->code) ?></h3>
            <table>
                <tr>
                    <th><?= __('Number') ?></th>
                    <td><?= h($quotation->number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $quotation->hasValue('customer') ? $this->Html->link($quotation->customer->name, ['controller' => 'Partners', 'action' => 'view', $quotation->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Sales Service') ?></th>
                    <td><?= $quotation->hasValue('sales_service') ? $this->Html->link($quotation->sales_service->name, ['controller' => 'SalesServices', 'action' => 'view', $quotation->sales_service->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Currency Id') ?></th>
                    <td><?= h($quotation->currency_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($quotation->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($quotation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Term Id') ?></th>
                    <td><?= $quotation->payment_term_id === null ? '' : $this->Number->format($quotation->payment_term_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subtotal') ?></th>
                    <td><?= $quotation->subtotal === null ? '' : $this->Number->format($quotation->subtotal) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tax Total') ?></th>
                    <td><?= $quotation->tax_total === null ? '' : $this->Number->format($quotation->tax_total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Grand Total') ?></th>
                    <td><?= $quotation->grand_total === null ? '' : $this->Number->format($quotation->grand_total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sales User Id') ?></th>
                    <td><?= $quotation->sales_user_id === null ? '' : $this->Number->format($quotation->sales_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sales Agency Id') ?></th>
                    <td><?= $quotation->sales_agency_id === null ? '' : $this->Number->format($quotation->sales_agency_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sales Reseller Id') ?></th>
                    <td><?= $quotation->sales_reseller_id === null ? '' : $this->Number->format($quotation->sales_reseller_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($quotation->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Valid Until') ?></th>
                    <td><?= h($quotation->valid_until) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($quotation->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($quotation->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Notes 1') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($quotation->notes_1)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Notes 2') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($quotation->notes_2)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Sales Quotation Lines') ?></h4>
                <?php if (!empty($quotation->sales_quotation_lines)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Sales Quotation Id') ?></th>
                            <th><?= __('Origin Id') ?></th>
                            <th><?= __('Destination Id') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($quotation->sales_quotation_lines as $salesQuotationLine) : ?>
                        <tr>
                            <td><?= h($salesQuotationLine->id) ?></td>
                            <td><?= h($salesQuotationLine->sales_quotation_id) ?></td>
                            <td><?= h($salesQuotationLine->origin_id) ?></td>
                            <td><?= h($salesQuotationLine->destination_id) ?></td>
                            <td><?= h($salesQuotationLine->description) ?></td>
                            <td><?= h($salesQuotationLine->qty) ?></td>
                            <td><?= h($salesQuotationLine->price) ?></td>
                            <td><?= h($salesQuotationLine->amount) ?></td>
                            <td><?= h($salesQuotationLine->created) ?></td>
                            <td><?= h($salesQuotationLine->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SalesQuotationLines', 'action' => 'view', $salesQuotationLine->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SalesQuotationLines', 'action' => 'edit', $salesQuotationLine->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'SalesQuotationLines', 'action' => 'delete', $salesQuotationLine->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $salesQuotationLine->id),
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
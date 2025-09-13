<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $salesQuotation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Sales Quotation'), ['action' => 'edit', $salesQuotation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Sales Quotation'), ['action' => 'delete', $salesQuotation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesQuotation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Sales Quotations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Sales Quotation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="salesQuotations view content">
            <h3><?= h($salesQuotation->number) ?></h3>
            <table>
                <tr>
                    <th><?= __('Number') ?></th>
                    <td><?= h($salesQuotation->number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Currency') ?></th>
                    <td><?= h($salesQuotation->currency) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($salesQuotation->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($salesQuotation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer Id') ?></th>
                    <td><?= $salesQuotation->customer_id === null ? '' : $this->Number->format($salesQuotation->customer_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subtotal') ?></th>
                    <td><?= $salesQuotation->subtotal === null ? '' : $this->Number->format($salesQuotation->subtotal) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tax Total') ?></th>
                    <td><?= $salesQuotation->tax_total === null ? '' : $this->Number->format($salesQuotation->tax_total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Grand Total') ?></th>
                    <td><?= $salesQuotation->grand_total === null ? '' : $this->Number->format($salesQuotation->grand_total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($salesQuotation->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($salesQuotation->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($salesQuotation->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Notes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($salesQuotation->notes)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Sales Quotation Lines') ?></h4>
                <?php if (!empty($salesQuotation->sales_quotation_lines)) : ?>
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
                        <?php foreach ($salesQuotation->sales_quotation_lines as $salesQuotationLine) : ?>
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
<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $quotation
 * @var \Cake\Collection\CollectionInterface|string[] $salesServices
 * @var \Cake\Collection\CollectionInterface|string[] $customer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Quotations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="quotations form content">
            <?= $this->Form->create($quotation) ?>
            <fieldset>
                <legend><?= __('Add Quotation') ?></legend>
                <?php
                    echo $this->Form->control('number');
                    echo $this->Form->control('customer_id', ['options' => $customer, 'empty' => true]);
                    echo $this->Form->control('date', ['empty' => true]);
                    echo $this->Form->control('valid_until', ['empty' => true]);
                    echo $this->Form->control('sales_service_id', ['options' => $salesServices, 'empty' => true]);
                    echo $this->Form->control('currency_id');
                    echo $this->Form->control('payment_term_id');
                    echo $this->Form->control('notes_1');
                    echo $this->Form->control('notes_2');
                    echo $this->Form->control('subtotal');
                    echo $this->Form->control('tax_total');
                    echo $this->Form->control('grand_total');
                    echo $this->Form->control('status');
                    echo $this->Form->control('sales_user_id');
                    echo $this->Form->control('sales_agency_id');
                    echo $this->Form->control('sales_reseller_id');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

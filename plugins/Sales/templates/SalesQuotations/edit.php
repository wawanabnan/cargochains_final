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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $salesQuotation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $salesQuotation->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Sales Quotations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="salesQuotations form content">
            <?= $this->Form->create($salesQuotation) ?>
            <fieldset>
                <legend><?= __('Edit Sales Quotation') ?></legend>
                <?php
                    echo $this->Form->control('number');
                    echo $this->Form->control('customer_id');
                    echo $this->Form->control('date', ['empty' => true]);
                    echo $this->Form->control('currency');
                    echo $this->Form->control('notes');
                    echo $this->Form->control('subtotal');
                    echo $this->Form->control('tax_total');
                    echo $this->Form->control('grand_total');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

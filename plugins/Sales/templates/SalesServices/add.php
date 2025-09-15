<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $salesService
 * @var \Cake\Collection\CollectionInterface|string[] $parentSalesServices
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Sales Services'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="salesServices form content">
            <?= $this->Form->create($salesService) ?>
            <fieldset>
                <legend><?= __('Add Sales Service') ?></legend>
                <?php
                    echo $this->Form->control('parent_id', ['options' => $parentSalesServices, 'empty' => true]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('transport_mode');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

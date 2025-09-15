<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $salesService
 * @var string[]|\Cake\Collection\CollectionInterface $parentSalesServices
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $salesService->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $salesService->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Sales Services'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="salesServices form content">
            <?= $this->Form->create($salesService) ?>
            <fieldset>
                <legend><?= __('Edit Sales Service') ?></legend>
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

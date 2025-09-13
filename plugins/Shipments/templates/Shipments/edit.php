<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $shipment
 * @var string[]|\Cake\Collection\CollectionInterface $shipper
 * @var string[]|\Cake\Collection\CollectionInterface $consignee
 * @var string[]|\Cake\Collection\CollectionInterface $carrier
 * @var string[]|\Cake\Collection\CollectionInterface $agency
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $shipment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $shipment->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Shipments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="shipments form content">
            <?= $this->Form->create($shipment) ?>
            <fieldset>
                <legend><?= __('Edit Shipment') ?></legend>
                <?php
                    echo $this->Form->control('number');
                    echo $this->Form->control('origin_id');
                    echo $this->Form->control('destination_id');
                    echo $this->Form->control('cargo_description');
                    echo $this->Form->control('weight');
                    echo $this->Form->control('volume');
                    echo $this->Form->control('qty');
                    echo $this->Form->control('shipper_id', ['options' => $shipper, 'empty' => true]);
                    echo $this->Form->control('consignee_id', ['options' => $consignee, 'empty' => true]);
                    echo $this->Form->control('carrier_id', ['options' => $carrier, 'empty' => true]);
                    echo $this->Form->control('agency_id', ['options' => $agency, 'empty' => true]);
                    echo $this->Form->control('etd', ['empty' => true]);
                    echo $this->Form->control('eta', ['empty' => true]);
                    echo $this->Form->control('atd', ['empty' => true]);
                    echo $this->Form->control('ata', ['empty' => true]);
                    echo $this->Form->control('status');
                    echo $this->Form->control('is_multimoda');
                    echo $this->Form->control('origin');
                    echo $this->Form->control('destination');
                    echo $this->Form->control('bill_of_lading_no');
                    echo $this->Form->control('total');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

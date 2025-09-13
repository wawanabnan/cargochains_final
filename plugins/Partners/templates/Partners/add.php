<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $partner
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Partners'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="partners form content">
            <?= $this->Form->create($partner) ?>
            <fieldset>
                <legend><?= __('Add Partner') ?></legend>
                <?php
                    echo $this->Form->control('code');
                    echo $this->Form->control('name');
                    echo $this->Form->control('tax_id');
                    echo $this->Form->control('email');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('address');
                    echo $this->Form->control('city');
                    echo $this->Form->control('country');
                    echo $this->Form->control('is_customer');
                    echo $this->Form->control('is_vendor');
                    echo $this->Form->control('is_carrier');
                    echo $this->Form->control('is_agent');
                    echo $this->Form->control('is_shipper');
                    echo $this->Form->control('is_consignee');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?php
$this->assign('title', 'Edit Order');
?>
<div class="container py-3">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h3>Edit Order</h3>
    <?= $this->Html->link('Back', ['action'=>'index'], ['class'=>'btn btn-secondary btn-sm']) ?>
  </div>
  <div class="card"><div class="card-body">
    <?= $this->Form->create($entity) ?>
      <div class="row g-2 mb-2">
        <div class="col-md-4"><?= $this->Form->control('number') ?></div>
        <div class="col-md-4"><?= $this->Form->control('date', ['type'=>'date']) ?></div>
        <div class="col-md-4"><?= $this->Form->control('currency', ['value'=>'USD']) ?></div>
        <div class="col-12"><?= $this->Form->control('notes', ['type'=>'textarea']) ?></div>
      </div>
      <h6 class="mt-2">Lines</h6>
      <?= $this->element('sales/lines_form', ['entity'=>$entity, 'prefix'=>'sales_order_lines']) ?>
      <div class="mt-3"><?= $this->Form->button('Save', ['class'=>'btn btn-primary']) ?></div>
    <?= $this->Form->end() ?>
  </div></div>
</div>

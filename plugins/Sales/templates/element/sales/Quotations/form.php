
<div class="card card-primary">
  <div class="card-header"><h3 class="card-title"><?= $this->fetch('title') ?></h3></div>
  <div class="card-body">
    <?= $this->Form->create($quotation) ?>
    <div class="row g-3">
      <div class="col-md-6"><?= $this->Form->control('code', ['class'=>'form-control']) ?></div>
      <div class="col-md-6"><?= $this->Form->control('partner_id', ['options'=>$partners ?? [], 'class'=>'form-select']) ?></div>
      <div class="col-md-6"><?= $this->Form->control('quotation_date', ['type'=>'date', 'class'=>'form-control']) ?></div>
      <div class="col-md-6"><?= $this->Form->control('total', ['class'=>'form-control']) ?></div>
      <div class="col-md-6"><?= $this->Form->control('status', ['class'=>'form-control']) ?></div>
    </div>
  </div>
  <div class="card-footer">
    <?= $this->Form->button(__('Save'), ['class'=>'btn btn-primary']) ?>
    <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-secondary']) ?>
    <?= $this->Form->end() ?>
  </div>
</div>

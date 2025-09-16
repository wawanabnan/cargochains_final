<div class="card card-primary">
  <div class="card-header"><h3 class="card-title"><?= __('New Order') ?></h3></div>
  <div class="card-body">
    <?= $this->Form->create($order) ?>
    <div class="row g-3">
      <?= $this->Form->control('business_type', [
        'label' => 'Business Type',
        'options' => ['freight' => 'Freight', 'charter' => 'Ship Charter', 'tranship' => 'Transhipment'],
        'empty' => false, 'class' => 'form-select', 'value' => $order->business_type ?? 'freight'
      ]) ?>
      <?= $this->Form->control('customer_id', [
        'label' => 'Customer', 'options' => $customers, 'class' => 'form-select'
      ]) ?>
      <?= $this->Form->control('sales_service_id', [
        'label' => 'Service', 'options' => $services, 'empty' => true, 'class' => 'form-select'
      ]) ?>
      <?= $this->Form->control('payment_term_id', [
        'label' => 'Payment Term', 'options' => $paymentTermsList, 'empty' => true, 'class' => 'form-select'
      ]) ?>
      <?= $this->Form->control('order_date', ['type' => 'date', 'class' => 'form-control']) ?>
      <?= $this->Form->control('status', ['class' => 'form-control', 'value' => 'OPEN']) ?>
      <?= $this->Form->control('total', ['type' => 'number', 'step' => '0.01', 'class' => 'form-control']) ?>
    </div>
  </div>
  <div class="card-footer d-flex gap-2">
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
    <?= $this->Form->end() ?>
  </div>
</div>

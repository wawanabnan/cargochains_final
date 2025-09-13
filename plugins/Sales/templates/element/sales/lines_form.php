<?php
// expects: $prefix = 'sales_quotation_lines' or 'sales_order_lines'
$prefix = $prefix ?? 'sales_quotation_lines';
$rows = $rows ?? ($entity->{$prefix} ?? []);
$index = 0;
?>
<table class="table table-sm align-middle" id="lines-table">
  <thead>
    <tr>
      <th style="width: 120px;">Origin ID</th>
      <th style="width: 140px;">Destination ID</th>
      <th>Description</th>
      <th style="width: 100px;">Qty</th>
      <th style="width: 120px;">Price</th>
      <th style="width: 120px;">Amount</th>
      <th style="width: 50px;"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $i => $ln): ?>
    <tr>
      <td><?= $this->Form->control("{$prefix}.{$i}.origin_id", ['label'=>false, 'type'=>'number', 'class'=>'form-control form-control-sm']) ?></td>
      <td><?= $this->Form->control("{$prefix}.{$i}.destination_id", ['label'=>false, 'type'=>'number', 'class'=>'form-control form-control-sm']) ?></td>
      <td><?= $this->Form->control("{$prefix}.{$i}.description", ['label'=>false, 'class'=>'form-control form-control-sm']) ?></td>
      <td><?= $this->Form->control("{$prefix}.{$i}.qty", ['label'=>false, 'type'=>'number', 'step'=>'0.001', 'class'=>'form-control form-control-sm qty']) ?></td>
      <td><?= $this->Form->control("{$prefix}.{$i}.price", ['label'=>false, 'type'=>'number', 'step'=>'0.01', 'class'=>'form-control form-control-sm price']) ?></td>
      <td><?= $this->Form->control("{$prefix}.{$i}.amount", ['label'=>false, 'type'=>'number', 'step'=>'0.01', 'class'=>'form-control form-control-sm amount']) ?></td>
      <td><button type="button" class="btn btn-sm btn-outline-danger remove-row">&times;</button></td>
    </tr>
    <?php $index = $i+1; endforeach; ?>
  </tbody>
</table>
<button type="button" id="add-row" class="btn btn-sm btn-outline-primary">+ Add line</button>

<script>
(function(){
  const prefix = <?= json_encode($prefix) ?>;
  const tbl = document.getElementById('lines-table');
  const addBtn = document.getElementById('add-row');
  if (!tbl || !addBtn) return;

  function rowTemplate(i){
    return `<tr>
      <td><input name="${prefix}[${i}][origin_id]" type="number" class="form-control form-control-sm"/></td>
      <td><input name="${prefix}[${i}][destination_id]" type="number" class="form-control form-control-sm"/></td>
      <td><input name="${prefix}[${i}][description]" type="text" class="form-control form-control-sm"/></td>
      <td><input name="${prefix}[${i}][qty]" type="number" step="0.001" class="form-control form-control-sm qty"/></td>
      <td><input name="${prefix}[${i}][price]" type="number" step="0.01" class="form-control form-control-sm price"/></td>
      <td><input name="${prefix}[${i}][amount]" type="number" step="0.01" class="form-control form-control-sm amount"/></td>
      <td><button type="button" class="btn btn-sm btn-outline-danger remove-row">&times;</button></td>
    </tr>`;
  }

  let idx = <?= (int)$index ?>;
  addBtn.addEventListener('click', function(){
    const tbody = tbl.querySelector('tbody');
    tbody.insertAdjacentHTML('beforeend', rowTemplate(idx++));
  });

  tbl.addEventListener('input', function(ev){
    const tr = ev.target.closest('tr');
    if (!tr) return;
    const qty = parseFloat(tr.querySelector('.qty')?.value || '0');
    const price = parseFloat(tr.querySelector('.price')?.value || '0');
    const amount = tr.querySelector('.amount');
    if (amount) amount.value = (Math.round(qty * price * 100)/100).toFixed(2);
  });

  tbl.addEventListener('click', function(ev){
    if (ev.target && ev.target.classList.contains('remove-row')) {
      const tr = ev.target.closest('tr');
      tr && tr.remove();
    }
  });
})();
</script>

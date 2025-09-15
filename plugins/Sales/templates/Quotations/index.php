<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $quotations
 */
?>
<div class="container-fluid px-0">

  <!-- FILTERS (GET) -->
  <?= $this->Form->create(null, ['type' => 'get', 'class' => 'mb-3']) ?>
  <div class="row g-2 align-items-end">

    <div class="col-12 col-md-3">
      <?= $this->Form->control('q', [
        'label' => __('Search'),
        'value' => $this->request->getQuery('q'),
        'class' => 'form-control',
        'placeholder' => __('Search code or customer…'),
      ]) ?>
    </div>

    <div class="col-6 col-md-2">
      <?= $this->Form->control('status', [
        'label' => __('Status'),
        'options' => ['DRAFT'=>'DRAFT','SENT'=>'SENT','CONFIRMED'=>'CONFIRMED','APPROVED'=>'APPROVED','CANCELED'=>'CANCELED'],
        'empty' => __('All'),
        'value' => $this->request->getQuery('status'),
        'class' => 'form-select',
      ]) ?>
    </div>

    <div class="col-6 col-md-2">
      <?= $this->Form->control('from', [
        'label' => __('From'),
        'type'  => 'date',
        'value' => $this->request->getQuery('from'),
        'class' => 'form-control',
      ]) ?>
    </div>

    <div class="col-6 col-md-2">
      <?= $this->Form->control('to', [
        'label' => __('To'),
        'type'  => 'date',
        'value' => $this->request->getQuery('to'),
        'class' => 'form-control',
      ]) ?>
    </div>

    <div class="col-6 col-md-2">
      <?= $this->Form->control('group', [
        'label'   => __('Group By'),
        'options' => ['status'=>'Status','customer'=>'Customer'],
        'empty'   => __('None'),
        'value'   => $this->request->getQuery('group'),
        'class'   => 'form-select',
      ]) ?>
    </div>

    <div class="col-12 col-md-1 d-grid">
      <?= $this->Form->button(__('Filter'), ['class' => 'btn btn-primary']) ?>
    </div>

  </div>
  <?= $this->Form->end() ?>

<div class="quotations index content">
    <?= $this->Html->link(__('New Quotation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Quotations') ?></h3>
    <div class="table-responsive">
        <table   id="q-table" class="table table-striped align-middle">

            <thead>
                <tr>
					<th class="sticky-col start bg-white">
						<input type="checkbox" id="checkAll">
					</th>	
					<th><?= $this->Sort->link('number', 'Number') ?></th>
                    <th><?= $this->Sort->link('customer_id', 'Customer') ?></th>
                    <th><?= $this->Sort->link('valid_until', 'Vallid Date') ?></th>
                    <th><?= $this->Sort->link('sales_service_id', 'Services') ?></th>
					<th><?= $this->Sort->link('sales_user_id', 'Sales') ?></th>
					<th><?= $this->Sort->link('payment_term_id', 'Payment Term') ?></th>
                    <th><?= $this->Sort->link('currency_id', 'Currency') ?></th>
					<th><?= $this->Sort->link('grand_total', 'Total') ?></th>
					<th><?= $this->Sort->link('status', 'Status') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($quotations as $quotation): ?>
				<tr class="clickable-row" data-href="<?= $this->Url->build(['action'=>'view',$quotation->id]) ?>">
					<td class="sticky-col start bg-white">
						<input type="checkbox" name="ids[]" value="<?= $quotation->id ?>" class="row-check"
							onclick="event.stopPropagation();">
					</td>
                    <td><?= h($quotation->number) ?></td>
                    <td>
					
					<?php if (!empty($quotation->customer)): ?>
            <?= $this->Html->link(
              h($quotation->customer->name),
              ['plugin' => 'Partners', 'controller' => 'Partners', 'action' => 'view', $quotation->customer->id],
              [
				'class' => 'text-decoration-none',
				'data-bs-toggle' => 'tooltip',
				'title' => __('View Partner Detail')
			  ]
            ) ?>
          <?php endif; ?>
					</td>
                    
					<td><?= h($quotation->valid_until) ?></td>
					<td><?= $quotation->hasValue('sales_service') ? $this->Html->link($quotation->sales_service->name, ['controller' => 'SalesServices', 'action' => 'view', $quotation->sales_service->id]) : '' ?></td>
                    <td><?= $quotation->sales_user_id === null ? '' : $this->Number->format($quotation->sales_user_id) ?></td>
                    <td><?= $quotation->has('payment_term') ? h($quotation->payment_term->name) : '-' ?></td>
                    <td><?= h($quotation->currency_id) ?></td>      
					<td><?= $quotation->grand_total === null ? '' : $this->Number->format($quotation->grand_total) ?></td>
						

				   <td><?= $this->Status->badge($quotation->status) ?></td>
               </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>


<?php $this->start('css'); ?>
<style>
  .table thead th { white-space: nowrap; }
  .sticky-col.start { position: sticky; left: 0; z-index: 1; background: #fff; }
  .clickable-row { cursor: pointer; }

  #q-table.table th {
    padding: 0.25rem 0.25rem;  /* default bootstrap 0.5–1rem */
    vertical-align: middle;
  }


 #q-table.table td {
    padding: 0.25rem 0.25rem;  /* default bootstrap 0.5–1rem */
    vertical-align: middle;
  }


  /* Font tabel sedikit diperkecil */
  #q-table.table {
    font-size: 0.875rem; /* 14px jika base 16px */
  }

  /* Checkbox kolom pertama tetap proporsional */
  #q-table.table td:first-child,
  #q-table.table th:first-child {
    text-align: center;
    width: 40px;
  }

  #q-table th a {
    text-decoration: none !important;
    color: inherit !important; /* ikuti warna header */
  }

  /* Ikon sort rapat dengan label */
  #q-table th i {
    font-size: 0.75rem;
    margin-left: 0.25rem;
  }

  /* Posisikan link & ikon inline */
  #q-table th {
    white-space: nowrap;
  }

</style>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script>
  const checkAll = document.getElementById('checkAll');
  if (checkAll) {
    checkAll.addEventListener('change', e => {
      document.querySelectorAll('.row-check').forEach(cb => cb.checked = e.target.checked);
    });
  }
  document.querySelectorAll('.clickable-row').forEach(row => {
    row.addEventListener('click', e => {
      if (e.target.closest('input,button,a,select,label')) return;
      window.location = row.dataset.href;
    });
  });
</script>
<?php $this->end(); ?>


<?php $this->start('script'); ?>
<script>
// Klik baris -> navigate, kecuali klik elemen interaktif (checkbox, tombol, link, dll)
document.addEventListener('DOMContentLoaded', function () {
  const table = document.getElementById('q-table');
  if (!table) return;
	
	  // Row click -> navigate, kecuali elemen interaktif
  table.tBodies[0].addEventListener('click', function (e) {
    if (e.target.closest('input,button,a,select,textarea,label')) return;
    const row = e.target.closest('tr.clickable-row');
    if (row && row.dataset.href) window.location.href = row.dataset.href;
  });

  // Cegah klik checkbox mem-bubble ke TR
  table.querySelectorAll('input.row-check').forEach(cb => {
    cb.addEventListener('click', function (e) { e.stopPropagation(); });
  });

  // Check All
  const checkAll = document.getElementById('checkAll');
  if (checkAll) {
    checkAll.addEventListener('change', function (e) {
      table.querySelectorAll('input.row-check').forEach(cb => cb.checked = e.target.checked);
    });
  }
});
</script>
<?php $this->end(); ?>

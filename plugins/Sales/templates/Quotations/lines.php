<?php
// $quotation, $headerSummary, $locationOptions
?>

<div class="card shadow-sm">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h3 class="card-title m-0">Add Quotation — Step 2 of 2 (Lines)</h3>
    <div class="small text-muted">Minimal 1 baris diisi</div>
  </div>

  <div class="card-body">
    <?php if (!empty($headerSummary)): ?>
      <div class="alert alert-secondary py-2">
        <div class="fw-semibold mb-1">Header Summary</div>
        <div class="row g-2 small">
          <div class="col-md-3"><span class="text-muted">Customer:</span> <?= h($headerSummary['customer_label'] ?? '-') ?></div>
          <div class="col-md-3"><span class="text-muted">Service:</span> <?= h($headerSummary['service_label'] ?? '-') ?></div>
          <div class="col-md-3"><span class="text-muted">Payment Term:</span> <?= h($headerSummary['payment_term_label'] ?? '-') ?></div>
          <div class="col-md-3"><span class="text-muted">Valid Until:</span> <?= h($headerSummary['valid_until'] ?? '-') ?></div>
        </div>
      </div>
    <?php endif; ?>

    <?= $this->Form->create($quotation, ['id' => 'lines-form']) ?>

      <div id="lines-wrap">
        <?php
          $rows  = $quotation->quotation_lines ?? [];
          $count = max(count($rows), 1);
          for ($i=0; $i<$count; $i++):
            $ln = $rows[$i] ?? null;
            // nilai awal untuk format tampilan
            $qtyInit   = $ln->qty  ?? null;
            $rateInit  = $ln->rate ?? null;
        ?>
        <div class="line-row border rounded p-3 mb-2" data-index="<?= $i ?>">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <strong>Line <span class="line-no"><?= $i+1 ?></span></strong>
            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-line" <?= $count<=1 ? 'disabled' : '' ?>>Remove</button>
          </div>

          <div class="row g-3">
            <!-- ORIGIN / DESTINATION -->
            <div class="col-md-3">
              <?= $this->Form->control("quotation_lines.$i.origin_id", [
                'label'   => 'Origin',
                'type'    => 'select',
                'options' => $locationOptions,
                'class'   => 'form-select origin-select',
                'empty'   => 'Pilih origin…',
                'value'   => $ln->origin_id ?? null,
                'required'=> true,
              ]) ?>
            </div>
            <div class="col-md-3">
              <?= $this->Form->control("quotation_lines.$i.destination_id", [
                'label'   => 'Destination',
                'type'    => 'select',
                'options' => $locationOptions,
                'class'   => 'form-select destination-select',
                'empty'   => 'Pilih destination…',
                'value'   => $ln->destination_id ?? null,
                'required'=> true,
              ]) ?>
            </div>

            <!-- DESCRIPTION -->
            <div class="col-md-6">
              <?= $this->Form->control("quotation_lines.$i.description", [
                'label' => 'Description',
                'value' => $ln->description ?? null,
                'class' => 'form-control',
                'required' => true,
                'placeholder' => 'Commodity / service detail'
              ]) ?>
            </div>

            <!-- QTY / UOM / PRICE / AMOUNT -->
            <div class="col-md-2">
              <label class="form-label" for="quotation_lines-<?= $i ?>-qty">Qty</label>
              <input type="text" name="quotation_lines.<?= $i ?>.qty" id="quotation_lines-<?= $i ?>-qty"
                     class="form-control qty-input numeral" inputmode="decimal"
                     value="<?= $qtyInit !== null ? h(number_format((float)$qtyInit, 3, ',', '.')) : '' ?>"
                     placeholder="0,000" required>
					 
				<div class="text-danger small"><?= $this->Form->error("quotation_lines.$i.qty") ?></div>
		 
            </div>
            <div class="col-md-2">
              <?= $this->Form->control("quotation_lines.$i.uom", [
                'label'=>'UoM','value'=>$ln->uom ?? null,'class'=>'form-control','required'=>true
              ]) ?>
            </div>
            <div class="col-md-2">
              <label class="form-label" for="quotation_lines-<?= $i ?>-rate">Price</label>
              <input type="text" name="quotation_lines.<?= $i ?>.rate" id="quotation_lines-<?= $i ?>-rate"
                     class="form-control rate-input numeral" inputmode="decimal"
                     value="<?= $rateInit !== null ? h(number_format((float)$rateInit, 2, ',', '.')) : '' ?>"
                     placeholder="0,00" required>
			  <div class="text-danger small"><?= $this->Form->error("quotation_lines.$i.rate") ?></div>
	
			</div>
            <div class="col-md-2 ms-auto">
              <label class="form-label" for="quotation_lines-<?= $i ?>-amount">Amount</label>
              <input type="text" id="quotation_lines-<?= $i ?>-amount"
                     class="form-control amount-input" value="0" readonly>
            </div>
          </div>

          <?= $this->Form->hidden("quotation_lines.$i.id", ['value' => $ln->id ?? null]) ?>
        </div>
        <?php endfor; ?>
      </div>

      <!-- BUTTONS -->
      <div class="d-flex gap-2 my-3">
        <button type="button" id="btn-add-line" class="btn btn-outline-primary">+ Add Line</button>
        <button type="submit" class="btn btn-primary">Save Quotation</button>
        <?= $this->Html->link('Back to Header', ['action' => 'add'], ['class'=>'btn btn-outline-secondary']) ?>
      </div>

      <div class="text-danger small"><?= $this->Form->error('quotation_lines') ?></div>

    <?= $this->Form->end() ?>
  </div>
</div>

<?php $this->start('script'); ?>
<script>
const nf = new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 6 });
function toRaw(str) {
  if (str == null) return '';
  // "1.234,56" -> "1234.56"
  return String(str).replace(/\./g, '').replace(',', '.');
}
function toNice(num, frac=2) {
  if (num == null || num === '' || isNaN(num)) return '';
  const n = Number(num);
  return n.toLocaleString('id-ID', { minimumFractionDigits: frac, maximumFractionDigits: frac });
}
function parseNice(str) {
  // "1.234,56" -> 1234.56 (Number)
  const raw = toRaw(str);
  const n = Number(raw);
  return isNaN(n) ? 0 : n;
}
function recalcAmount(row) {
  const qtyEl   = row.querySelector('.qty-input');
  const rateEl  = row.querySelector('.rate-input');
  const amtEl   = row.querySelector('.amount-input');
  const qty   = parseNice(qtyEl?.value || '0');
  const price = parseNice(rateEl?.value || '0');
  const amt   = qty * price;
  if (amtEl) amtEl.value = toNice(amt, 2);
}
function renumberRows(){
  const rows = document.querySelectorAll('#lines-wrap .line-row');
  rows.forEach((row, idx) => {
    row.dataset.index = idx;
    const no = row.querySelector('.line-no'); if (no) no.textContent = idx + 1;
    row.querySelectorAll('input, textarea, select').forEach(el => {
      const name = el.getAttribute('name'); if (!name) return;
      el.name = name.replace(/quotation_lines\.\d+\./, 'quotation_lines.'+idx+'.');
      if (el.id) el.id = el.id.replace(/quotation_lines-\d+-/, 'quotation_lines-'+idx+'-');
    });
  });
  document.querySelectorAll('.btn-remove-line').forEach(btn => btn.disabled = (rows.length <= 1));
}
function buildRowTemplate(idx) {
  const options = `<?= $locationOptions ? implode('', array_map(
    fn($k,$v)=>'<option value="'.(int)$k.'">'.h($v).'</option>',
    array_keys($locationOptions->toArray()), $locationOptions->toArray()
  )) : '' ?>`;
  const w = document.createElement('div');
  w.className = 'line-row border rounded p-3 mb-2';
  w.dataset.index = idx;
  w.innerHTML = `
    <div class="d-flex align-items-center justify-content-between mb-2">
      <strong>Line <span class="line-no">${idx+1}</span></strong>
      <button type="button" class="btn btn-sm btn-outline-danger btn-remove-line">Remove</button>
    </div>
    <div class="row g-3">
      <div class="col-md-3">
        <label class="form-label" for="quotation_lines-${idx}-origin-id">Origin</label>
        <select name="quotation_lines.${idx}.origin_id" id="quotation_lines-${idx}-origin-id" class="form-select origin-select" required>${options}</select>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="quotation_lines-${idx}-destination-id">Destination</label>
        <select name="quotation_lines.${idx}.destination_id" id="quotation_lines-${idx}-destination-id" class="form-select destination-select" required>${options}</select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="quotation_lines-${idx}-description">Description</label>
        <textarea name="quotation_lines.${idx}.description" id="quotation_lines-${idx}-description" class="form-control" required rows="1"></textarea>
      </div>
      <div class="col-md-2">
        <label class="form-label" for="quotation_lines-${idx}-qty">Qty</label>
        <input type="text" name="quotation_lines.${idx}.qty" id="quotation_lines-${idx}-qty" class="form-control qty-input numeral" inputmode="decimal" placeholder="0,000" required>
      </div>
      <div class="col-md-2">
        <label class="form-label" for="quotation_lines-${idx}-uom">UoM</label>
        <input type="text" name="quotation_lines.${idx}.uom" id="quotation_lines-${idx}-uom" class="form-control" required>
      </div>
      <div class="col-md-2">
        <label class="form-label" for="quotation_lines-${idx}-rate">Price</label>
        <input type="text" name="quotation_lines.${idx}.rate" id="quotation_lines-${idx}-rate" class="form-control rate-input numeral" inputmode="decimal" placeholder="0,00" required>
      </div>
      <div class="col-md-2 ms-auto">
        <label class="form-label" for="quotation_lines-${idx}-amount">Amount</label>
        <input type="text" id="quotation_lines-${idx}-amount" class="form-control amount-input" value="0" readonly>
      </div>
    </div>`;
  return w;
}

// format on typing: allow digits and [.,]
function normalizeTyping(e) {
  const allowed = /[0-9\.,]/;
  if (!allowed.test(e.key) && e.key.length === 1) e.preventDefault();
}
function formatField(el, frac) {
  const n = parseNice(el.value);
  el.value = toNice(n, frac);
}

document.addEventListener('DOMContentLoaded', function(){
  const wrap = document.getElementById('lines-wrap');

  // format initial & amount
  wrap.querySelectorAll('.line-row').forEach(row => {
    // jika nilai awal ada, format amount sekarang
    recalcAmount(row);
  });
  renumberRows();

  // typing guard
  wrap.addEventListener('keypress', function(e){
    if (e.target.matches('.numeral')) normalizeTyping(e);
  });

  // on blur: format ribuan
  wrap.addEventListener('blur', function(e){
    if (e.target.matches('.qty-input'))  formatField(e.target, 3);
    if (e.target.matches('.rate-input')) formatField(e.target, 2);
  }, true);

  // on input: hitung amount realtime
  wrap.addEventListener('input', function(e){
    if (e.target.matches('.qty-input, .rate-input')) {
      recalcAmount(e.target.closest('.line-row'));
    }
  });

  // add line
  document.getElementById('btn-add-line')?.addEventListener('click', function(){
    wrap.appendChild(buildRowTemplate(wrap.querySelectorAll('.line-row').length));
    renumberRows();
  });

  // remove line
  wrap.addEventListener('click', function(e){
    if (e.target.closest('.btn-remove-line')) {
      e.preventDefault();
      e.target.closest('.line-row').remove();
      renumberRows();
    }
  });

  // before submit: ubah semua numeral ke RAW (tanpa ribuan, decimal titik)
  document.getElementById('lines-form').addEventListener('submit', function(){
    document.querySelectorAll('.qty-input, .rate-input').forEach(el => {
      el.value = toRaw(el.value);
    });
    // amount adalah readonly display — tidak perlu dikirim
  });
});
</script>
<?php $this->end(); ?>

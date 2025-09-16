<div class="card card-primary shadow-sm">
  <div class="card-header">
    <h3 class="card-title">Add Quotation — Step 1 of 2 (Header)</h3>
  </div>

  <div class="card-body">
    <?= $this->Form->create($quotation, ['class'=>'needs-validation', 'novalidate'=>true]) ?>
      <?= $this->Form->hidden('business_type', ['value'=>'freight']) ?>
      <?= $this->Form->hidden('status', ['value'=>'DRAFT']) ?>

      <div class="row g-3">
        <!-- VALID UNTIL paling atas -->
        <div class="col-md-4">
          <label for="valid-until" class="form-label">Valid Until</label>
          <?= $this->Form->control('valid_until', [
            'id'        => 'valid-until',
            'type'      => 'date',
            'class'     => 'form-control',
            'label'     => false,
            'autofocus' => true,
          ]) ?>
          <div class="form-text">Default +7 hari (sementara, nanti ambil dari Settings).</div>
        </div>

        <!-- CUSTOMER -->
        <div class="col-md-4">
          <label for="customer-id" class="form-label">Customer</label>
          <?= $this->Form->control('customer_id', [
            'id'      => 'customer-id',
            'type'    => 'select',
            'options' => $customers,
            'class'   => 'form-select',
            'label'   => false,
            'required'=> true,
          ]) ?>
        </div>

        <!-- SERVICE -->
        <div class="col-md-4">
          <label for="sales-service" class="form-label">Service</label>
          <?= $this->Form->select('sales_service_id', $serviceOptions, [
            'id'       => 'sales-service',
            'class'    => 'form-select',
            'empty'    => 'Pilih layanan…',
            'required' => true,
          ]) ?>
        </div>

        <!-- PAYMENT TERM -->
        <div class="col-md-4">
          <label for="payment-term" class="form-label">Payment Term</label>
          <?= $this->Form->control('payment_term_id', [
            'id'      => 'payment-term',
            'type'    => 'select',
            'options' => $paymentTerms,
            'class'   => 'form-select',
            'label'   => false,
            'required'=> true,
          ]) ?>
        </div>

        <!-- NOTE 1 -->
        <div class="col-12">
          <label for="note_1" class="form-label">Note 1 (Catatan di bawah Quotation Letter)</label>
          <?= $this->Form->control('note_1', [
            'id'    => 'note_1',
            'type'  => 'textarea',
            'rows'  => 5,
            'class' => 'form-control',
            'label' => false,
          ]) ?>
        </div>

       
      </div>

      <div class="mt-3 d-flex gap-2">
        <?= $this->Form->button('Next: Lines', ['class'=>'btn btn-primary']) ?>
        <?= $this->Html->link('Cancel', ['action'=>'index'], ['class'=>'btn btn-outline-secondary']) ?>
      </div>

    <?= $this->Form->end() ?>
  </div>
</div>
<?php $this->start('script'); ?>
<!-- 1) Load TinyMCE, lalu init saat onload -->
<script>
  function initTiny() {
    if (!window.tinymce) { console.warn('TinyMCE belum tersedia'); return; }

    // Bersihkan editor lama (kalau reload via PJAX/htmx/whatever)
    (tinymce.EditorManager?.editors || []).forEach(ed => { try { ed.remove(); } catch(e){} });

    // 2) Selector robust: id OR name OR class .tinymce
    const selectors = [
      'textarea#note_1','textarea#note_2',
      'textarea[name="note_1"]','textarea[name="note_2"]',
      'textarea.tinymce'
    ];
    const uniq = [...new Set(selectors)].join(',');

    tinymce.init({
      selector: uniq,
      menubar: true,
      statusbar: true,
      // 3) Konfigurasi minimal stabil (semua bawaan core/community)
      plugins: 'advlist autolink lists link table code',
      toolbar:
        'undo redo | styleselect | fontselect fontsizeselect | '+
        'bold italic underline strikethrough | '+
        'alignleft aligncenter alignright alignjustify | '+
        'bullist numlist outdent indent | table | link | code',
      branding: false,
      width: '100%',
      min_height: 160,
      resize: 'both',
      content_style: 'body{max-width:100%;box-sizing:border-box;}',
      valid_elements:
        'p,strong/b,em/i,u,strike,span[style],a[href|target],'+
        'ul,ol,li,table,thead,tbody,tfoot,tr,td,th,'+
        'h1,h2,h3,h4,h5,h6'
    });

    // Debug kecil
    setTimeout(() => {
      const n = tinymce?.EditorManager?.editors?.length || 0;
      if (n === 0) console.warn('TinyMCE belum terpasang ke textarea apa pun (cek selector/ID).');
    }, 500);
  }
</script>
<script src="https://cdn.tiny.cloud/1/klpop8ud5zsip7zloht3kglaf0it7sau7hlm7yfscb3cjxsq/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"
        onload="initTiny()"></script>
<?php $this->end(); ?>

<div class="d-flex justify-content-between align-items-center mt-3">
  <div>
    <?= $this->Paginator->prev('« Sebelumnya', ['class'=>'btn btn-outline-secondary btn-sm']) ?>
    <?= $this->Paginator->numbers(['class'=>'btn btn-outline-primary btn-sm']) ?>
    <?= $this->Paginator->next('Berikutnya »', ['class'=>'btn btn-outline-secondary btn-sm']) ?>
  </div>
  <div class="text-muted small">
    Halaman <?= $this->Paginator->counter('{{page}} dari {{pages}} ({{current}} data ditampilkan)') ?>
  </div>
</div>

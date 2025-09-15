<?php /** @var \Sales\Model\Entity\SalesOrder $salesOrder */ ?>
<div class="container py-3">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h3>Order <?= h($salesOrder->number) ?></h3>
    <div>
      <?= $this->Html->link('Edit', ['action'=>'edit', $salesOrder->id], ['class'=>'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link('Back', ['action'=>'index'], ['class'=>'btn btn-secondary btn-sm']) ?>
    </div>
  </div>
  <div class="card mb-3"><div class="card-body">
    <div><strong>Date:</strong> <?= h($salesOrder->date? $salesOrder->date->i18nFormat('yyyy-MM-dd') : '-') ?></div>
    <div><strong>Status:</strong> <?= h($salesOrder->status) ?></div>
    <div><strong>Currency:</strong> <?= h($salesOrder->currency ?? 'USD') ?></div>
    <div><strong>Notes:</strong> <?= nl2br(h($salesOrder->notes ?? '-')) ?></div>
  </div></div>

  <div class="card">
    <div class="card-header">Lines</div>
    <div class="card-body table-responsive">
      <table class="table table-sm">
        <thead><tr><th>Origin</th><th>Destination</th><th>Description</th><th class="text-end">Qty</th><th class="text-end">Price</th><th class="text-end">Amount</th></tr></thead>
        <tbody>
          <?php foreach ($salesOrder->sales_order_lines as $ln): ?>
            <tr>
              <td><?= h($ln->origin_id) ?></td>
              <td><?= h($ln->destination_id) ?></td>
              <td><?= h($ln->description) ?></td>
              <td class="text-end"><?= $this->Number->format($ln->qty, ['places'=>3]) ?></td>
              <td class="text-end"><?= $this->Number->currency($ln->price, $salesOrder->currency ?? 'USD') ?></td>
              <td class="text-end"><?= $this->Number->currency($ln->amount, $salesOrder->currency ?? 'USD') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

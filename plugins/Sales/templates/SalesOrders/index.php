<?php /** @var \Cake\Datasource\ResultSetInterface $salesOrders */ ?>
<div class="container py-3">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h3>Sales Orders</h3>
    <?= $this->Html->link('Add', ['action' => 'add'], ['class'=>'btn btn-primary btn-sm']) ?>
  </div>
  <div class="card">
    <div class="card-body table-responsive">
      <table class="table table-hover table-sm align-middle">
        <thead><tr><th>Number</th><th>Date</th><th>Status</th><th class="text-end">Action</th></tr></thead>
        <tbody>
          <?php foreach ($salesOrders as $o): ?>
          <tr>
            <td><?= h($o->number) ?></td>
            <td><?= h($o->date? $o->date->i18nFormat('yyyy-MM-dd') : '-') ?></td>
            <td><?= h($o->status) ?></td>
            <td class="text-end">
              <?= $this->Html->link('View', ['action' => 'view', $o->id], ['class'=>'btn btn-outline-secondary btn-sm']) ?>
              <?= $this->Html->link('Edit', ['action' => 'edit', $o->id], ['class'=>'btn btn-outline-primary btn-sm']) ?>
              <?= $this->Form->postLink('Delete', ['action' => 'delete', $o->id], ['class'=>'btn btn-outline-danger btn-sm','confirm'=>'Delete this order?']) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?= $this->element('pagination') ?>
    </div>
  </div>
</div>

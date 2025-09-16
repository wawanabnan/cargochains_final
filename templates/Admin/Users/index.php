<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0">Users</h3>
  <?= $this->Html->link('Add User', ['action'=>'add'], ['class'=>'btn btn-primary']) ?>
</div>

<div class="table-responsive">
<table class="table table-hover align-middle">
  <thead><tr>
    <th>ID</th><th>Email</th><th>Active</th><th>Groups</th><th>Created</th><th></th>
  </tr></thead>
  <tbody>
  <?php foreach ($users as $u): ?>
    <tr>
      <td><?= $u->id ?></td>
      <td><?= h($u->email ?? $u->username) ?></td>
      <td><?= $u->active ? 'Yes' : 'No' ?></td>
      <td>
        <?php if (!empty($u->groups)) {
            echo implode(', ', array_map(fn($g)=>h($g->name), $u->groups));
        } ?>
      </td>
      <td><?= $u->created? $u->created->format('Y-m-d H:i'):'' ?></td>
      <td class="text-end">
        <?= $this->Html->link('View', ['action'=>'view',$u->id], ['class'=>'btn btn-sm btn-outline-primary']) ?>
        <?= $this->Html->link('Edit', ['action'=>'edit',$u->id], ['class'=>'btn btn-sm btn-outline-warning']) ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>

<?= $this->element('pagination') // kalau ada element paginator-mu ?>

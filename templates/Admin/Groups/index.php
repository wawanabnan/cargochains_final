<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0">Groups</h3>
  <?= $this->Html->link('Add Group', ['action'=>'add'], ['class'=>'btn btn-primary']) ?>
</div>

<table class="table table-hover">
  <thead><tr><th>ID</th><th>Name</th><th>Created</th><th></th></tr></thead>
  <tbody>
  <?php foreach ($groups as $g): ?>
    <tr>
      <td><?= $g->id ?></td>
      <td><?= h($g->name) ?></td>
      <td><?= $g->created? $g->created->format('Y-m-d H:i'):'' ?></td>
      <td class="text-end">
        <?= $this->Html->link('Edit', ['action'=>'edit',$g->id], ['class'=>'btn btn-sm btn-outline-warning']) ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<h3>Add User</h3>
<?= $this->Form->create($user) ?>

<div class="row g-3">
  <div class="col-md-6">
    <?= $this->Form->control('email', ['label'=>'Email','class'=>'form-control']) ?>
  </div>
  <div class="col-md-6">
    <?= $this->Form->control('password', ['label'=>'Password','class'=>'form-control']) ?>
  </div>

  <div class="col-md-3">
    <?= $this->Form->control('active', ['type'=>'checkbox','label'=>'Active']) ?>
  </div>
  <div class="col-md-9">
    <?= $this->Form->control('groups._ids', [
      'type' => 'select',
      'multiple' => 'checkbox', // atau 'multiple' => true untuk multiselect
      'options' => $groupsList,
      'label' => 'Groups'
    ]) ?>
  </div>
</div>

<div class="mt-3">
  <?= $this->Form->button('Save', ['class'=>'btn btn-primary']) ?>
  <?= $this->Html->link('Cancel', ['action'=>'index'], ['class'=>'btn btn-secondary ms-2']) ?>
</div>

<?= $this->Form->end() ?>

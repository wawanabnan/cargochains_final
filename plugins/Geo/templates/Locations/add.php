<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $location
 * @var \Cake\Collection\CollectionInterface|string[] $parentLocations
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Locations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="locations form content">
            <?= $this->Form->create($location) ?>
            <fieldset>
                <legend><?= __('Add Location') ?></legend>
                <?php
                    echo $this->Form->create($location);
					echo $this->Form->control('code');
					echo $this->Form->control('name');
					echo $this->Form->control('latitude');
					echo $this->Form->control('longitude');
					use Geo\Model\Entity\Location as Loc;
					echo $this->Form->control('kind', [
					  'options' => array_combine(Loc::KINDS, Loc::KINDS),
					  'empty' => '— pilih jenis —'
					]);

					echo $this->Form->control('parent_id', [
					  'options' => $parentLocations,
					  'empty' => '— tanpa parent —'
					]);

					echo $this->Form->button('Simpan');
					echo $this->Form->end();

                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

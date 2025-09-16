<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $partner
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $partner->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $partner->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Partners'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="partners form content">
            <?= $this->Form->create($partner) ?>
            <fieldset>
                <legend><?= __('Edit Partner') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('address');
                    echo $this->Form->control('city');
                    echo $this->Form->control('country');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

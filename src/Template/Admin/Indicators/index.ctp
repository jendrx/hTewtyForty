<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Indicator[]|\Cake\Collection\CollectionInterface $indicators
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Indicator'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Studies'), ['controller' => 'Studies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Rounds'), ['controller' => 'Rounds','action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="indicators index large-9 medium-8 columns content">
    <h3><?= __('Indicators') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($indicators as $indicator): ?>
            <tr>
                <td><?= $this->Number->format($indicator->id) ?></td>
                <td><?= h($indicator->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $indicator->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $indicator->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $indicator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $indicator->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

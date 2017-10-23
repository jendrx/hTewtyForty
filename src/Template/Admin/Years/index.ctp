<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Year[]|\Cake\Collection\CollectionInterface $years
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Year'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions Indicators'), ['controller' => 'QuestionsIndicators', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Questions Indicator'), ['controller' => 'QuestionsIndicators', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="years index large-9 medium-8 columns content">
    <h3><?= __('Years') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($years as $year): ?>
            <tr>
                <td><?= $this->Number->format($year->id) ?></td>
                <td><?= h($year->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $year->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $year->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $year->id], ['confirm' => __('Are you sure you want to delete # {0}?', $year->id)]) ?>
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

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionsIndicator[]|\Cake\Collection\CollectionInterface $questionsIndicators
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Questions Indicator'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Studies'), ['controller' => 'Studies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Rounds'), ['controller' => 'Rounds','action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Indicators'), ['controller' => 'Indicators', 'Indicators' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="questionsIndicators index large-9 medium-8 columns content">
    <h3><?= __('Questions Indicators') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('indicator_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('target') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ratio') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questionsIndicators as $questionsIndicator): ?>
            <tr>
                <td><?= $this->Number->format($questionsIndicator->id) ?></td>
                <td><?= $questionsIndicator->has('question') ? $this->Html->link($questionsIndicator->question->id, ['controller' => 'Questions', 'action' => 'view', $questionsIndicator->question->id]) : '' ?></td>
                <td><?= $questionsIndicator->has('indicator') ? $this->Html->link($questionsIndicator->indicator->id, ['controller' => 'Indicators', 'action' => 'view', $questionsIndicator->indicator->id]) : '' ?></td>
                <td><?= h($questionsIndicator->target) ?></td>
                <td><?= h($questionsIndicator->ratio)?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $questionsIndicator->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $questionsIndicator->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $questionsIndicator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionsIndicator->id)]) ?>
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

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Round $round
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Round'), ['action' => 'edit', $round->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Round'), ['action' => 'delete', $round->id], ['confirm' => __('Are you sure you want to delete # {0}?', $round->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rounds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Round'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Studies'), ['controller' => 'Studies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Study'), ['controller' => 'Studies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions Indicators'), ['controller' => 'QuestionsIndicators', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questions Indicator'), ['controller' => 'QuestionsIndicators', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rounds view large-9 medium-8 columns content">
    <h3><?= h($round->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Study') ?></th>
            <td><?= $round->has('study') ? $this->Html->link($round->study->id, ['controller' => 'Studies', 'action' => 'view', $round->study->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($round->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Step') ?></th>
            <td><?= $this->Number->format($round->step) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($round->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Completed') ?></th>
            <td><?= h($round->completed) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Questions Indicators') ?></h4>
        <?php if (!empty($round->questions_indicators)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col"><?= __('Indicator Id') ?></th>
                <th scope="col"><?= __('Target') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($round->questions_indicators as $questionsIndicators): ?>
            <tr>
                <td><?= h($questionsIndicators->id) ?></td>
                <td><?= h($questionsIndicators->question_id) ?></td>
                <td><?= h($questionsIndicators->indicator_id) ?></td>
                <td><?= h($questionsIndicators->target) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'QuestionsIndicators', 'action' => 'view', $questionsIndicators->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'QuestionsIndicators', 'action' => 'edit', $questionsIndicators->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'QuestionsIndicators', 'action' => 'delete', $questionsIndicators->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionsIndicators->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

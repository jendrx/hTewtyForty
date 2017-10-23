<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Year $year
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Year'), ['action' => 'edit', $year->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Year'), ['action' => 'delete', $year->id], ['confirm' => __('Are you sure you want to delete # {0}?', $year->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Years'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Year'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions Indicators'), ['controller' => 'QuestionsIndicators', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questions Indicator'), ['controller' => 'QuestionsIndicators', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="years view large-9 medium-8 columns content">
    <h3><?= h($year->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($year->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($year->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($year->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Questions Indicators') ?></h4>
        <?php if (!empty($year->questions_indicators)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col"><?= __('Indicator Id') ?></th>
                <th scope="col"><?= __('Target') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($year->questions_indicators as $questionsIndicators): ?>
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

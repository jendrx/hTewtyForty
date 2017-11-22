<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionsIndicator $questionsIndicator
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Questions Indicator'), ['action' => 'edit', $questionsIndicator->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Questions Indicator'), ['action' => 'delete', $questionsIndicator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionsIndicator->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questions Indicators'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questions Indicator'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Indicators'), ['controller' => 'Indicators', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Indicator'), ['controller' => 'Indicators', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Years'), ['controller' => 'Years', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Year'), ['controller' => 'Years', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questionsIndicators view large-9 medium-8 columns content">
    <h3><?= h($questionsIndicator->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $questionsIndicator->has('question') ? $this->Html->link($questionsIndicator->question->id, ['controller' => 'Questions', 'action' => 'view', $questionsIndicator->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Indicator') ?></th>
            <td><?= $questionsIndicator->has('indicator') ? $this->Html->link($questionsIndicator->indicator->id, ['controller' => 'Indicators', 'action' => 'view', $questionsIndicator->indicator->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($questionsIndicator->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Target') ?></th>
            <td><?= $questionsIndicator->target ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ratio') ?></th>
            <td><?= $questionsIndicator->ratio ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Label') ?></h4>
        <?= $this->Text->autoParagraph(h($questionsIndicator->label)); ?>
    </div>
    <div class="row">
        <h4><?= __('Title') ?></h4>
        <?= $this->Text->autoParagraph(h($questionsIndicator->title)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Years') ?></h4>
        <?php if (!empty($questionsIndicator->years)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($questionsIndicator->years as $years): ?>
            <tr>
                <td><?= h($years->id) ?></td>
                <td><?= h($years->created) ?></td>
                <td><?= h($years->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Years', 'action' => 'view', $years->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Years', 'action' => 'edit', $years->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Years', 'action' => 'delete', $years->id], ['confirm' => __('Are you sure you want to delete # {0}?', $years->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

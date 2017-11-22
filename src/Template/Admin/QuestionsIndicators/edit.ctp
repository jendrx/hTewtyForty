<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionsIndicator $questionsIndicator
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $questionsIndicator->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $questionsIndicator->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Questions Indicators'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Indicators'), ['controller' => 'Indicators', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Indicator'), ['controller' => 'Indicators', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Years'), ['controller' => 'Years', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Year'), ['controller' => 'Years', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questionsIndicators form large-9 medium-8 columns content">
    <?= $this->Form->create($questionsIndicator) ?>
    <fieldset>
        <legend><?= __('Edit Questions Indicator') ?></legend>
        <?php
            echo $this->Form->control('question_id', ['options' => $questions, 'empty' => true]);
            echo $this->Form->control('indicator_id', ['options' => $indicators, 'empty' => true]);
            echo $this->Form->control('target');
            echo $this->Form->control('ratio');
            echo $this->Form->control('label');
            echo $this->Form->control('title');
            echo $this->Form->control('years._ids', ['options' => $years]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

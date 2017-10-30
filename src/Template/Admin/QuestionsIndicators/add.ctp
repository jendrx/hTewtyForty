<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionsIndicator $questionsIndicator
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Questions Indicators'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Studies'), ['controller' => 'Studies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Rounds'), ['controller' => 'Rounds','action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Indicators'), ['controller' => 'Users', 'Indicators' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="questionsIndicators form large-9 medium-8 columns content">
    <?= $this->Form->create($questionsIndicator) ?>
    <fieldset>
        <legend><?= __('Add Questions Indicator') ?></legend>
        <?php
            echo $this->Form->control('question_id', ['options' => $questions, 'empty' => true]);
            echo $this->Form->control('indicator_id', ['options' => $indicators, 'empty' => true]);
            echo $this->Form->control('target');
            echo $this->Form->control('ratio');
            echo $this->Form->control('years._ids', ['options' => $years]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

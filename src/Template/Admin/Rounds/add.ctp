<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Round $round
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Rounds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Studies'), ['controller' => 'Studies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Study'), ['controller' => 'Studies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions Indicators Years'), ['controller' => 'QuestionsIndicatorsYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Questions Indicators Year'), ['controller' => 'QuestionsIndicatorsYears', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rounds form large-9 medium-8 columns content">
    <?= $this->Form->create($round) ?>
    <fieldset>
        <legend><?= __('Add Round') ?></legend>
        <?php
            echo $this->Form->control('step');
            echo $this->Form->control('completed');
            echo $this->Form->control('study_id', ['options' => $studies, 'empty' => true]);
            echo $this->Form->control('questions_indicators_years._ids', ['options' => $questionsIndicatorsYears]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Round $round
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $round->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $round->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rounds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Studies'), ['controller' => 'Studies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Study'), ['controller' => 'Studies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions Indicators'), ['controller' => 'QuestionsIndicators', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Questions Indicator'), ['controller' => 'QuestionsIndicators', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rounds form large-9 medium-8 columns content">
    <?= $this->Form->create($round) ?>
    <fieldset>
        <legend><?= __('Edit Round') ?></legend>
        <?php
            echo $this->Form->control('step');
            echo $this->Form->control('completed');
            echo $this->Form->control('study_id', ['options' => $studies, 'empty' => true]);
            echo $this->Form->control('questions_indicators._ids', ['options' => $questionsIndicators]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

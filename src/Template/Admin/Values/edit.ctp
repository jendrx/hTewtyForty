<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Value $value
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $value->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $value->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Values'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Answers'), ['controller' => 'Answers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Previews'), ['controller' => 'Previews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Preview'), ['controller' => 'Previews', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rounds Questions Indicators'), ['controller' => 'RoundsQuestionsIndicators', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rounds Questions Indicator'), ['controller' => 'RoundsQuestionsIndicators', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="values form large-9 medium-8 columns content">
    <?= $this->Form->create($value) ?>
    <fieldset>
        <legend><?= __('Edit Value') ?></legend>
        <?php
            echo $this->Form->control('description');
            echo $this->Form->control('answers._ids', ['options' => $answers]);
            echo $this->Form->control('previews._ids', ['options' => $previews]);
            echo $this->Form->control('rounds_questions_indicators._ids', ['options' => $roundsQuestionsIndicators]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

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
        <li><?= $this->Html->link(__('List Questions Indicators Years'), ['controller' => 'QuestionsIndicatorsYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Questions Indicators Year'), ['controller' => 'QuestionsIndicatorsYears', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rounds form large-9 medium-8 columns content">
    <?= $this->Form->create($round) ?>
    <fieldset>
        <legend><?= __('Add Round') ?></legend>
        <?php
        echo $this->Form->control('step', ['readonly']);
        $index = 0;
        echo '<div class="row"><div class="large-12">';
        echo '<h4> Target Indicators</h4>';
        foreach($indicatorsYears as $indicatorYears):
            echo $this->Form->control('questions_indicators_years.'.$index.'.description',['value' => $indicatorYears->description, 'readonly']);
            foreach($indicatorYears['years'] as $indicatorYear):
                echo $this->Form->control('questions_indicators_years.'.$index.'.id',['value' => $indicatorYear['question_indicator_year_id']]);
                echo '<div class="large-4 columns">';
                echo $this->Form->control('questions_indicators_years.'.$index.'._joinData.value',['value' =>$indicatorYear['value']]);
                echo '</div>';
                $index = $index + 1;
            endforeach;
        endforeach;
        echo '</div></div>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

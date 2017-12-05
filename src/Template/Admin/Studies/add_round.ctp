<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/27/17
 * Time: 9:52 AM
 */?>
<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/16/17
 * Time: 3:42 PM
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Studies'), ['controller' => 'studies','action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Rounds'), ['controller' => 'rounds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Questions'), ['controller' => 'questions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Indicators'), ['controller' => 'indicators', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller' => 'users', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="rounds form large-9 medium-8 columns content">
    <?= $this->Form->create($round) ?>
    <fieldset>
        <legend><?= __('Add Round') ?></legend>
        <?php
        echo $this->Form->control('step', ['value' => $step, 'readonly']);
        echo $this->Form->control('study_id', ['value' => $study_id, 'type' => 'hidden']);


        $index = 0;
        echo '<div class="row"><div class="large-12">';
        echo '<h4> Target Indicators</h4>';
        foreach($indicatorsYears as $indicatorYears):
            echo $this->Form->control('questions_indicators_years.'.$index.'.description',['value' => $indicatorYears->description, 'readonly']);
            foreach($indicatorYears['years'] as $indicatorYear):
                echo $this->Form->control('questions_indicators_years.'.$index.'.id',['value' => $indicatorYear['question_indicator_year_id']]);
                echo '<div class="large-4 columns">';
                echo $this->Form->control('questions_indicators_years.'.$index.'._joinData.value',['value' => 0]);
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



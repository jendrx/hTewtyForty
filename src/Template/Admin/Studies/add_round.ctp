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
        /*foreach($roundMean as $key => $value):
            echo json_encode($key);

            if($questionIndicator['target'] === true):

                echo $this->Form->control('questions_indicators.'.$index.'.id',['value' => $questionIndicator->id]);
                echo '<div class="large-3 columns">';
                echo $this->Form->control('questions_indicators.'.$index.'.description',['value' => $questionIndicator->indicator->description, 'readonly']);
                echo '</div>';
                echo '<div class="large-6 columns">';
                echo $this->Form->control('questions_indicators.'.$index.'._joinData.default_value');
                echo '</div>';
            endif;

            $index = $index + 1;

        endforeach;*/
        echo '</div></div>';



        echo '<div class="row"><div class="large-12">';
        echo '<h4> Informative Indicators </h4>';

        foreach($response['questions_indicators'] as $questionIndicator):
            if($questionIndicator['target'] === false):
                echo '<div class="large-3 columns">';
                echo $this->Form->control('Description',['value' => $questionIndicator->indicator->description, 'readonly']);
                echo '</div>';
            endif;
        endforeach;
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>



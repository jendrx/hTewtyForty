<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Study $study
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Studies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Rounds'), ['controller' => 'Rounds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Round'), ['controller' => 'Rounds', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="studies form large-9 medium-8 columns content">
    <?= $this->Form->create($study) ?>
    <fieldset>
        <legend><?= __('Add Study') ?></legend>
        <?php
            echo $this->Form->control('description', ['type' => 'text']);
            //echo $this->Form->control('completed');
            echo $this->Form->control('category',['options' => ['h2040' => 'Health 2040']]);
            echo $this->Form->control('scenario', ['value' => 1]);
            echo $this->Form->control('users._ids', ['options' => $users]);
            echo $this->Form->control('questions', ['options' => $questions, 'id' => 'question-id', 'empty' => true]);


            // Round


        ?>
    </fieldset>

    <fieldset id="fs-round">
        <legend><?= __('Round') ?></legend>
        <?php

        echo $this->Form->control('rounds.0.id');
        echo $this->Form->control('rounds.0.step',['value' => 1, 'readonly']);
        /*echo $this->Form->control('rounds.0.questions_indicators_years.0.id', ['value' => 17]);
        echo $this->Form->control('rounds.0.questions_indicators_years.0._joinData.value',['value' => 20]);*/

        ?>

    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<script>

    function getQuestionIndicators(question_id, callback)
    {
        $.ajax({
            type: "GET",
            url: '/hTwentyForty/admin/questions/getIndicators',
            dataType: 'json',
            data:{ 'id' : question_id},
            success: function (data)
            {
                callback(data);

            }
        });
    }

    $(document).ready(function(){

        $('#question-id').change(function()
        {
            // remove indicator div when question-id is changed
            $('#div-indicators').detach();

            getQuestionIndicators($('#question-id').val(), function(data)
            {

                var questionsIndicators = data.response.questions_indicators;

                var html = '<div id="div-indicators">';

                // variable that index a question_indicator_value record, nasty shit solution to solve
                var index = 0;
                for( i = 0, questionsIndicatorsLength = questionsIndicators.length; i < questionsIndicatorsLength; i++)
                {
                    var questionIndicator = questionsIndicators[i];

                    if(questionIndicator.target)
                    {
                        html += '<div class="row"><p>'+questionIndicator.indicator.description+'</p>';

                        for( j = 0, yearsLength = questionIndicator.years.length; j < yearsLength; j++)
                        {
                            html += '<input name="rounds[0][questions_indicators_years]['+(index)+'][id]" id="rounds-0-questions-indicators-years-'+(index)+'-id" value="'+questionIndicator.years[j]._joinData.id+'" type="hidden">' +
                            '<div class="large-4 columns">' +
                            '<div class="small-3 columns">' +
                            '<label for="rounds-0-questions-indicators-years-' + index + '-joindata-value"> '+ questionIndicator.years[j].description+' </label>' +
                            '</div>' +
                            '<div class="small-9 columns">' +
                            '<input name="rounds[0][questions_indicators_years][' + index + '][_joinData][value]" step="any" id="rounds-0-questions-indicators-years' + index + '-joindata-value" type="number">' +
                            '</div></div>';
                            index = index + 1;
                        }
                        html += '</div>';
                    }

                }

                html += '</div>';

                $('#fs-round').append(html);
            });
        });



    });



</script>

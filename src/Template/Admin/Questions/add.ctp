<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Indicators'), ['controller' => 'Indicators', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Indicator'), ['controller' => 'Indicators', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questions form large-9 medium-8 columns content">
    <?= $this->Form->create($question) ?>
    <fieldset>
        <legend><?= __('Add Question') ?></legend>
        <?php
            echo $this->Form->control('description');
            echo $this->Form->control('indicator', ['type' => 'select','multiple' => true, 'id' => 'indicator-ids']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>


<script>

    $(document).ready(function()
    {
        $('#indicator-ids').change(function(){
            $('#indicatorsTable').detach();

            var tableHtml = '<table id="indicatorsTable"><thead>' +
                '<tr><td>Indicator</td>' +
                '<td>Target</td>' +
                '</tr>' +
                '</thead>';
            tableHtml += '<tbody>';

            $('option:selected').each(function(index){
                tableHtml += '<tr><input name="indicators['+index+'][id]" id="indicators-'+index+'-id" value="'+$(this).val()+'" type="hidden">' +
                    '<td>'+$(this).text()+'</td>' +
                    '<td>' +
                    '<div class="input checkbox">' +
                    '<input name="indicators['+index+'][_joinData][target]" value="0" type="hidden">' +
                    '<input name="indicators['+index+'][_joinData][target]" value="1" id="indicators-'+index+'-joindata-target" type="checkbox">' +
                    '</div>' +
                    '</td>' +
                    '</tr>'

            });
            tableHtml +='</tbody></div>'
            $('fieldset').append(tableHtml);
        });

    });

</script>

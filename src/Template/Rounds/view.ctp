<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 12/4/17
 * Time: 10:54 PM
 */
?>
<?php  echo $this->Html->script('https://www.gstatic.com/charts/loader.js'); ?>
<div id="div-round-view-content" class="row">
    <div class="large-12 columns round-content">
        <!--question div-->
        <div class="row">
            <div class="row ">

                <div class="large-10 large-centered columns panel">
                    <?php if($isFirst): ?>
                    <p> Considere os seguintes cenários caracterizados por uma convergência estável, decrescente e crescente do número de médicos (por mil hab.), enfermeiros (por mil hab.) e respetiva evolução do rácio enfermeiros por médico em Portugal.
                        <br>
                        <br>
                        Refira, para cada ano assinalado (2020, 2030 e 2040), o número de médicos (por mil hab.), enfermeiros (por mil hab.) e rácio de enfermeiros por médico. Note que os valores a indicar podem estar fora do intervalo exposto em cada um dos gráficos.</p>
                    <?php else:?>
                        <p> Perante o conhecimento das respostas de todos os peritos, reveja a(s) sua(s) resposta(s), se assim entender, de forma a concluir a segunda ronda do questionário.</p>

                    <?php endif; ?>
                </div>

            </div>
            <?php echo $this->Form->create($answer,[ 'url' => ['controller' => 'answers', 'action' => 'add'],'id' => 'form-round']); ?>
            <?php $index = 0; ?>
            <?php if(empty($userAnswers)): ?>
                <!-- target-->
                <div class="row">
                    <?php foreach($roundValues as $roundValue): ?>
                        <?php if(!$roundValue['ratio']):?>
                            <div class="large-6 columns">
                                <div id="target-chart-<?=$roundValue['indicator']['filename']?>"></div>
                                <?php foreach ($roundValue['round_values'] as $yearValue):?>
                                    <?php echo $this->Form->control($index.'.id',['type' => 'hidden']);
                                    echo $this->Form->control($index.'.round_question_indicator_year_id',['type' => 'hidden','value' => $yearValue['round_question_indicator_year_id']]);?>

                                    <div class="large-4 columns">
                                        <div class="small-5 columns">
                                            <label for="right-label" class="right" id = "<?='input-'.$roundValue['indicator']['filename'].'-'.$yearValue['Year']?>"><?=$yearValue['Year'] ?></label>
                                        </div>
                                        <div class="small-7 columns" lang="en-US">
                                            <?= $this->Form->control($index.'.value', ['value' =>$yearValue['value'] ,'type' => 'number', 'label' => false , 'id'=> 'input-'.$roundValue['indicator']['filename'].'-'.$yearValue['Year'], 'min' => 0, 'step' => '0.1'])?>
                                        </div>
                                    </div>
                                    <?php $index = $index + 1; ?>
                                <?php endforeach;?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <!-- ratio -->
                <div class="row">
                    <?php foreach($roundValues as $roundValue): ?>
                        <?php if($roundValue['ratio']):?>
                            <div class="large-6 large-centered columns">
                                <div id="target-chart-<?=$roundValue['indicator']['filename']?>"></div>
                                <?php foreach ($roundValue['round_values'] as $yearValue):?>
                                    <?php echo $this->Form->control($index.'.id',['type' => 'hidden']);
                                    echo $this->Form->control($index.'.round_question_indicator_year_id',[ 'type' => 'hidden','value' => $yearValue['round_question_indicator_year_id']]);?>
                                    <div class="large-4 columns">
                                        <div class="small-5 columns">
                                            <label for="right-label" class="right" id = "<?='input-'.$roundValue['indicator']['filename'].'-'.$yearValue['Year']?>"><?=$yearValue['Year'] ?></label>
                                        </div>
                                        <div class="small-7 columns " lang="en-US">
                                            <?= $this->Form->control($index.'.value', ['value' =>$yearValue['value'] ,'type' => 'number', 'label' => false , 'id'=> 'input-'.$roundValue['indicator']['filename'].'-'.$yearValue['Year'], 'min' => 0, 'step' => '0.1'])?>
                                        </div>
                                    </div>

                                    <?php $index = $index + 1; ?>
                                <?php endforeach;?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php else:?>
                <!-- target-->
                <div class="row">
                    <?php foreach($userAnswers as $userAnswer): ?>
                        <?php if(!$userAnswer['ratio']):?>
                            <div class="large-6 columns">
                                <div id="target-chart-<?=$userAnswer['indicator']['filename']?>"></div>
                                <?php foreach ($userAnswer['user_values'] as $yearValue):?>
                                    <?php echo $this->Form->control($index.'.id',['type' => 'hidden']);
                                    echo $this->Form->control($index.'.round_question_indicator_year_id',['type' => 'hidden','value' => $yearValue['round_question_indicator_year_id']]);?>
                                    <div class="large-4 columns">
                                        <div class="small-5 columns">
                                            <label for="right-label" class="right" id = "<?='input-'.$userAnswer['indicator']['filename'].'-'.$yearValue['Year']?>"><?=$yearValue['Year'] ?></label>
                                        </div>
                                        <div class="small-7 columns" lang="en-US">
                                            <?= $this->Form->control($index.'.value', ['value' =>$yearValue['value'] ,'type' => 'number', 'label' => false , 'id'=> 'input-'.$userAnswer['indicator']['filename'].'-'.$yearValue['Year'], 'min' => 0, 'step' => '0.1'])?>
                                        </div>
                                    </div>

                                    <?php $index = $index + 1; ?>
                                <?php endforeach;?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <!-- ratio -->
                <div class="row">
                    <?php foreach($userAnswers as $userAnswer): ?>
                        <?php if($userAnswer['ratio']):?>
                            <div class="large-6  large-centered columns">
                                <div id="target-chart-<?=$userAnswer['indicator']['filename']?>"></div>
                                <?php foreach ($userAnswer['user_values'] as $yearValue):?>
                                    <?php echo $this->Form->control($index.'.id',['type' => 'hidden']);
                                    echo $this->Form->control($index.'.round_question_indicator_year_id',['type' => 'hidden','value' => $yearValue['round_question_indicator_year_id']]);?>
                                    <div class="large-4 columns">
                                        <div class="small-5 columns">
                                            <label for="right-label" class="right" id = "<?='input-'.$userAnswer['indicator']['filename'].'-'.$yearValue['Year']?>"><?=$yearValue['Year'] ?></label>
                                        </div>
                                        <div class="small-7 columns" lang="en-US">
                                            <?= $this->Form->control($index.'.value', ['value' =>$yearValue['value'] ,'type' => 'number', 'label' => false , 'id'=> 'input-'.$userAnswer['indicator']['filename'].'-'.$yearValue['Year'], 'min' => 0, 'step' => '0.1'])?>
                                        </div>
                                    </div>
                                    <?php $index = $index + 1; ?>
                                <?php endforeach;?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif;?>
            <?php echo $this->Form->Button(__('Submit'),['class' => ['button tiny right'],'id' => 'btn-submit']);
            echo $this->Form->end(); ?>
        <!-- end question_div -->
        </div>

    </div>
</div>

<script>
    google.charts.load('current', {'packages':['corechart']});

    function mergeData(dataOne,dataTwo,key) {

        console.log(dataOne)
        console.log(dataTwo)
        var merged = [];
        var size
        if(dataOne.length > dataTwo.length)
            size = dataOne.length

        var temp ={};
        for(index = 0; index < size; index ++)
        {
            dataOne[index][key] = null;
            merged.push(dataOne[index]);
        }
        for(index = 0;index < dataTwo.length; index ++)
        {
            for(j = 0; j < merged.length; j++)
            {
                if(merged[j]['Year'] == dataTwo[index]['Year'])
                    merged[j][key] = dataTwo[index]['value']
            }
        }
        return merged;
    }

    function parseChartData(data) {
        var keys = Object.keys(data[0]);
        var cols = [];
        var rows = [];
        for (keyIndex = 0, keysLength = keys.length; keyIndex < keysLength; keyIndex ++)
        {
            if(keyIndex > 1)
                cols.push({label : keys[keyIndex], type : 'number'});
            else
                cols.push({label : keys[keyIndex], type : 'number'});
        }

        for (rowIndex = 0, length = data.length; rowIndex < length; rowIndex ++)
        {
            var rowValues = Object.values(data[rowIndex]);
            var values = [];
            for(colIndex = 0, rowLength = rowValues.length; colIndex < rowLength; colIndex ++)
            {
                values.push({v:rowValues[colIndex]});
            }
            rows.push({c:values});
        }

        return {cols:cols,rows:rows};
    }

    function getIndicatorData(scenario, indicator, confidence,callback) {
        $.ajax({
            type: "GET",
            url: '/hTwentyForty/charts/getIndicatorData',
            dataType: 'json',
            data: {
                'scenario' : scenario,
                'indicator' : indicator,
                'confidence' : confidence},

            success: function (data)
            {
                callback(data.response);
            }
        });

    }

    function drawChart(chart_data,chart_div, chart1_main_title, chart1_vaxis_title,options) {
        var chart1_data = new google.visualization.DataTable(chart_data);


        var chart1_options = options;
        if(chart1_options === undefined)
        {
            chart1_options = {
                height:300,
                title: chart1_main_title,
                series: [{'color': '#d8b45d'},{'color':"#dd5d32"},{'color': '#1e675a'}],
                vAxis: {title: chart1_vaxis_title},
                hAxis: { format:''},
                legend: {
                    position: 'top'
                }
            };
        }

        var chart1_chart = new google.visualization.ComboChart(document.getElementById(chart_div));
        chart1_chart.draw(chart1_data, chart1_options);
    }

    function smooth(scenario,indicator,confidence,values,callback) {
        $.ajax({
            type: "POST",
            url: '/hTwentyForty/charts/smooth',
            dataType: 'json',
            data: {
                'scenario' : scenario,
                'indicator' : indicator,
                'confidence' : confidence,
                'values' : values},
            success: function (data)
            {
                callback(data.response);
            }
        });
    }

    // functions related with user input
    function objectifyForm(formArray) {
        var objectified = {};

        for(i = 0,length = formArray.length; i < length; i++)
        {
            objectified[formArray[i]['name']] = formArray[i]['value'];
        }
        return objectified;
    }

    function validate(data) {
        $.ajax({
            type: 'POST',
            url: '/hTwentyForty/answers/validate',
            dataType: 'json',
            data: data,
            success: function (data)
            {
                if(!data.response)
                {
                    alert("Os valores que introduziu não são consistentes!")
                }else
                {
                    $('#form-round').submit();

                }
            }
        });
    }

    $(document).ready( function(){
         var round = <?php echo json_encode($round); ?>;
         var questions = <?php echo json_encode($questions);?>;
         var user_answers = <?php echo json_encode($userAnswers);?>;
         var round_values = <?php echo json_encode($roundValues);?>;

         var isFirst = <?php echo json_encode($isFirst);?>;

         if(isFirst)
         {
             /*for( index = 0, info_indicators_length = informative_indicators.length; index < info_indicators_length; index++)
             {
                 (function(cntr)
                 {
                     var current_indicator = informative_indicators[cntr]
                     google.charts.setOnLoadCallback(function(){
                         getIndicatorData(round.study.scenario,current_indicator.indicator.filename,0,function(data){
                             drawChart(parseChartData(data),'info-chart-'+current_indicator.indicator.filename,current_indicator.title,current_indicator.label)});
                     });
                 })(index);
             }*/

             for( index = 0, target_indicators_length = round_values.length; index < target_indicators_length; index++)
             {
                 (function(cntr)
                 {
                     var current_indicator = round_values[cntr]
                     console.log(current_indicator.round_values);
                     google.charts.setOnLoadCallback(function(){
                         getIndicatorData(round.study.scenario,current_indicator.indicator.filename,1,function(data){
                             var parsed = parseChartData(data)
                             drawChart(parsed,'target-chart-'+current_indicator.indicator.filename,current_indicator.title,current_indicator.label)});

                     });
                 })(index);
             }

         }

         else(!isFirst)
         {
             for( index = 0, target_indicators_length = user_answers.length; index < target_indicators_length; index++)
             {
                 (function(cntr)
                 {
                     var current_indicator = user_answers[cntr]
                     var current_round_indicator = round_values[cntr]

                     console.log('round_values')
                     console.log(current_round_indicator.round_values)
                     console.log('user_values')
                     console.log(current_indicator.user_values)
                     var user_data = current_indicator.user_values.map(function(obj){
                         delete obj.round_question_indicator_year_id
                         delete obj.user_id
                         return obj
                     });

                     console.log('round_values')
                     console.log(current_round_indicator.round_values)
                     console.log('user_values')
                     console.log(current_indicator.user_values)

                     var round_data = current_round_indicator.round_values.map(function(obj){
                         delete obj.round_question_indicator_year_id
                         return obj
                     });
                     google.charts.setOnLoadCallback(function(){
                         smooth(round.study.scenario,current_indicator.indicator.filename,1,round_data,function(data){
                             var parsed = parseChartData(mergeData(data,user_data,'Resposta dada'))
                             drawChart(parsed,'target-chart-'+current_indicator.indicator.filename,current_indicator.title,current_indicator.label)});

                     });
                 })(index);
             }
         }

        // submit function
        $('#btn-submit').click(function(event)
        {
            event.preventDefault();
            validate(objectifyForm($('#form-round').serializeArray()));
        });


    });
</script>



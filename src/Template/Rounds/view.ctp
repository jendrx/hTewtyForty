<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/24/17
 * Time: 11:05 AM
 */?>
<!-- load google charts-->
<?php  echo $this->Html->script('https://www.gstatic.com/charts/loader.js'); ?>
<div id="div-round-view-content" class="row">
    <div class="large-12 columns round-content">

        <?php foreach( $questions as $question):

            echo '<div class="row">';
                echo '<div class="large-12 columns">';

                /* informative charts div begin*/
                echo '<div class="row chartdiv">';

                echo '<div class="panel"><h3>Take into consideration the scenario.</h3></div>';

                foreach($question['questions_indicators'] as $question_indicator):
                    if(!$question_indicator->target):
                        // row by indicator
                        echo '<div class="large-6 columns">';
                            echo '<h4>'.$question_indicator->title.'</h4>';
                            echo '<div id="chart-'.$question_indicator->indicator->filename.'"></div>';
                        echo '</div>';
                    endif;
                 endforeach;

                // end target column
                // end question_indicators row

                echo '</div>';
                echo '<br>';
                echo '<br>';


                echo '<br>';
                echo '<br>';

                echo '<div class="panel"><h3>'.$question->description.'</h3></div>';

                /* target and non ratio charts begin*/

                echo $this->Form->create(null,[ 'url' => ['controller' => 'answers', 'action' => 'add'],'id' => 'form-round']);
                echo '<div class="row chartdiv">';
                $index = 0;
                foreach($question['questions_indicators'] as $question_indicator):
                    if($question_indicator->target && !$question_indicator->ratio):
                        // row by indicator
                        echo '<div class="large-6 columns">';
                            echo '<h4>'.$question_indicator->title.'</h4>';
                            echo '<div id="chart-'.$question_indicator->indicator->filename.'"></div>';

                          foreach( $question_indicator['questions_indicators_years'] as $question_indicator_year):
                                //create answer id input
                                foreach ($question_indicator_year['rounds'] as $round_question_indicator_year):
                                    echo $this->Form->control($index.'.id',['type' => 'hidden']);
                                    echo $this->Form->control($index.'.round_question_indicator_year_id',['type' => 'hidden','value' => $round_question_indicator_year['_joinData']['id']]);
                                    echo '<div class="large-4 columns" >';
                                    echo '<div class="small-5 columns">';
                                    echo '<label for="right-label" class="right">'.h($question_indicator_year['year']['description']).'</label>';
                                    echo '</div>';
                                    echo '<div class="small-7 columns">';
                                    echo $this->Form->control($index.'.value', ['value' => $round_question_indicator_year['_joinData']['value'], 'label' => false]);
                                    echo '</div>';
                                    echo '</div>';
                                    $index = $index + 1;
                                endforeach;
                            endforeach;
                        echo '</div>';
                    endif;
                 endforeach;

                echo '</div>';
                echo '<br>';
                echo '<br>';
                /*target and  ratio chart begin */
                echo '<div class="row  ">';

               foreach($question['questions_indicators'] as $question_indicator):
                    if($question_indicator->target && $question_indicator->ratio):
                        // row by indicator
                        echo '<h4>'.$question_indicator->title.'</h4>';
                        echo '<div class="large-6  large-centered columns content" >';

                            echo '<div id="chart-'.$question_indicator->indicator->filename.'"></div>';

                          foreach( $question_indicator['questions_indicators_years'] as $question_indicator_year):

                                //create answer id input
                                foreach ($question_indicator_year['rounds'] as $round_question_indicator_year):
                                    echo $this->Form->control($index.'.id',['type' => 'hidden']);
                                    echo $this->Form->control($index.'.round_question_indicator_year_id',['type' => 'hidden','value' => $round_question_indicator_year['_joinData']['id']]);
                                    echo '<div class="large-4 columns">';
                                    echo '<div class="small-5 columns">';
                                    echo '<label for="right-label" class="right">'.h($question_indicator_year['year']['description']).'</label>';
                                    echo '</div>';
                                    echo '<div class="small-7 columns">';
                                    echo $this->Form->control($index.'.value', ['value' => $round_question_indicator_year['_joinData']['value'], 'label' => false]);
                                    echo '</div>';
                                    echo '</div>';
                                    $index = $index + 1;
                                endforeach;
                            endforeach;
                        echo '</div>';
                    endif;
                 endforeach;

                echo '</div>';


                echo $this->Form->Button(__('Submit'),['class' => ['button tiny right'],'id' => 'btn-submit']);
                echo $this->Form->end();

                echo '</div>';
            echo '</div>';
            endforeach;?>

    </div>
</div>


<script>
    google.charts.load('current', {'packages':['corechart']});

    // functions related with chart data
    function parseChartData(data) {
        var keys = Object.keys(data[0]);
        var cols = [];
        var rows = [];
        for (keyIndex = 0, keysLength = keys.length; keyIndex < keysLength; keyIndex ++)
        {
            if(keyIndex > 1)
                cols.push({label : keys[keyIndex], type : 'number', role:'interval'});
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

    function getIndicatorData(scenario,indicator) {
        $.ajax({
            type: "GET",
            url: '/hTwentyForty/charts/getIndicatorData',
            dataType: 'json',
            data: {
                'scenario' : scenario,
                'indicator' : indicator.filename},
            success: function (data)
            {
                console.log(data.response);
                var chartData = parseChartData(data.response);
                drawChart(chartData,'chart-'+indicator.filename,indicator.description);
            }
        });

    }

    function drawChart(chart_data,chart_div, chart1_main_title, chart1_vaxis_title) {
        var chart1_data = new google.visualization.DataTable(chart_data);


        var chart1_options = {
            height:300,
            title: chart1_main_title,
            curveType:'function',
            series: [{'color': '#0a0'}],
            intervals: { 'style':'area' },
            vAxis: {title: chart1_vaxis_title},
            hAxis: { format:''}
        };

        var chart1_chart = new google.visualization.LineChart(document.getElementById(chart_div));
        chart1_chart.draw(chart1_data, chart1_options);
    }



    // functions related with user input
    function objectifyForm(formArray)
    {
        var objectified = {};

        for(i = 0,length = formArray.length; i < length; i++)
        {
            objectified[formArray[i]['name']] = formArray[i]['value'];
        }
        return objectified;
    }

    function validate(data)
    {
        $.ajax({
            type: 'POST',
            url: '/hTwentyForty/answers/validate',
            dataType: 'json',
            data: data,
            success: function (data)
            {
                if(!data.response)
                {
                    $('#div-round-view-content').prepend('<div class="error message", onclick="this.classList.add(\'hidden\')"> Values inserted does not match</div>')
                    $("#div-round-view-content").scrollTop($("#div-round-view-content")[0].scrollHeight);
                }else
                {
                    $('#form-round').submit();
                }
            }
        });
    }


    $(document).ready(function()
    {
        var round = <?php echo json_encode($round); ?>;
        var questions = <?php echo json_encode($questions);?>;



        for(i = 0,  questionsLength = questions.length; i < questionsLength; i++ ) {
            var question = questions[i];

            // loop through questions' indicators
            for(j = 0, indicatorsLength = question.questions_indicators.length ; j < indicatorsLength; j++)
            {

                (function(cntr)
                {
                    google.charts.setOnLoadCallback(function(){
                        getIndicatorData(round.study.scenario,question.questions_indicators[cntr].indicator);
                    });


                })(j);
            }
        }

       // submit function
       $('#btn-submit').click(function(event)
       {
           event.preventDefault();
           validate(objectifyForm($('#form-round').serializeArray()));

       });
    });
// get loaded charts
</script>

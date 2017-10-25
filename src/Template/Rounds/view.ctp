<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/24/17
 * Time: 11:05 AM
 */?>

<div class="row">
    <div class="large-12 columns ">

        <?php foreach( $questions as $question):

            echo '<div class="row content">';
                echo '<h3>'.$question->description.'</h3>';
                echo '<div class="large-12 columns">';
                echo '<div class="row">';
                echo '<div class="large-6 columns">';

                echo $this->Form->create(null,['url' => ['controller' => 'answers', 'action' => 'add']]);

                $index = 0;
                    foreach($question['questions_indicators'] as $question_indicator):

                        if($question_indicator->target):
                            // row by indicator

                            echo '<div class="row">';
                            echo '<h4>'.$question_indicator->indicator->description.'</h4>';
                            echo '<div class="row">';

                            foreach( $question_indicator['questions_indicators_years'] as $question_indicator_year):

                                //create answer id input
                                /*echo $this->Form->control('id');
                                echo $this->Form->control('round_question_indicator_year_id')*/

                                foreach ($question_indicator_year['rounds'] as $round_question_indicator_year):
                                    echo $this->Form->control($index.'.id',['type' => 'hidden']);
                                    echo $this->Form->control($index.'.round_question_indicator_year_id',['type' => 'hidden','value' => $round_question_indicator_year['_joinData']['id']]);
                                    echo '<div class="large-4 columns">';
                                    echo '<div class="small-3 columns">';
                                    echo '<label for="right-label" class="right">'.$question_indicator_year['year']['description'].'</label>';
                                    echo '</div>';
                                    echo '<div class="small-9 columns">';
                                    echo $this->Form->control($index.'.value', ['value' => $round_question_indicator_year['_joinData']['value'], 'label' => false]);
                                    echo '</div>';
                                    echo '</div>';
                                    $index = $index + 1;
                                endforeach;
                            endforeach;
                            echo '</div>';
                            echo '<div id="chart-target-'.$question_indicator->indicator->description.'"></div>';
                            echo '</div>';
                        endif;
                    endforeach;
                // end target column
                echo '</div>';

                 echo '<div class="large-6 columns">';
                    foreach($question['questions_indicators'] as $question_indicator):

                        if(!$question_indicator->target):
                            // row by indicator

                            echo '<div class="row">';
                            echo '<h4>'.$question_indicator->indicator->description.'</h4>';
                            echo '<div id="chart-target-'.$question_indicator->indicator->description.'"></div>';
                            echo '</div>';
                        endif;

                    endforeach;

                // end target column
                echo '</div>';

                // end question_indicators row
                echo '</div>';


                echo $this->Form->Button(__('Submit'),['class' => ['button tiny right']]);
                echo $this->Form->end();

                echo '</div>';
            echo '</div>';
            endforeach;?>

    </div>
</div>


<script>
// get loaded charts
</script>

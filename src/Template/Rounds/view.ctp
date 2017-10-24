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

                echo $this->Form->create();

                    foreach($question['questions_indicators'] as $question_indicator):

                        if($question_indicator->target):
                            // row by indicator
                            echo '<div class="row">';
                            echo '<h4>'.$question_indicator->indicator->description.'</h4>';
                            echo '<div class="row">';

                            foreach( $question_indicator['questions_indicators_years'] as $question_indicator_year):
                                echo '<div class="large-4 columns">';
                                echo '<div class="small-3 columns">';
                                echo '<label for="right-label" class="right">Label</label>';
                                echo '</div>';
                                echo '<div class="small-9 columns">';
                                echo '<input type="text" id="right-label" placeholder="Inline Text Input">';
                                echo '</div>';
                                echo '</div>';
                            endforeach;


                            echo '</div>';

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

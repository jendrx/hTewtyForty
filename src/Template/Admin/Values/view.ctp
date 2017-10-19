<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Value $value
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Value'), ['action' => 'edit', $value->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Value'), ['action' => 'delete', $value->id], ['confirm' => __('Are you sure you want to delete # {0}?', $value->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Values'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Value'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Answers'), ['controller' => 'Answers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Previews'), ['controller' => 'Previews', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Preview'), ['controller' => 'Previews', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rounds Questions Indicators'), ['controller' => 'RoundsQuestionsIndicators', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rounds Questions Indicator'), ['controller' => 'RoundsQuestionsIndicators', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="values view large-9 medium-8 columns content">
    <h3><?= h($value->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($value->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($value->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($value->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Answers') ?></h4>
        <?php if (!empty($value->answers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Round Question Indicator Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($value->answers as $answers): ?>
            <tr>
                <td><?= h($answers->id) ?></td>
                <td><?= h($answers->created) ?></td>
                <td><?= h($answers->round_question_indicator_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Answers', 'action' => 'view', $answers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Answers', 'action' => 'edit', $answers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Answers', 'action' => 'delete', $answers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Previews') ?></h4>
        <?php if (!empty($value->previews)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Round Question Indicator Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($value->previews as $previews): ?>
            <tr>
                <td><?= h($previews->id) ?></td>
                <td><?= h($previews->created) ?></td>
                <td><?= h($previews->round_question_indicator_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Previews', 'action' => 'view', $previews->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Previews', 'action' => 'edit', $previews->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Previews', 'action' => 'delete', $previews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $previews->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Rounds Questions Indicators') ?></h4>
        <?php if (!empty($value->rounds_questions_indicators)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Round Id') ?></th>
                <th scope="col"><?= __('Question Indicator Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($value->rounds_questions_indicators as $roundsQuestionsIndicators): ?>
            <tr>
                <td><?= h($roundsQuestionsIndicators->id) ?></td>
                <td><?= h($roundsQuestionsIndicators->round_id) ?></td>
                <td><?= h($roundsQuestionsIndicators->question_indicator_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RoundsQuestionsIndicators', 'action' => 'view', $roundsQuestionsIndicators->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RoundsQuestionsIndicators', 'action' => 'edit', $roundsQuestionsIndicators->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RoundsQuestionsIndicators', 'action' => 'delete', $roundsQuestionsIndicators->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roundsQuestionsIndicators->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

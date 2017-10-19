<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Study $study
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Study'), ['action' => 'edit', $study->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Study'), ['action' => 'delete', $study->id], ['confirm' => __('Are you sure you want to delete # {0}?', $study->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Studies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Study'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rounds'), ['controller' => 'Rounds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Round'), ['controller' => 'Rounds', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studies view large-9 medium-8 columns content">
    <h3><?= h($study->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($study->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($study->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Completed') ?></th>
            <td><?= h($study->completed) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($study->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Rounds') ?></h4>
        <?php if (!empty($study->rounds)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Step') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Completed') ?></th>
                <th scope="col"><?= __('Study Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($study->rounds as $rounds): ?>
            <tr>
                <td><?= h($rounds->id) ?></td>
                <td><?= h($rounds->step) ?></td>
                <td><?= h($rounds->created) ?></td>
                <td><?= h($rounds->completed) ?></td>
                <td><?= h($rounds->study_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Rounds', 'action' => 'view', $rounds->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Rounds', 'action' => 'edit', $rounds->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rounds', 'action' => 'delete', $rounds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rounds->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($study->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Role') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($study->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->role) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

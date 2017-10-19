<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Studies'), ['controller' => 'Studies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Study'), ['controller' => 'Studies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Username') ?></h4>
        <?= $this->Text->autoParagraph(h($user->username)); ?>
    </div>
    <div class="row">
        <h4><?= __('Password') ?></h4>
        <?= $this->Text->autoParagraph(h($user->password)); ?>
    </div>
    <div class="row">
        <h4><?= __('Role') ?></h4>
        <?= $this->Text->autoParagraph(h($user->role)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Studies') ?></h4>
        <?php if (!empty($user->studies)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Completed') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->studies as $studies): ?>
            <tr>
                <td><?= h($studies->id) ?></td>
                <td><?= h($studies->description) ?></td>
                <td><?= h($studies->created) ?></td>
                <td><?= h($studies->completed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Studies', 'action' => 'view', $studies->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Studies', 'action' => 'edit', $studies->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Studies', 'action' => 'delete', $studies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studies->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

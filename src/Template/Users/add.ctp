<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/19/17
 * Time: 2:16 PM
 */?>

<div class="form large-4 medium-2 large-offset-4 medium-offset-5 columns " style="margin: 0 auto">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Register') ?></legend>
        <div class="">
            <?php
            echo $this->Form->control('username', ['type' => 'text']);
            echo $this->Form->control('password');
            ?>
        </div>
        <?= $this->Form->button(__('Submit'),['class' => 'button small']) ?>
        <?= $this->Form->end() ?>
    </fieldset>
</div>


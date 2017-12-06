<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/19/17
 * Time: 2:16 PM
 */?>

<div class="form large-4 medium-2 large-offset-4 medium-offset-5 columns " style="margin: 0 auto">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Iniciar Sessão') ?></legend>
        <div class="row">
            <?php
            echo $this->Form->control('username', ['type' => 'text', 'label' => 'Utilizador']);
            echo $this->Form->control('password',['label' => 'Palavra-passe']);
            ?>
        </div>
        <?= $this->Form->button(__('Login'),['class' => 'button small']) ?>
        <?= $this->Form->end() ?>
    </fieldset>
</div>




<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerUser $user
 */
?>
<div class="users form large-offset-3 large-4  medium-offset-3 medium-4 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Login') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password_crypt',['label' => 'Password', 'type' => 'password']) ?>
        <?= $this->Form->button(__('Login'), ['class'=>'button expanded']) ?>
    </fieldset>
    
    <?= $this->Form->end() ?>
</div>

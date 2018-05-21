<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerUser $user
 */
?>
<div class="users form large-offset-3 large-4  medium-offset-3 medium-4 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Change Password') ?></legend>
        <?php
            echo $this->Form->control('password_crypt', ['label' => 'Password', 'type' => 'password']);
        ?>
        <?= $this->Form->button(__('Submit'), ['class'=>'button expanded']) ?>
    </fieldset>
    
    <?= $this->Form->end() ?>
</div>

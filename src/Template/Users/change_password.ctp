<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerUser $user
 */
?>
<div class="content">
<div class="row">
    <div class="users form large-offset-3 large-6 medium-offset-2  medium-8 columns">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= __('Change Password') ?></legend>
            <?php
                echo $this->Form->control('password_crypt', ['label' => 'Password', 'type' => 'password']);
            ?>
            <?= $this->Form->button(__('Submit'), ['class'=>'button round expand']) ?>
        </fieldset>
        
        <?= $this->Form->end() ?>
    </div>
</div>
</div>

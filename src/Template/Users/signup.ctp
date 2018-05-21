<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerUser $user
 */
?>
<div class="users form large-offset-3 large-6 medium-offset-3  medium-6 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Sign up') ?></legend>
        <?php
            echo $this->Form->control('full_name');
            echo $this->Form->control('email');
            echo $this->Form->control('password_crypt', ['label' => 'Password', 'type' => 'password']);
        ?>
        <?= $this->Form->button(__('Submit'), ['class'=>'button expanded']) ?>
    </fieldset>
    
    <?= $this->Form->end() ?>
</div>

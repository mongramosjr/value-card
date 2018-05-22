<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerUser $user
 */
?>
<div class="content">
<div class="row">
    <div class="users form large-offset-3 large-6 medium-offset-3  medium-6 columns">
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
<div class="row">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('Me'), ['controller' => 'Users', 'action' => 'view', $user->id]) ?></li>
            <li><?= $this->Html->link(__('My Wallets'), ['controller' => 'Wallets', 'action' => 'index', $user->id]) ?></li>
        </ul>
    </nav>
</div>
</div>

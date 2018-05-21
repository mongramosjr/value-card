<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerUser $user
 */
?>
<div class="users form large-offset-3 large-6  medium-offset-3 medium-6 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Login') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password_crypt',['label' => 'Password', 'type' => 'password']) ?>
       
        
        <?php echo $this->Html->link(__('Sign up'), [
                'controller' => 'Users', 'action' => 'signup'
            ], ['class'=>'button secondary expanded']);
            ?>
        <?= $this->Form->button(__('Login'), ['class'=>'button expanded']) ?>
    </fieldset>
   
    
    <?= $this->Form->end() ?>
</div>

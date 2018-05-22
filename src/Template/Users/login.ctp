<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerUser $user
 */
?>
<div class="content">
<div class="row">
    <div class="users form large-offset-3 large-6  medium-offset-3 medium-6 columns">
        <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('Login') ?></legend>
            <?= $this->Form->control('email') ?>
            <?= $this->Form->control('password_crypt',['label' => 'Password', 'type' => 'password']) ?>
           
            
            
            <?= $this->Form->button(__('Login'), ['class'=>'button round expand']) ?>
            
            <div class="clearfix">    
            <?php echo $this->Html->link(__('Forgot password?'), [
                        'controller' => 'Users', 'action' => 'forgotPassword'
                    ], ['class'=>'left']);
                    ?>
              
            <?php echo $this->Html->link(__('Create an account'), [
                        'controller' => 'Users', 'action' => 'signup'
                    ], ['class'=>'right']);
                    ?>

            </div>
        </fieldset>
        
        <?= $this->Form->end() ?>
        
        
    </div>
</div>
</div>

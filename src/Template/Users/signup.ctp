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
            <legend><?= __('Create your account') ?></legend>
            <?php
                echo $this->Form->control('full_name');
                echo $this->Form->control('email', []);
                echo $this->Form->control('password_crypt', ['label' => 'Password', 'type' => 'password', 'placeholder' => 'Atleast 6 characters']);
                echo $this->Form->control('password2', ['label' => ' Re-enter password', 'type' => 'password', 'placeholder' => '', 'required'=>'true']);
            ?>
            <div style="font-size:0.80rem;display:inline-block; margin: 0 0 1rem 0;">
            <?php //echo $this->Form->checkbox('agree', ['id'=>'agree_valuecard']); ?>
            <span for="agree_valuecard" >By creating an account, I agree to ValueCard's  Condition of Use and Privacy Policy. </span>
            </div>
            
            <?= $this->Form->button(__('Create Account'), ['class'=>'button round expand']) ?>
            
            <div class="clearfix">    
                <?php echo $this->Html->link(__('Already have an account? Go and login'), [
                    'controller' => 'Users', 'action' => 'login'
                ], ['class'=>'right']);
                ?>
            </div>
            
        </fieldset>
        
        <?= $this->Form->end() ?>
    </div>
</div>
</div>

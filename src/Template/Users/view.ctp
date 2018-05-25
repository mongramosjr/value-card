<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerUser $user
 */
?>
<div class="content">
<h2>My Account</h2>
<div class="row">
    <div class="users view large-6 medium-6 columns">
        <p>Earn points for every purchase made at participating partners.</p>
         <div class="row">
            <div class="large-8 medium-12 columns">
        <ul class="button-group round  even-2">
        <li>
            <?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?>
        </li>
        <li>
            <?= $this->Html->link(__('Request'), ['controller' => 'PaymentTransactions', 'action' => 'receive', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?> 
        </li>
        </ul>
        </div>
        </div>
    </div>
    <div class="users view large-6 medium-6 columns">
        <div class="text-right">
        <h5>Available Balance</h5>
        <p>0.00</p>
        </div>
    </div>
</div>    
    
    <hr/>
    
<div class="row">
    <div class="users view large-6 medium-6 columns">
        <h3>Account ID</h3>
        
        <p>Account ID is your unique identifier. It is what you will use to log in and access your wallets. It is not a wallet address for sending or receiving. Do not share your Account ID with others.
        </p>
    </div>
    <div class="users view large-6 medium-6 columns">
        <h3><?= h($user->id) ?></h3>
        
    </div>
</div>

<hr/>

<h2>User Profile</h2>
<div class="row">
    <div class="users view large-6 medium-6 columns">
        <div class="row">
            <div class="medium-2 columns">
            <img class="th radius" src="https://placehold.it/64x64">
            </div>
        <div class="medium-4 columns">
            
        <h5>Change Picture</h5>

        <p>Max file size is 20Mb. </p>
        </div>
        <div class="medium-6 columns">
        <?= $this->Html->link(__('Upload'), ['action' => 'changePicture', $user->id], ['class' => 'button round secondary']) ?> 
        </div>
        </div>
    </div>
    <div class="users view large-6 medium-6 columns clearfix">
         
        
        <div class="row">
        <div class="medium-6 columns">
        <h5>Change Password</h5>
        <p>Your password is never shared with our servers, which means we cannot help reset your password if you forget it</p>
        </div>
        <div class="medium-6 columns">
        <?= $this->Html->link(__('Change Password'), ['action' => 'changePassword', $user->id], ['class' => 'button round secondary', 'confirm' => __('Are you sure you want to change password?')]) ?> 
        </div>
        </div>
    </div>
</div>

<hr/>

<div class="row">
    <div class="users view large-12 medium-12 columns">
        <?= $this->Form->create($user) ?>
        
        <div class="row">
        <div class="medium-6 large-3 columns">
          <label for="right-label" class="inline">Nickname<br/><small>This name will be part of your public profile.

</small></label>
          
        </div>
        <div class="medium-6 large-9 columns">
            <?php
                echo $this->Form->control('full_name', ['label'=>false]);
                ?>
                </div>
            </div>
            <div class="row">
        <div class="medium-6 large-3 columns">
          <label for="right-label" class="inline">Email</label>
          
        </div>
        <div class="medium-6 large-9 columns">
            <?php
                echo $this->Form->control('email', ['label'=>false]);
                ?>
                </div>
            </div>
            
            <div class="row">
                <div class="medium-offset-6 medium-6 large-offset-3 large-9 columns">            
            <?= $this->Form->button(__('Update'), ['class'=>'button round']) ?>
                </div>
            </div>
            
            
        
        <?= $this->Form->end() ?>
    </div>
</div>

</div>

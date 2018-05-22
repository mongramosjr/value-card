<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoWallet $cryptoWallet
 */
?>
<div class="content">
<div class="row">
    <div class="cryptoWallets form large-offset-3 large-6 medium-offset-3  medium-6  columns">
        <?= $this->Form->create($wallet) ?>
        <fieldset>
            <legend><?= __('Add Wallet') ?></legend>
            <?php
                echo $this->Form->control('customer_user_id', ['value' => $customer_user_id, 'type' => 'hidden']);
                echo $this->Form->control('crypto_currency_id', ['options' => $cryptoCurrencies, 'empty' => true]);
                echo $this->Form->control('password_crypt', ['label' => 'Password']);
            ?>
            
            <?= $this->Form->button(__('Submit'), ['class' => 'round button expand']) ?>
            
        </fieldset>
        
        <?= $this->Form->end() ?>
    </div>
</div>
<div class="row">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('Me'), ['controller' => 'Users', 'action' => 'view', $customer_user_id]) ?></li>
            <li><?= $this->Html->link(__('My Wallets'), ['controller' => 'Wallets', 'action' => 'index', $customer_user_id]) ?></li>
            <li><?= $this->Html->link(__('New Wallet'), ['controller' => 'Wallets', 'action' => 'create', $customer_user_id]) ?> </li>
            <li><?= $this->Html->link(__('Crypto Currencies'), ['controller' => 'CryptoCurrencyRates', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Transactions'), ['controller' => 'PaymentTransactions', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send']) ?> </li>
            <li><?= $this->Html->link(__('Receive'), ['controller' => 'PaymentTransactions', 'action' => 'receive']) ?> </li>
        </ul>
    </nav>
</div>
</div>

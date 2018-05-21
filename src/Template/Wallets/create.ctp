<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoWallet $cryptoWallet
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Me'), ['controller' => 'Users', 'action' => 'view']) ?></li>
        <li><?= $this->Html->link(__('My Wallets'), ['controller' => 'Wallets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wallet'), ['controller' => 'Wallets', 'action' => 'create']) ?> </li>
        <li><?= $this->Html->link(__('Cryto Currencies'), ['controller' => 'CryptoCurrencyRates', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cryptoWallets form large-9 medium-8 columns content">
    <?= $this->Form->create($wallet) ?>
    <fieldset>
        <legend><?= __('Add Wallet') ?></legend>
        <?php
            echo $this->Form->control('customer_user_id', ['value' => $customer_user_id, 'type' => 'hidden']);
            echo $this->Form->control('crypto_currency_id', ['options' => $cryptoCurrencies, 'empty' => true]);
            echo $this->Form->control('password_crypt', ['label' => 'Password']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

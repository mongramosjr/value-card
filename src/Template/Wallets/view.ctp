<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoWallet $cryptoWallet
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Me'), ['controller' => 'Users', 'action' => 'view', $customer_user_id]) ?></li>
        <li><?= $this->Html->link(__('My Wallets'), ['controller' => 'Wallets', 'action' => 'index', $customer_user_id]) ?></li>
        <li><?= $this->Html->link(__('New Wallet'), ['controller' => 'Wallets', 'action' => 'create', $customer_user_id]) ?> </li>
        <li><?= $this->Html->link(__('Cryto Currencies'), ['controller' => 'CryptoCurrencyRates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Transactions'), ['controller' => 'PaymentTransactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send']) ?> </li>
        <li><?= $this->Html->link(__('Receive'), ['controller' => 'PaymentTransactions', 'action' => 'receive']) ?> </li>
    </ul>
</nav>
<div class="cryptoWallets view large-9 medium-8 columns content">
    <h3><?= h($cryptoWallet->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer User') ?></th>
            <td><?= $cryptoWallet->has('customer_user') ? $this->Html->link($cryptoWallet->customer_user->id, ['controller' => 'CustomerUsers', 'action' => 'view', $cryptoWallet->customer_user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Wallet Address') ?></th>
            <td><?= h($cryptoWallet->wallet_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Crypto Currency') ?></th>
            <td><?= $cryptoWallet->has('crypto_currency') ? $this->Html->link($cryptoWallet->crypto_currency->name, ['controller' => 'CryptoCurrencies', 'action' => 'view', $cryptoWallet->crypto_currency->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Crypto Currency Name') ?></th>
            <td><?= h($cryptoWallet->crypto_currency_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password Crypt') ?></th>
            <td><?= h($cryptoWallet->password_crypt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cryptoWallet->id) ?></td>
        </tr>
    </table>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoWallet[]|\Cake\Collection\CollectionInterface $cryptoWallets
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
<div class="cryptoWallets index large-9 medium-8 columns content">
    <h3><?= __('Wallets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('wallet_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('crypto_currency_name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wallets as $cryptoWallet): ?>
            <tr>
                <td><?= $this->Number->format($cryptoWallet->id) ?></td>
                <td><?= h($cryptoWallet->wallet_address) ?></td>
                <td><?= $cryptoWallet->has('crypto_currency') ? $this->Html->link($cryptoWallet->crypto_currency->name, ['controller' => 'CryptoCurrencies', 'action' => 'view', $cryptoWallet->crypto_currency->id]) : '' ?></td>
                <td><?= h($cryptoWallet->crypto_currency_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cryptoWallet->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

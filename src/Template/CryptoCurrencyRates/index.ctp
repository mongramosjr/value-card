<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoCurrencyRate[]|\Cake\Collection\CollectionInterface $cryptoCurrencyRates
 */
?>
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
<div class="cryptoCurrencyRates index large-9 medium-8 columns content">
    <h3><?= __('Crypto Currency Rates') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('crypto_currency_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('crypto_currency_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('symbol') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('market_capitalization') ?></th>
                <th scope="col"><?= $this->Paginator->sort('circulating_supply') ?></th>
                <th scope="col"><?= $this->Paginator->sort('volume') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cryptoCurrencyRates as $cryptoCurrencyRate): ?>
            <tr>
                <td><?= $this->Number->format($cryptoCurrencyRate->id) ?></td>
                <td><?= $cryptoCurrencyRate->has('crypto_currency') ? $this->Html->link($cryptoCurrencyRate->crypto_currency->name, ['controller' => 'CryptoCurrencies', 'action' => 'view', $cryptoCurrencyRate->crypto_currency->id]) : '' ?></td>
                <td><?= h($cryptoCurrencyRate->crypto_currency_name) ?></td>
                <td><?= h($cryptoCurrencyRate->symbol) ?></td>
                <td><?= $this->Number->format($cryptoCurrencyRate->price) ?></td>
                <td><?= $this->Number->format($cryptoCurrencyRate->market_capitalization) ?></td>
                <td><?= $this->Number->format($cryptoCurrencyRate->circulating_supply) ?></td>
                <td><?= $this->Number->format($cryptoCurrencyRate->volume) ?></td>
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

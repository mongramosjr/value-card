<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoTransaction $cryptoTransaction
 */
?>
<div class="content">
<div class="row">
    <div class="cryptoTransactions view large-9 medium-8 columns">
        <h3><?= h($cryptoTransaction->id) ?></h3>
        <table class="vertical-table">
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= h($cryptoTransaction->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Customer User') ?></th>
                <td><?= $cryptoTransaction->has('customer_user') ? $this->Html->link($cryptoTransaction->customer_user->id, ['controller' => 'CustomerUsers', 'action' => 'view', $cryptoTransaction->customer_user->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Source Wallet Address') ?></th>
                <td><?= h($cryptoTransaction->source_wallet_address) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Target Wallet Address') ?></th>
                <td><?= h($cryptoTransaction->target_wallet_address) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Acquirer Reference') ?></th>
                <td><?= h($cryptoTransaction->acquirer_reference) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Currency') ?></th>
                <td><?= $cryptoTransaction->has('currency') ? $this->Html->link($cryptoTransaction->currency->name, ['controller' => 'Currencies', 'action' => 'view', $cryptoTransaction->currency->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Currency Name') ?></th>
                <td><?= h($cryptoTransaction->currency_name) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Transaction Hash') ?></th>
                <td><?= h($cryptoTransaction->transaction_hash) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Transaction Type') ?></th>
                <td><?= h($cryptoTransaction->transaction_type) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Crypto Currency') ?></th>
                <td><?= $cryptoTransaction->has('crypto_currency') ? $this->Html->link($cryptoTransaction->crypto_currency->name, ['controller' => 'CryptoCurrencies', 'action' => 'view', $cryptoTransaction->crypto_currency->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Crypto Currency Name') ?></th>
                <td><?= h($cryptoTransaction->crypto_currency_name) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('State') ?></th>
                <td><?= h($cryptoTransaction->state) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Amount') ?></th>
                <td><?= $this->Number->format($cryptoTransaction->amount) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Fees') ?></th>
                <td><?= $this->Number->format($cryptoTransaction->fees) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Currency Amount') ?></th>
                <td><?= $this->Number->format($cryptoTransaction->currency_amount) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created By') ?></th>
                <td><?= $this->Number->format($cryptoTransaction->created_by) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified By') ?></th>
                <td><?= $this->Number->format($cryptoTransaction->modified_by) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Date Completed') ?></th>
                <td><?= h($cryptoTransaction->date_completed) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($cryptoTransaction->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($cryptoTransaction->modified) ?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li><?= $this->Html->link(__('Edit Crypto Transaction'), ['action' => 'edit', $cryptoTransaction->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Crypto Transaction'), ['action' => 'delete', $cryptoTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cryptoTransaction->id)]) ?> </li>
        </ul>
    </nav>
</div>
</div>

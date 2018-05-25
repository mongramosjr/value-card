<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoCurrencyRate[]|\Cake\Collection\CollectionInterface $cryptoCurrencyRates
 */
?>
<div class="content">
<div class="row">
    <div class="cryptoCurrencyRates index large-12 medium-12 columns">
        <h2><?= __('Crypto Currency Rates') ?></h2>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('crypto_currency_name', ['label' => 'Cryptocurrency']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('market_capitalization') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('circulating_supply') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('volume') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cryptoCurrencyRates as $cryptoCurrencyRate): ?>
                <tr>
                    <td><?= $cryptoCurrencyRate->has('crypto_currency') ? $this->Html->link($cryptoCurrencyRate->crypto_currency->name, ['controller' => 'CryptoCurrencies', 'action' => 'view', $cryptoCurrencyRate->crypto_currency->id]) : '' ?></td>
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
</div>

</div>

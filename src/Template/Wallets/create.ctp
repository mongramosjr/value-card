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
                echo $this->Form->control('wallet_label', ['label'=>'Label']);
                echo $this->Form->control('crypto_currency_id', ['options' => $cryptoCurrencies, 'empty' => false]);
            ?>
            
            <?= $this->Form->button(__('Submit'), ['class' => 'round button expand']) ?>
            
        </fieldset>
        
        <?= $this->Form->end() ?>
    </div>
</div>

</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoTransaction $cryptoTransaction
 */
?>
<div class="content">
    <h2><?= __('Send') ?> <?= __($cryptoCurrency->currency_unit_label) ?> <?= __($cryptoCurrency->currency_unit_tag) ?></h2>
<div class="row">
    <div class="cryptoTransactions form large-6 medium-6 columns">
        <?= $this->Form->create($cryptoTransaction) ?>
            <div class="large-12 medium-12 columns">
            <?php echo $this->Form->control('target_wallet_address', ['required'=>true, 'placeholder' => 'Enter wallet address of destination']); ?>
            </div>
            
            <div class="large-8 medium-7 columns">
            <?php echo $this->Form->control('amount', ['label' => false, 'placeholder' => 'Amount in valuecard you want to receive']);  ?>
            </div>
            <div class="large-4 medium-5 columns">
            <?php echo $this->Form->control('crypto_currency_id', ['options' => $cryptoCurrencies, 'empty' => false, 'label' => false]); ?>
            </div>

            <?php if(!empty($wallet_id)):?>
            <div class="large-12 medium-12 columns">
            <?php echo $this->Form->control('source_wallet_address', ['required'=>true, 'readonly' => 'readonly', 'value' => $cryptoWallet->wallet_address]); ?>
            </div>

            <?php else: ?>

            <div class="large-12 medium-12 columns">
            <?php echo $this->Form->control('source_wallet_address', ['options' => $cryptoWallets, 'empty' => false, 'required'=>true]); ?>
            </div>

            <?php endif;?>

            <div class="large-12 medium-12 columns">
                <?= $this->Form->button(__('Send'), ['class' => 'round button expand']) ?>
            </div>
            
            <div class="large-12 medium-12 columns">
            <span class="label warning radius">Warning!</span>
            <small>Make sure that the wallet address you are sending funds to is compatible with <?php echo $cryptoCurrency->currency_unit_label; ?> wallet address before transferring, 
                otherwise you might lose your <?php echo $cryptoCurrency->currency_unit_label; ?> coins.</small>
            </div>
            
        <?= $this->Form->end() ?>
        
        
    </div>
    <div class="large-5 large-offset-1 medium-6 columns"  style="overflow-y: auto;overflow-x:hidden;">
        <div style="padding-bottom: 58px;">
            <?php $coin_sidebar = $this->cell('CryptoCoinSideBar'); ?>
            <?php echo $coin_sidebar; ?>
    </div>
</div>

</div>

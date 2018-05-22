<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoTransaction $cryptoTransaction
 */
?>
<div class="content">
<div class="row">
    <div class="cryptoTransactions form large-6 medium-6 columns content">
        <?= $this->Form->create($cryptoTransaction) ?>
            <div class="large-12 medium-12 columns">
            <?php echo $this->Form->control('target_wallet_address', ['placeholder' => 'Enter wallet address of destination']); ?>
            </div>
            
            <div class="large-8 medium-7 columns">
            <?php echo $this->Form->control('amount', ['label' => false, 'placeholder' => 'Amount in valuecard you want to receive']);  ?>
            </div>
            <div class="large-4 medium-5 columns">
            <?php echo $this->Form->control('crypto_currency_id', ['options' => $cryptoCurrencies, 'empty' => false, 'label' => false]); ?>
            </div>
            
            <div class="large-12 medium-12 columns">
            <?php echo $this->Form->control('source_wallet_address', ['readonly' => 'readonly']); ?>
            </div>

            <div class="large-12 medium-12 columns">
                <?= $this->Form->button(__('Send'), ['class' => 'round button expand']) ?>
            </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="large-5 large-offset-1 medium-6 columns content"  style="overflow-y: auto;overflow-x:hidden;">
        <div style="padding-bottom: 58px;">
        <div class="" style="">
            <div class="row" style="border: 1px solid #c0c0c0;padding-top: 1.25rem;">
              <div class="medium-4 large-4 columns">...</div>
              <div class="medium-8 large-8 columns" >
                  <h5><a href="#">ValueCard</a></h5>
                   
                    <span style="font-weight:600;margin-bottom:0.25rem;">Balance</span>
                    <div>
                        <span style="font-weight:500;font-size: 2rem;">0</span>
                    </div>
                    <p>
                    <span><i class="fi-calendar"> 11/23/16 &nbsp;&nbsp;</i></span>
                    <span><i class="fi-comments"> 6 comments</i></span>
                    </p>
                    <ul class="button-group round  even-2">
                      <li><a href="#" class="button secondary">Send</a></li>
                      <li><a href="#" class="button secondary">Receive</a></li>
                    </ul>
              </div>
            </div>
            <div class="row" style="border: 1px solid #c0c0c0;padding-top: 1.25rem;" >
              <div class="medium-4 large-4 columns">...</div>
              <div class="medium-8 large-8 columns" >
                  <h5><a href="#">ValueCard</a></h5>
                   
                    <span style="font-weight:600;margin-bottom:0.25rem;">Balance</span>
                    <div>
                        <span style="font-weight:500;font-size: 2rem;">0</span>
                    </div>
                    <p>
                    <span><i class="fi-calendar"> 11/23/16 &nbsp;&nbsp;</i></span>
                    <span><i class="fi-comments"> 6 comments</i></span>
                    </p>
                    <ul class="button-group round  even-2">
                      <li><a href="#" class="button secondary">Send</a></li>
                      <li><a href="#" class="button secondary">Receive</a></li>
                    </ul>
              </div>
            </div>
            
        </div>
        </div>
    </div>
</div>
<div class="row">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('My Wallets'), ['controller' => 'Wallets', 'action' => 'index', $customer_user_id]) ?></li>
            <li><?= $this->Html->link(__('New Wallet'), ['controller' => 'Wallets', 'action' => 'create', $customer_user_id]) ?> </li>
            <li><?= $this->Html->link(__('Crypto Currencies'), ['controller' => 'CryptoCurrencyRates', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Transactions'), ['controller' => 'PaymentTransactions', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send']) ?></li>
            <li><?= $this->Html->link(__('Receive'), ['controller' => 'PaymentTransactions', 'action' => 'receive']) ?></li>
            <li><?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $cryptoTransaction->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $cryptoTransaction->id)]
                )
            ?></li>
        </ul>
    </nav>
</div>
</div>

<div class="" style="">

<?php foreach($wallets as $wallet): ?>        
    <div class="row" style="border: 1px solid #c0c0c0;padding-top: 1.25rem;">
        <div class="medium-4 large-4 columns">...</div>
        <div class="medium-8 large-8 columns" >
            <h5><a href="#"><?php echo $wallet->crypto_currency->currency_unit_label;?></a></h5>

            <span style="font-weight:600;margin-bottom:0.25rem;">Balance</span>
            <div>
                <span style="font-weight:500;font-size: 2rem;">0</span>
            </div>
            <p>
                <span><i class="fi-calendar"> 11/23/16 &nbsp;&nbsp;</i></span>
                <span><i class="fi-comments"> 6 comments</i></span>
            </p>
            <ul class="button-group round  even-2">
                <li>
                <?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send', isset($wallet->crypto_currency_id) ? $wallet->crypto_currency_id : '', isset($wallet->id) ? $wallet->id : null], ['class' => 'button round secondary']) ?>
                </li>
                <li>
                <?= $this->Html->link(__('Request'), ['controller' => 'PaymentTransactions', 'action' => 'receive', isset($wallet->crypto_currency_id) ? $wallet->crypto_currency_id : '', isset($wallet->id) ? $wallet->id : null], ['class' => 'button round secondary']) ?>
                </li>
            </ul>
        </div>
    </div>
<?php endforeach; ?>

</div>

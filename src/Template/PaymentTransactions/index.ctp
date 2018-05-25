<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoTransaction[]|\Cake\Collection\CollectionInterface $cryptoTransactions
 */
?>
<div class="content">
    <h2><?= __('My Transactions') ?></h2>
    <div class="row">
        <div class="users view large-6 medium-6 columns">
            <p>Earn points for every purchase made at participating partners.</p>
             <div class="row">
                <div class="large-8 medium-12 columns">
                    
            <ul class="button-group round  even-2">
            <li>
                <?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?>
            </li>
            <li>
                <?= $this->Html->link(__('Request'), ['controller' => 'PaymentTransactions', 'action' => 'receive', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?> 
            </li>
            </ul>
            </div>
            </div>
        </div>
        <div class="users view large-6 medium-6 columns">
            <div class="text-right">
            <h5>Available Balance</h5>
            <p>0.00</p>
            </div>
        </div>
    </div>    
    
    <hr/>
<div class="row">
    <div class="cryptoTransactions index large-7 medium-6 columns">
        
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('target_wallet_address', ['label' => 'Target']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('transaction_type', ['label' => 'Type']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('state', ['label' => 'Status']) ?></th>
                    
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cryptoTransactions as $cryptoTransaction): ?>
                <tr>
                    <td><?= h($cryptoTransaction->target_wallet_address) ?></td>
                    <td>
                        <?= $this->Number->format($cryptoTransaction->amount) ?>
                        </br>
                        <?= $cryptoTransaction->has('crypto_currency') ? $this->Html->link($cryptoTransaction->crypto_currency->name, ['controller' => 'CryptoCurrencies', 'action' => 'view', $cryptoTransaction->crypto_currency->id]) : '' ?>
                    </td>
                    <td><?= h($cryptoTransaction->created) ?></td>
                    
                    <td><?= h($cryptoTransaction->transaction_type) ?></td>
                    <td><?= h($cryptoTransaction->state) ?></td>
                    
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $cryptoTransaction->id]) ?>
                        <?php if($cryptoTransaction->state=='draft'): ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cryptoTransaction->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cryptoTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cryptoTransaction->id)]) ?>
                        <?php endif;?>
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
    <div class="large-5 medium-6 columns"  style="overflow-y: auto;overflow-x:hidden;">
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
                      <li>
                        <?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(__('Request'), ['controller' => 'PaymentTransactions', 'action' => 'receive', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?> 
                    </li>
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
                    <li>
                        <?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(__('Request'), ['controller' => 'PaymentTransactions', 'action' => 'receive', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?> 
                    </li>
                    </ul>
              </div>
            </div>
            
        </div>
        </div>
    </div>
</div>
</div>

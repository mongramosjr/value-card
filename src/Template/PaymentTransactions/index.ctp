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
                <?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send', isset($cryptoWallet->crypto_currency_id) ? $cryptoWallet->crypto_currency_id : '', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?>
            </li>
            <li>
                <?= $this->Html->link(__('Request'), ['controller' => 'PaymentTransactions', 'action' => 'receive', isset($cryptoWallet->crypto_currency_id) ? $cryptoWallet->crypto_currency_id : '', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?>
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
        
        
        
        <?php if(count($cryptoTransactions)>0):?>
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
                        <?php
                            if($cryptoTransaction->has('crypto_currency')){
                                $options = ['places'=>6];
                                if($cryptoTransaction->crypto_currency->symbol){
                                    $options[$cryptoTransaction->crypto_currency->position] = $cryptoTransaction->crypto_currency->symbol;
                                }else{
                                    $options[$cryptoTransaction->crypto_currency->position] = $cryptoTransaction->crypto_currency->name;
                                }
                            }
                            ?>
                        <?= $this->Number->format($cryptoTransaction->amount, $options) ?>
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
        <?php else: ?>
        <p class="text-center">
            No transaction in your account
            </p>
        <p class="text-center">
This section will display the list of your recent transactions, along with their details.
        </p>
        <?php endif; ?>
        
    </div>
    <div class="large-5 medium-6 columns"  style="overflow-y: auto;overflow-x:hidden;">
        <div style="padding-bottom: 58px;">
            <?php $coin_sidebar = $this->cell('CryptoCoinSideBar'); ?>
            <?php echo $coin_sidebar; ?>
        </div>
    </div>
</div>
</div>

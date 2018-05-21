<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerUser $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Change Password'), ['action' => 'changePassword', $user->id], ['confirm' => __('Are you sure you want to change password?')]) ?> </li>
        <li><?= $this->Html->link(__('New Wallet'), ['action' => 'create', $user->id]) ?> </li>
        <li><?= $this->Html->link(__('Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Send'), ['action' => 'send']) ?> </li>
        <li><?= $this->Html->link(__('Receive'), ['action' => 'receive']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Full Name') ?></th>
            <td><?= h($user->full_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $user->is_active ? __('Active') : __('Inactive'); ?></td>
        </tr>
    </table>
</div>

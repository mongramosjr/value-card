<?php
/**
 *
 * 
 */

use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Web3\Web3;

try {
    Configure::load('Web3Service.eth', 'default', false);
} catch (\Exception $e) {
    die($e->getMessage() . "\n");
}

<?php

class Transaction extends AppModel {
    public $belongsTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id',
        )
    );
    public $hasMany = array(
        'TransactionItem'=> array(
            'className' => 'TransactionItem',
            'foreignKey' => 'transaction_id',
        )
    );
}
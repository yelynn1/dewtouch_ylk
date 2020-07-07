<?php

class Member extends AppModel {
    public $hasMany = array(
        'Transaction' => array(
            'className' => 'Transaction',
            'foreignKey' => 'member_id',
        )
    );
}
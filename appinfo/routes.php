<?php

$this->create('password_policy_index', '/')->action(
    function($params){
        require __DIR__ . '/../index.php';
    }
);
$this->create('password_policy_lostpassword', '/lostpassword')->action(
    function($params){
        require __DIR__ . '/../controllers/lostpassword.php';
    }
);

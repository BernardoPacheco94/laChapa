<?php

use LaChapa\Model\User;
use LaChapa\Page;

$app->get('/caixa', function(){
    User::checkLogin();
    
    $page = new Page();

    $page->setTpl('caixa');
});
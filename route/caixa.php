<?php

use LaChapa\Page;

$app->get('/caixa', function(){
    $page = new Page();

    $page->setTpl('caixa');
});
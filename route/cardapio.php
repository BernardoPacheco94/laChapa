<?php

use LaChapa\Page;

$app->get('/cardapio', function(){
    $page = new Page();

    $page->setTpl('cardapio');
});
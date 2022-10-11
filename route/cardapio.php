<?php

use LaChapa\Model\Tipo;
use LaChapa\Page;

//pagina principal - visualizar produtos
$app->get('/cardapio', function(){
    $page = new Page();

    $page->setTpl('cardapio');
});

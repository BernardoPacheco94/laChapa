<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="p-4">
    <button class="btn btn-dark " type="button" data-bs-toggle="offcanvas" data-bs-target="#sideMenuCardapio"
        aria-controls="sideMenuCardapio"><i class="fa-solid fa-gear"></i></button>
</div>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="sideMenuCardapio"
    aria-labelledby="sideMenuCardapioLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sideMenuCardapioLabel">Configurações</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body text-center">
        <a href="/tipos"><button class="btn btn-dark mx-auto mb-4 w-75">Visualizar Tipos</button></a>

        <button class="btn btn-dark mx-auto mb-4 w-75" data-bs-toggle="modal" data-bs-target="#modalNovoTipo">Novo
            Tipo</button>

        <a href="/ingredientes"><button class="btn btn-dark mx-auto mb-4 w-75">Visualizar Ingredientes</button></a>


        <button class="btn btn-dark mx-auto mb-4 w-75" data-bs-toggle="modal"
            data-bs-target="#modalNovoIngrediente">Novo Ingrediente</button>

        <button class="btn btn-dark mx-auto mb-4 w-75" data-bs-toggle="modal" data-bs-target="#modalNovoProduto">Novo
            Produto</button>
    </div>
</div>
<?php require $this->checkTemplate("modal-novo-tipo");?>
<?php require $this->checkTemplate("modal-novo-ingrediente");?>
<?php require $this->checkTemplate("modal-novo-produto");?>
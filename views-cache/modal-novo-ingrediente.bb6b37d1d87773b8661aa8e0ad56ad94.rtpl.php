<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="modal fade" id="modalNovoIngrediente" tabindex="-1" aria-labelledby="modalNovoIngredienteLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalNovoIngredienteLabel">Cadastre um novo Ingrediente</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <label for="NovoIngrediente">
                    Nome:
                </label>
                <input type="text" class="form-control" name="novoIngrediente" id="novoIngrediente"
                    placeholder="Nome do Ingrediente">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                    class="fa-solid fa-xmark"></i></button>
            <button type="button" class="btn btn-dark">Salvar</button>
        </div>
    </div>
</div>
</div>
<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="modal fade" id="modalNovoTipo" tabindex="-1" aria-labelledby="modalNovoTipoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalnometipoLabel">Cadastre um novo Tipo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/addTipo">
                <div class="modal-body">
                    <label for="nometipo">
                        Nome:
                    </label>
                    <input type="text" class="form-control" name="nometipo" id="nometipo"
                        placeholder="Nome do Tipo (ex: Xis, Dog, Porção...)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark"></i></button>
                    <button type="submit" class="btn btn-dark">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
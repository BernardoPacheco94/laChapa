<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="modal fade" id="modalNovoAtendente" tabindex="-1" aria-labelledby="modalNovoAtendenteLabel"
    aria-hidden="true">
    <div class="modal-dialog bg-white">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalNovoAtendenteLabel">Cadastre um novo atendente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/addAtendente">
                <div class="modal-body">
                    <label for="nomeatendente">
                        Nome:
                    </label>
                    <input type="text" class="form-control" name="nomeatendente" id="nomeatendente"
                        placeholder="Nome do Atendente">
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
<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="modal fade" id="modalGerarCartoes" tabindex="-1" aria-labelledby="modalGerarCartoesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalGerarCartoesLabel">Gerar novas comandas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/salvacartoes" method="get">
                    <div class="container">
                        <div class="mx-auto mb-4 ">
                            <input type="number" name="inicial" id="idnuminicial" class="form-control mb-4"
                                placeholder="Número inicial">
                            <input type="number" name="final" id="idnumfinal" class="form-control" placeholder="Número final">
                        </div>
                    </div>
        
                    <div class="container col-6 mx-auto">
                        <button type="submit" class="w-100 btn btn-dark ">
                            Gerar Comandas
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>



<!-- <div class="modal fade" id="modalGerarCartoes" tabindex="-1" aria-labelledby="modalGerarCartoesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <form action="/salvacartoes" method="get">
                <div class="container">
                    <div class="mx-auto mb-4 col-xs-6 col-sm-6 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                        <input type="number" name="inicial" id="idnuminicial" class="form-control mb-4"
                            placeholder="Número inicial">
                        <input type="number" name="final" id="idnumfinal" class="form-control" placeholder="Número final">
                    </div>
                </div>
    
                <div class="container mx-auto col-xs-6 col-sm-6 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                    <button type="submit" class="w-100 btn btn-dark">
                        Gerar Comandas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> -->
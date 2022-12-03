<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Modal - Lançamento da comanda -->
<div class="modal fade" id="modal_comanda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_principal" action="/novaComanda" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nova Comanda</h5>
                    <button type="button" class="btn btn-dark mx-auto w-50">
                        <i class="fa-solid fa-2x fa-print"></i>
                    </button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input class="form-control mb-4" type="text" name="nomecliente" id="nomecliente"
                        placeholder="Nomde do cliente">

                    <select class="form-control mb-4" name="idmesacomanda" id="select_mesa_comanda">
                        <option value="mesa" disabled selected>Mesa</option>
                        <option value="0">Nenhuma</option>
                        <?php $counter1=-1;  if( isset($todasMesas) && ( is_array($todasMesas) || $todasMesas instanceof Traversable ) && sizeof($todasMesas) ) foreach( $todasMesas as $key1 => $value1 ){ $counter1++; ?>
                        <option name="<?php echo htmlspecialchars( $value1["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </option>
                        <?php } ?>
                    </select>

                    <select class="form-control mb-4" name="idatendente" id="select_atendente_comanda">
                        <option value="atendente" disabled selected>Atendente</option>
                        <option value="0">Nenhum</option>
                        <?php $counter1=-1;  if( isset($atendentes) && ( is_array($atendentes) || $atendentes instanceof Traversable ) && sizeof($atendentes) ) foreach( $atendentes as $key1 => $value1 ){ $counter1++; ?>
                        <option name="<?php echo htmlspecialchars( $value1["idatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomeatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </option>
                        <?php } ?>
                    </select>
                    <!-- Exibe produtos já lançados -->
                    <div class="table">
                        <table class="table" id="tabela_produtos_lançados_na_comanda" hidden>
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <!-- Seleciona o produto desejado -->
                    <div class="row">
                        <div class="col-8">
                            <select class="form-control" id="select_tipo_produto_comanda">
                                <option value="tipo" disabled selected>Tipo de Produto</option>
                                <option value="todos">Todos</option>
                                <?php $counter1=-1;  if( isset($tipos) && ( is_array($tipos) || $tipos instanceof Traversable ) && sizeof($tipos) ) foreach( $tipos as $key1 => $value1 ){ $counter1++; ?>
                                <option value="<?php echo htmlspecialchars( $value1["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nometipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        </button>
                        <div class="col-12">
                            <select class="form-control" id="select_produto_comanda">
                                <option value="produto" disabled selected>Selecione o tipo de produto</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tabela de ingredientes -->
                    <div class="row mt-2">
                        <div class="table-responsive">
                            <table class="table table-light table-hover">
                                <thead>
                                    <tr>
                                        <th>Ingrediente</th>
                                        <th>Qtd</th>
                                        <th class="text-center">Adicionar</th>
                                        <th class="text-center">Remover</th>
                                        <th>Valor adc</th>
                                    </tr>
                                </thead>
                                <tbody id="tabela_ingredientes_comanda">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-center">Valor</th>
                                        <th>
                                            <input type="number" step="0.01" name="valortotal" id="valortotal"
                                                class="form-control" hidden >
                                            <input id="valortotal_exibido" class="form-control" disabled >
                                        </th>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="row m-3">
                    <button id="salva_produto_comanda"
                        class="btn btn-dark col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mx-auto">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="w-100 btn btn-dark" data-bs-dismiss="modal">
                        <i class="fa-solid fa-save"></i> Salvar
                    </button>

                    <button type="button" class="w-100 btn btn-warning" data-bs-dismiss="modal">
                        Cancelar
                    </button>


                    <button type="button" class="w-100 btn btn-success">
                        Encerrar Comanda
                    </button>

                </div>
            </form>
        </div>
    </div>

</div>
</div>
</div>
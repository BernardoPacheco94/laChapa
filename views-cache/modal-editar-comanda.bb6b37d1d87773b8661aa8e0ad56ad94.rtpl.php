<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $counter1=-1;  if( isset($comandas) && ( is_array($comandas) || $comandas instanceof Traversable ) && sizeof($comandas) ) foreach( $comandas as $key1 => $value1 ){ $counter1++; ?>
<!-- Modal - Lancamento da comanda -->
<div class="modal fade" id="modal_editar_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_principal" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pedido <?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                    <button type="button" class="btn btn-dark mx-auto w-50">
                        <i class="fa-solid fa-2x fa-print"></i>
                    </button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="idcartaocomanda">Comanda</label>
                    <select class="form-control mb-4 select_cartao_editar_comanda" name="idcartaocomanda" required>
                        <option value="cartao" disabled selected>Comanda</option>
                        <option value="0">Nenhuma</option>
                        <?php $idcartao=$value1["idcartao"]; ?>
                        <?php $counter2=-1;  if( isset($cartoes) && ( is_array($cartoes) || $cartoes instanceof Traversable ) && sizeof($cartoes) ) foreach( $cartoes as $key2 => $value2 ){ $counter2++; ?>
                        <option name="<?php echo htmlspecialchars( $value2["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value2["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"<?php if( $idcartao == $value2["idcartao"] ){ ?> selected <?php } ?>><?php echo htmlspecialchars( $value2["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </option>
                        <?php } ?>
                    </select>

                    <label for="nomecliente">Nome Cliente:</label>
                    <input class="form-control mb-4" type="text" name="nomecliente" id="nomecliente"
                        value="<?php echo htmlspecialchars( $value1["nomecliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

                    <label for="idmesacomanda">Mesa:</label>
                    <select class="form-control mb-4" name="idmesacomanda" id="select_mesa_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <option value="mesa" disabled>Mesa</option>
                        <option value="0">Nenhuma</option>
                        <?php $mesa=$value1["idmesa"]; ?>
                        <?php $counter2=-1;  if( isset($todasMesas) && ( is_array($todasMesas) || $todasMesas instanceof Traversable ) && sizeof($todasMesas) ) foreach( $todasMesas as $key2 => $value2 ){ $counter2++; ?>
                        <option name="<?php echo htmlspecialchars( $value2["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value2["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $value2["idmesa"] == $mesa ){ ?> selected
                            <?php } ?>><?php echo htmlspecialchars( $value2["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </option>
                        <?php } ?>
                    </select>

                    <label for="idatendente">Atendente:</label>
                    <select class="form-control mb-4" name="idatendente"
                        id="select_atendente_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <option value="atendente" disabled>Atendente</option>
                        <option value="0">Nenhum</option>
                        <?php $atendente=$value1["idatendente"]; ?>
                        <?php $counter2=-1;  if( isset($atendentes) && ( is_array($atendentes) || $atendentes instanceof Traversable ) && sizeof($atendentes) ) foreach( $atendentes as $key2 => $value2 ){ $counter2++; ?>
                        <option name="<?php echo htmlspecialchars( $value2["idatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value2["idatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                            <?php if( $atendente == $value2["idatendente"] ){ ?> selected <?php } ?>><?php echo htmlspecialchars( $value2["nomeatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </option>
                        <?php } ?>
                    </select>
                    <!-- Exibe produtos já lancados -->
                    <div class="table">
                        <table class="table table-striped" id="tabela_produtos_lancados_na_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            <thead>
                                <tr>
                                    <th class="text-center">Produto</th>
                                    <th class="text-center">Valor</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody id="body_tabela_produtos_lancados_na_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <?php $counter2=-1;  if( isset($value1["produtos"]) && ( is_array($value1["produtos"]) || $value1["produtos"] instanceof Traversable ) && sizeof($value1["produtos"]) ) foreach( $value1["produtos"] as $key2 => $value2 ){ $counter2++; ?>
                                <tr id="linha_produto_<?php echo htmlspecialchars( $counter2, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    <td class="text-center" id="td_nome_produto_comanda_<?php echo htmlspecialchars( $counter2, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        <?php echo htmlspecialchars( $value2["nomeproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>

                                        <?php $i=0; ?>
                                        <!-- Ingredientes a serem removidos -->
                                        <?php $counter3=-1;  if( isset($value2["removeringrediente"]) && ( is_array($value2["removeringrediente"]) || $value2["removeringrediente"] instanceof Traversable ) && sizeof($value2["removeringrediente"]) ) foreach( $value2["removeringrediente"] as $key3 => $value3 ){ $counter3++; ?>
                                        <?php $i=$counter3+1; ?>
                                        <?php } ?>
                                        <?php if( $i>0 ){ ?>
                                        <ul class="text-start fw-normal">
                                            Sem:
                                            <?php $counter3=-1;  if( isset($value2["removeringrediente"]) && ( is_array($value2["removeringrediente"]) || $value2["removeringrediente"] instanceof Traversable ) && sizeof($value2["removeringrediente"]) ) foreach( $value2["removeringrediente"] as $key3 => $value3 ){ $counter3++; ?>
                                            <li>
                                                <?php echo htmlspecialchars( $value3["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                        <?php $i=0; ?>
                                        <?php } ?>

                                        <!-- Porçoes extra -->
                                        <?php $counter3=-1;  if( isset($value2["porcaoextra"]) && ( is_array($value2["porcaoextra"]) || $value2["porcaoextra"] instanceof Traversable ) && sizeof($value2["porcaoextra"]) ) foreach( $value2["porcaoextra"] as $key3 => $value3 ){ $counter3++; ?>
                                        <?php $i=$counter3+1; ?>
                                        <?php } ?>
                                        <?php if( $i>0 ){ ?>
                                        <ul class="text-start fw-normal">
                                            Porção extra:
                                            <?php $counter3=-1;  if( isset($value2["porcaoextra"]) && ( is_array($value2["porcaoextra"]) || $value2["porcaoextra"] instanceof Traversable ) && sizeof($value2["porcaoextra"]) ) foreach( $value2["porcaoextra"] as $key3 => $value3 ){ $counter3++; ?>
                                            <li>
                                                <?php echo htmlspecialchars( $value3["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value3["qtdporcaoextra"], ENT_COMPAT, 'UTF-8', FALSE ); ?>x
                                            </li>
                                            <?php } ?>
                                        </ul>
                                        <?php $i=0; ?>
                                        <?php } ?>

                                        <!-- Ingredientes adicionais -->
                                        <?php $counter3=-1;  if( isset($value2["ingredienteadicional"]) && ( is_array($value2["ingredienteadicional"]) || $value2["ingredienteadicional"] instanceof Traversable ) && sizeof($value2["ingredienteadicional"]) ) foreach( $value2["ingredienteadicional"] as $key3 => $value3 ){ $counter3++; ?>
                                        <?php $i=$counter3+1; ?>
                                        <?php } ?>
                                        <?php if( $i>0 ){ ?>
                                        <ul class="text-start fw-normal">
                                            Adicional:
                                            <?php $counter3=-1;  if( isset($value2["ingredienteadicional"]) && ( is_array($value2["ingredienteadicional"]) || $value2["ingredienteadicional"] instanceof Traversable ) && sizeof($value2["ingredienteadicional"]) ) foreach( $value2["ingredienteadicional"] as $key3 => $value3 ){ $counter3++; ?>
                                            <li>
                                                <?php echo htmlspecialchars( $value3["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value3["qtdingredienteadicional"], ENT_COMPAT, 'UTF-8', FALSE ); ?>x
                                            </li>
                                            <?php } ?>
                                        </ul>
                                        <?php $i=0; ?>
                                        <?php } ?>

                                        <?php if( $value2["observacao"] ){ ?>
                                        <ul class="text-start fw-normal">
                                            OBS:
                                            <li>
                                                <?php echo htmlspecialchars( $value2["observacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                            </li>
                                        </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        R$ <?php echo formatPrice($value2["vlfinalproduto"]); ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button id="btn_remove_produto_comanda_<?php echo htmlspecialchars( $value2["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                            class="btn fa-solid fa-trash-can text-danger ">
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center" colspan="2">Total:</th>
                                    <th id="valor_total_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="text-start">
                                        R$ <?php echo formatPrice($value1["valortotal"]); ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Seleciona o produto desejado -->
                    <div class="row">
                        <div class="col-8">
                            <select class="form-control" id="select_tipo_produto_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <option value="tipo" id="option_tipo" disabled selected>Tipo de Produto</option>
                                <option value="todos">Todos</option>
                                <?php $counter2=-1;  if( isset($tipos) && ( is_array($tipos) || $tipos instanceof Traversable ) && sizeof($tipos) ) foreach( $tipos as $key2 => $value2 ){ $counter2++; ?>
                                <option value="<?php echo htmlspecialchars( $value2["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value2["nometipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        </button>
                        <div class="col-12">
                            <select class="form-control" id="select_produto_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <option value="produto" disabled selected>Selecione o tipo de produto</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tabela de ingredientes -->
                    <div class="row mt-2">
                        <div class="table-responsive">
                            <table class="table table-light table-hover" id="tabela_ingredientes_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" hidden>
                                <thead>
                                    <tr>
                                        <th>Ingrediente</th>
                                        <th>Qtd</th>
                                        <th class="text-center">Adicionar</th>
                                        <th class="text-center">Remover</th>
                                        <th>Valor adc</th>
                                    </tr>
                                </thead>
                                <tbody id="body_tabela_ingredientes_produto_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-center">Valor</th>
                                        <th colspan="2" class="text-center">
                                            <input type="number" step="0.01" name="valortotal" id="valortotal"
                                                class="form-control" hidden>
                                            <input id="valortotal_exibido_tabela_ingredientes_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled>
                                        </th>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="row m-3">
                    <button type="button" id="salva_produto_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                        class="btn btn-dark col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mx-auto">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="w-100 btn btn-dark" data-bs-dismiss="modal" id="editar_comanda_<?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <i class="fa-solid fa-save"></i> Alterar Pedido <?php echo htmlspecialchars( $value1["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </button>

                    <button type="button" class="w-100 btn btn-warning" data-bs-dismiss="modal">
                        Cancelar
                    </button>


                    <button type="button" class="w-100 btn btn-success">
                        Encerrar Pedido
                    </button>

                </div>
            </form>
        </div>
    </div>

</div>
</div>
</div>
<?php } ?>
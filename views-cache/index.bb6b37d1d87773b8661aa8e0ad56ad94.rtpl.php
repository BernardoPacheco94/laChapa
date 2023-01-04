<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Cards Mesas -->

<section class="container-fluid m-2 mx-auto">
    <div class="row">
        <div id="div-btn-adc-mesa" class="col-3">
            <button class="btn btn-dark" type="button" id="btn-gerenciar-mesas" data-bs-toggle="modal"
                data-bs-target="#modal_gerenciar_mesas">
                Gerenciar Mesas
            </button>
        </div>
        <div id="div-btn-adc-mesa" class="col-3">
            <button type="button" class="btn btn-dark" id="btn-adc-comanda" data-bs-toggle="modal"
                data-bs-target="#modal_nova_comanda">
                Nova Comanda
            </button>
        </div>
    </div>

    <!-- Linha do card -->
    <div class="row" id="card-deck">
        <?php $counter1=-1;  if( isset($mesasExibidas) && ( is_array($mesasExibidas) || $mesasExibidas instanceof Traversable ) && sizeof($mesasExibidas) ) foreach( $mesasExibidas as $key1 => $value1 ){ $counter1++; ?>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-2 p-2 d-inline">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">Mesa <?php echo htmlspecialchars( $value1["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                </div>
                <div class="card-body">
                    <!-- Comandas da mesa / accordion -->
                    <?php $id_mesa=$value1["idmesa"]; ?>
                    <div class="accordion m-2" id="accordion_mesa_<?php echo htmlspecialchars( $id_mesa, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <?php $counter2=-1;  if( isset($value1["comandas"]) && ( is_array($value1["comandas"]) || $value1["comandas"] instanceof Traversable ) && sizeof($value1["comandas"]) ) foreach( $value1["comandas"] as $key2 => $value2 ){ $counter2++; ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="comanda_<?php echo htmlspecialchars( $value2["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_comanda_<?php echo htmlspecialchars( $value2["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-expanded="false"
                                    aria-controls="collapse_comanda_<?php echo htmlspecialchars( $value2["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    Comanda Nº <?php echo htmlspecialchars( $value2["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                </button>
                            </h2>
                            <div id="collapse_comanda_<?php echo htmlspecialchars( $value2["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="accordion-collapse collapse"
                                aria-labelledby="comanda_<?php echo htmlspecialchars( $value2["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                data-bs-parent="#accordion_mesa_<?php echo htmlspecialchars( $id_mesa, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <div class="accordion-body">
                                    <div class="table">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Produto</th>
                                                    <th>Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $counter3=-1;  if( isset($value2["produtoscomanda"]) && ( is_array($value2["produtoscomanda"]) || $value2["produtoscomanda"] instanceof Traversable ) && sizeof($value2["produtoscomanda"]) ) foreach( $value2["produtoscomanda"] as $key3 => $value3 ){ $counter3++; ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars( $value3["nomeproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                    <td>R$ <?php echo formatPrice($value3["vlfinalproduto"]); ?></td>
                                                </tr>                                                    
                                                <?php } ?>
                                            </tbody>
                                            <tfoot class="bg-light">
                                                <tr>
                                                    <th>Total</th>
                                                    <td>R$ <?php echo formatPrice($value2["valortotal"]); ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-center ">
                                            <button type="button" class="btn btn-dark"
                                                id="btn-gerenciar-comanda-<?php echo htmlspecialchars( $value2["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-bs-toggle="modal"
                                                data-bs-target="#modal_editar_comanda_<?php echo htmlspecialchars( $value2["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                                Gerenciar Comanda <?php echo htmlspecialchars( $value2["idcomanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                            </button>
                                        </div>
                                        <div class="col-6 text-center">
                                            <span class="">
                                                <a href="/comanda/print/idcomanda"><i
                                                        class="text-dark fa-solid fa-2x fa-print"></i> </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="container text-center col-xxs-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                           <a href="/removerMesa/<?php echo htmlspecialchars( $value1["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button type="button" class="btn btn-secondary w-100">
                                    Ocultar Mesa
                                </button>
                            </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>


<?php require $this->checkTemplate("modal-nova-comanda");?>

<?php require $this->checkTemplate("modal-editar-comanda");?>

<?php require $this->checkTemplate("modal-gerenciar-mesas");?>
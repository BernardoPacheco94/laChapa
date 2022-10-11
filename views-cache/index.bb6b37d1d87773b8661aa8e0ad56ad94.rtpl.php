<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Cards Mesas -->

<section class="container-fluid m-2 mx-auto">
    <div class="row">
        <div id="div-btn-adc-mesa" class="col-3">
            <button class="btn btn-dark" type="button" id="btn-gerenciar-mesas" data-bs-toggle="modal"
                data-bs-target="#modal_gerenciar_mesas">
                Gerenciar Mesas
            </button>
        </div>
    </div>

    <!-- Linha do card -->
    <div class="row" id="card-deck">
        <?php $counter1=-1;  if( isset($mesa) && ( is_array($mesa) || $mesa instanceof Traversable ) && sizeof($mesa) ) foreach( $mesa as $key1 => $value1 ){ $counter1++; ?>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-2 p-2 d-inline">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">Mesa <?php echo htmlspecialchars( $value1["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                </div>
                <div class="card-body">
                    <!-- Comandas da mesa / accordion -->
                    <div class="accordion m-2" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="comanda_i">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Comanda Nº 1
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="comanda_i"
                                data-bs-parent="#accordionExample">
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
                                                <tr>
                                                    <td>Xis Completo</td>
                                                    <td>R$ 18,00</td>
                                                </tr>
                                                <tr>
                                                    <td>Cachorro Simples</td>
                                                    <td>R$ 15,00</td>
                                                </tr>
                                                <tr>
                                                    <td>Coca-cola</td>
                                                    <td>R$ 6,00</td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="bg-light">
                                                <tr>
                                                    <th>Total</th>
                                                    <td>R$ 39,00</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-center ">
                                            <button type="button" class="btn btn-dark" id="btn-adc-comanda"
                                                data-bs-toggle="modal" data-bs-target="#modal_lanca_comanda">
                                                Novo Produto
                                            </button>
                                        </div>
                                        <div class="col-6 text-center">
                                            <span class="">
                                                <a href=""><i class="text-dark fa-solid fa-2x fa-print"></i> </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Comanda Nº 2
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
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
                                                <tr>
                                                    <td>Xis Completo</td>
                                                    <td>R$ 18,00</td>
                                                </tr>
                                                <tr>
                                                    <td>Cachorro Simples</td>
                                                    <td>R$ 15,00</td>
                                                </tr>
                                                <tr>
                                                    <td>Coca-cola</td>
                                                    <td>R$ 6,00</td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="bg-light">
                                                <tr>
                                                    <th>Total</th>
                                                    <td>R$ 39,00</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Comanda Nº 3
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
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
                                                <tr>
                                                    <td>Xis Completo</td>
                                                    <td>R$ 18,00</td>
                                                </tr>
                                                <tr>
                                                    <td>Cachorro Simples</td>
                                                    <td>R$ 15,00</td>
                                                </tr>
                                                <tr>
                                                    <td>Coca-cola</td>
                                                    <td>R$ 6,00</td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="bg-light">
                                                <tr>
                                                    <th>Total</th>
                                                    <td>R$ 39,00</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-dark" id="btn-adc-comanda" data-bs-toggle="modal"
                                data-bs-target="#modal_lanca_comanda">
                                Nova Comanda
                            </button>
                        </div>
                        <div class="col-6 text-end">                            
                            <a href="/removerMesa/<?php echo htmlspecialchars( $value1["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button type="button" class="btn btn-secondary">
                                        Ocultar Mesa
                                </button>
                            </a>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>


<?php require $this->checkTemplate("modal-nova-comanda");?>

<?php require $this->checkTemplate("modal-gerenciar-mesas");?>
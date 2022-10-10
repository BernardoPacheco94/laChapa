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

                    <button type="button" class="btn btn-dark" id="btn-adc-comanda" data-bs-toggle="modal"
                        data-bs-target="#modal_lanca_comanda">
                        Nova Comanda
                    </button>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>


<!-- Modal - Lançamento da comanda -->
<div class="modal fade" id="modal_lanca_comanda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comanda Nº 1</h5>
                <button type="button" class="btn btn-dark mx-auto w-50">
                    <i class="fa-solid fa-2x fa-print"></i>
                </button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Exibe produtos já cadastrados -->
                <div class="table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Cachorro Simples</td>
                                <td>R$ 15,00</td>
                            </tr>
                            <tr>
                                <td>Coca-cola</td>
                                <td>R$ 6,00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- Seleciona o sroduto desejado -->
                <div class="form">
                    <div class="row">
                        <div class="col-8">
                            <select class="form-control" id="select_tipo_produto">
                                <option value="tipo" disabled selected>Tipo</option>
                                <option value="xis">Xis</option>
                                <option value="cachorro">Cachorro</option>
                                <option value="porção">Porção</option>
                                <option value="refri">Refri</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <select class="form-control" id="select_produto">
                                <option value="produto" disabled selected>Produto</option>
                                <option value="completo">Xis Completo</option>
                                <option value="galinha">Xis Galinha</option>
                                <option value="coracao">Xis Coração</option>
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
                                <tbody>
                                    <tr>
                                        <td>Pão</td>
                                        <td>1x</td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-plus text-success fa-2x"></i></a>
                                        </td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-minus text-warning fa-2x"></i></a>
                                        </td>
                                        <td>R$ 0,00</td>
                                    </tr>

                                    <tr>
                                        <td>Habúrguer</td>
                                        <td>2x</td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-plus text-success fa-2x"></i></a>
                                        </td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-minus text-warning fa-2x"></i></a>
                                        </td>
                                        <td>R$ 3,00</td>
                                    </tr>

                                    <tr>
                                        <td>Alface</td>
                                        <td>1x</td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-plus text-success fa-2x"></i></a>
                                        </td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-minus text-warning fa-2x"></i></a>
                                        </td>
                                        <td>R$ 0,00</td>
                                    </tr>

                                    <tr>
                                        <td>Milho</td>
                                        <td>1x</td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-plus text-success fa-2x"></i></a>
                                        </td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-minus text-warning fa-2x"></i></a>
                                        </td>
                                        <td>R$ 0,00</td>
                                    </tr>

                                    <tr>
                                        <td>Ervilha</td>
                                        <td>1x</td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-plus text-success fa-2x"></i></a>
                                        </td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-minus text-warning fa-2x"></i></a>
                                        </td>
                                        <td>R$ 0,00</td>
                                    </tr>

                                    <tr>
                                        <td>Tomate</td>
                                        <td>1x</td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-plus text-success fa-2x"></i></a>
                                        </td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-minus text-warning fa-2x"></i></a>
                                        </td>
                                        <td>R$ 0,00</td>
                                    </tr>

                                    <tr>
                                        <td>Ketchup</td>
                                        <td>1x</td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-plus text-success fa-2x"></i></a>
                                        </td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-minus text-warning fa-2x"></i></a>
                                        </td>
                                        <td>R$ 0,00</td>
                                    </tr>

                                    <tr>
                                        <td>Maionese</td>
                                        <td>1x</td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-plus text-success fa-2x"></i></a>
                                        </td>
                                        <td class="text-center"><a href=""><i
                                                    class="fa-solid fa-circle-minus text-warning fa-2x"></i></a>
                                        </td>
                                        <td>R$ 0,00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-center">Total</th>
                                        <th>R$ 18,00</th>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row m-3">
                    <button class="btn btn-dark col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mx-auto">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">
                        Encerrar Comanda
                    </button>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal - Gerenciar mesas -->
<div class="modal fade" id="modal_gerenciar_mesas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Gerenciar Mesas</h3>

            </div>
            <div class="modal-body">
                <div class="card w-100" style="width: 18rem;">
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-8">
                                <h3>Mesa Nº x</h3>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-dark">
                                    Alocar Mesa
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <a href="/addMesa">
                                <button class="btn btn-dark" >
                                    Nova Mesa
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
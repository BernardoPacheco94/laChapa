<?php if(!class_exists('Rain\Tpl')){exit;}?>
    <main>
        <div class="row container mx-auto">
            <div class="form-group w-100">
                <form action="tela_caixa.html" class="form">
                    <div class="col-12 mt-3">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-inline-block">
                            <div class="form-check text-center text-sm-center text-right ">

                                <label class="form-check-label" for="check_pendentes">
                                    <input class="form-check-input" type="checkbox" name="check_pendentes"
                                        id="check_pendentes" checked>
                                    Somente Pendentes
                                </label>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 d-inline-block">
                            <input type="date" name="data_caixa" id="" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container">
            <div class="table-responsive" id="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p class="text-center">Comanda</p>
                            </th>
                            <th scope="col">Produtos</th>
                            <th scope="col">Status</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center">10</th>
                            <td>Xis Completo, 1 Refri, 2 Cerveja</td>
                            <td><a href="#">Pendente</a></td>
                            <td>R$ 60,00</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">11</th>
                            <td>Xis Completo, 1 Refri, 2 Cerveja</td>
                            <td><a href="#">Pago</a></td>
                            <td>R$ 60,00</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">12</th>
                            <td>Xis Completo, 1 Refri, 2 Cerveja</td>
                            <td><a href="#">Pago</a></td>
                            <td>R$ 60,00</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">13</th>
                            <td>Xis Completo, 1 Refri, 2 Cerveja</td>
                            <td><a href="#">Pendente</a></td>
                            <td>R$ 60,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container-fluid text-center">


            <button class="btn btn-dark col-xs-12 col-sm-12 col-md-6 col-lg-5 col-xl-5" type="button"
                id="btn-totalizador" data-bs-toggle="modal" data-toggle="modal" data-bs-target="#modalTotalizador">
                Totalizadores
            </button>
        </div>

        <!-- Modal Totalizador -->
        <div class="modal fade" id="modalTotalizador" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Totalizadores</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Dinheiro</th>
                                        <th scope="col">Crédito</th>
                                        <th scope="col">Débito</th>
                                        <th scope="col">Pix</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>R$ 100,00</td>
                                        <td>R$ 100,00</td>
                                        <td>R$ 100,00</td>
                                        <td>R$ 100,00</td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

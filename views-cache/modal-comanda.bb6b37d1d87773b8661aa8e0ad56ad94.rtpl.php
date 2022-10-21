<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Modal - Lançamento da comanda -->
<div class="modal fade" id="modal_comanda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/novaComanda" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comanda Nº 1</h5> 
                    <button type="button" class="btn btn-dark mx-auto w-50">
                        <i class="fa-solid fa-2x fa-print"></i>
                    </button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <input class="form-control" type="text" name="nomecliente" id="nomecliente" placeholder="Nomde do cliente">
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
                                            <th>
                                                <input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="15">
                                                <input class="form-control" disabled value="15">
                                            </th>
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
                        <button type="submit" class="w-100 btn btn-dark" data-bs-dismiss="modal">
                            <i class="fa-solid fa-save"></i> Salvar
                        </button>
                    </form>
                        <button type="button" class="w-100 btn btn-warning" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="button" class="w-100 btn btn-success">
                            Encerrar Comanda
                        </button>
                    </div>
                </div>

        </div>
    </div>
</div>
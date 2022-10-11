<?php if(!class_exists('Rain\Tpl')){exit;}?><main>
    <section>
        <?php require $this->checkTemplate("side-menu");?>
        <div class="row container mx-auto">
            <h3 class="mx-auto mt-3">Produtos</h3>
        </div>


        <!-- Seleção de produto -->
        <div class="row container mx-auto">
            <div class="form-group w-100">
                <form action="" class="form">
                    <div class="col-12">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 d-inline-block">
                            <select name="select_tipo" id="select_tipo" class="form-control">
                                <option value="1" disabled selected>Tipo</option>
                                <option value="2">Xis</option>
                                <option value="3">Cachorro</option>
                                <option value="4">Refri</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 col-xl-8 d-inline-block">
                            <select name="select_produto" id="select_produto" class="form-control mt-2">
                                <option value="1" disabled selected>Produto</option>
                                <option value="2">Xis Completo</option>
                                <option value="3">Xis Galinha</option>
                                <option value="4">Xis Coração</option>
                                <option value="5">Xis Salada</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- Tabela de produtos -->
        <div class="container">
            <div class="table table-responsive" id="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Produtos</th>
                            <th scope="col">Ingredientes</th>
                            <th scope="col">Valor</th>
                            <th scope="col" class="text-center">Editar</th>
                            <th scope="col" class="text-center">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Xis</td>
                            <td>Xis Completo</td>
                            <td>Pãp, Ketchup, maionese, mostarda, milho, ervilha, alface, tomate, haburguer, ovo
                            </td>
                            <td>R$ 15,00</td>
                            <td class="text-center"><a href="#"><i class="fa-solid fa-2x fa-edit text-info"></i></a>
                            </td>
                            <td class="text-center"><a href=""><i
                                        class="fa-solid fa-2x fa-trash-can text-danger"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </section>







</main>
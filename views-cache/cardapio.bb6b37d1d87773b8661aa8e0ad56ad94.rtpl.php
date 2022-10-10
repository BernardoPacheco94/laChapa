<?php if(!class_exists('Rain\Tpl')){exit;}?>
    <main>
        <section>
            <div class="row container mx-auto">
                <h3 class="mx-auto mt-3">Produtos</h3>
            </div>

            <!-- Seleção de produto -->
            <div class="row container mx-auto">
                <div class="form-group w-100">
                    <form action="tela_produtos.html" class="form">
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
                                <td class="text-center"><a href="#"><i class="fa-solid fa-edit text-info"></i></a></td>
                                <td class="text-center"><a href=""><i class="fa-solid fa-trash-can text-danger"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Xis</td>
                                <td>Xis Completo</td>
                                <td>Pãp, Ketchup, maionese, mostarda, milho, ervilha, alface, tomate, haburguer, ovo
                                </td>
                                <td>R$ 15,00</td>
                                <td class="text-center"><a href="#"><i class="fa-solid fa-edit text-info"></i></a></td>
                                <td class="text-center"><a href=""><i class="fa-solid fa-trash-can text-danger"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Xis</td>
                                <td>Xis Completo</td>
                                <td>Pãp, Ketchup, maionese, mostarda, milho, ervilha, alface, tomate, haburguer, ovo
                                </td>
                                <td>R$ 15,00</td>
                                <td class="text-center"><a href="#"><i class="fa-solid fa-edit text-info"></i></a></td>
                                <td class="text-center"><a href=""><i class="fa-solid fa-trash-can text-danger"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Xis</td>
                                <td>Xis Completo</td>
                                <td>Pãp, Ketchup, maionese, mostarda, milho, ervilha, alface, tomate, haburguer, ovo
                                </td>
                                <td>R$ 15,00</td>
                                <td class="text-center"><a href="#"><i class="fa-solid fa-edit text-info"></i></a></td>
                                <td class="text-center"><a href=""><i class="fa-solid fa-trash-can text-danger"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Xis</td>
                                <td>Xis Completo</td>
                                <td>Pãp, Ketchup, maionese, mostarda, milho, ervilha, alface, tomate, haburguer, ovo
                                </td>
                                <td>R$ 15,00</td>
                                <td class="text-center"><a href="#"><i class="fa-solid fa-edit text-info"></i></a></td>
                                <td class="text-center"><a href=""><i class="fa-solid fa-trash-can text-danger"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row text-center">
                <div class="col-xs12-col-sm-12 col-md-8 col-lg-4 col-xl-4 mx-auto">
                    <button class="btn btn-dark mx-auto col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 m-2 p-2" data-bs-toggle="modal" data-bs-target="#modalNovoTipo">Novo
                        Tipo</button>
                    <button class="btn btn-dark mx-auto col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 m-2 p-2" data-bs-toggle="modal" data-bs-target="#modalNovoProduto">Novo
                        Produto</button>
                </div>
            </div>
        </section>

        <!-- Modal cadastro tipo -->
        <div class="modal fade" id="modalNovoTipo" tabindex="-1" aria-labelledby="modalNovoTipoLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="modalNovoTipoLabel">Cadastre um novo Tipo</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="post">
                    <label for="NovoTipo">
                        Nome:
                    </label>
                    <input type="text" class="form-control" name="novoTipo" id="novoTipo" placeholder="Nome do Tipo (ex: Xis, Dog, Porção...)">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                  <button type="button" class="btn btn-dark">Salvar</button>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modal Novo Produto -->
          <div class="modal fade" id="modalNovoProduto" tabindex="-1" aria-labelledby="modalNovoProdutoLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="modalNovoProdutoLabel">Cadastre um novo Produto</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="form" action="" method="post">
                    <label for="selectTipo">Tipo:</label>
                    <select class="form-control" name="selectTipo" id="selectTipo">
                        <option class="form-control" value="xis">Xis</option>
                        <option class="form-control" value="xis">Dog</option>
                        <option class="form-control" value="xis">Porção</option>
                    </select>
                    <label for="nomeProduto">Nome:</label>
                    <input type="text" class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Nome do Tipo (ex: Xis, Dog, Porção...)">
                    <label for="checkIngredientes"><h5>Ingredientes</h5></label>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="ingr1">
                        <label class="form-check-label" for="ingr1">Ingrediente 1</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Ingrediente 2</label>
                    </div>

                    <label for="vlProduto">Valor:</label>
                    <input class="form-control" type="number" name="vlProduto" id="vlProduto">

                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                  <button type="button" class="btn btn-dark">Salvar</button>
                </div>
              </div>
            </div>
          </div>

    </main>

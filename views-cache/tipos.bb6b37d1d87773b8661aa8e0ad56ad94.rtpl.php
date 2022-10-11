<?php if(!class_exists('Rain\Tpl')){exit;}?><main>
    <section>

        <div class="row container mx-auto">
            <h3 class="mx-auto mt-3">Tipos Cadastrados</h3>
        </div>

        <!-- Seleção de produto -->
        <div class="row container mx-auto">
            <div class="form-group w-100">
                <form action="" class="form">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 col-xl-8 d-inline-block">
                            <input class="form-control mb-3" type="search" name="pesquisar" id="pesquisar"
                                placeholder="Pesquisar">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                            <button type="submit" class="w-100 btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
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
                            <th scope="col" class="text-center">Código</th>
                            <th scope="col">Tipo</th>
                            <th scope="col" class="text-center">Editar</th>
                            <th scope="col" class="text-center">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter1=-1;  if( isset($tipos) && ( is_array($tipos) || $tipos instanceof Traversable ) && sizeof($tipos) ) foreach( $tipos as $key1 => $value1 ){ $counter1++; ?>
                        <tr>
                            <th scope="row" class="text-center"><?php echo htmlspecialchars( $value1["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></th>
                            <td class="text-start"><?php echo htmlspecialchars( $value1["nometipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                            <td class="text-center"><a href="#"><i class="fa-solid fa-2x fa-edit text-info"></i></a>
                            </td>
                            <td class="text-center"><a href="/tipos/deletar/<?php echo htmlspecialchars( $value1["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('Deseja realmente deletar o tipo <?php echo htmlspecialchars( $value1["nometipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?')"><i
                                        class="fa-solid fa-2x fa-trash-can text-danger"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>

    </section>

    <!-- Modal cadastro tipo -->
    <?php require $this->checkTemplate("modal-novo-tipo");?>

    <div class="row container mx-auto">
        <div class="mx-auto col-xs-12 col-sm-12 col-md-8 col-lg-6 col-xl-4 col-xxl-4">
            <button class="btn btn-dark w-100" data-bs-toggle="modal"
            data-bs-target="#modalNovoTipo">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>

    
    <div class="modal fade" id="modalNovoTipo" tabindex="-1" aria-labelledby="modalNovoTipoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalnometipoLabel">Cadastre um novo Tipo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addTipo">
                    <div class="modal-body">
                        <label for="nometipo">
                            Nome:
                        </label>
                        <input type="text" class="form-control" name="nometipo" id="nometipo"
                            placeholder="Nome do Tipo (ex: Xis, Dog, Porção...)">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal cadastro Ingrediente -->
    <div class="modal fade" id="modalNovoIngrediente" tabindex="-1" aria-labelledby="modalNovoIngredienteLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalNovoIngredienteLabel">Cadastre um novo Ingrediente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <label for="NovoIngrediente">
                            Nome:
                        </label>
                        <input type="text" class="form-control" name="novoIngrediente" id="novoIngrediente"
                            placeholder="Nome do Ingrediente">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark"></i></button>
                    <button type="button" class="btn btn-dark">Salvar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Novo Produto -->
    <div class="modal fade" id="modalNovoProduto" tabindex="-1" aria-labelledby="modalNovoProdutoLabel"
        aria-hidden="true">
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
                        <input type="text" class="form-control" name="nomeProduto" id="nomeProduto"
                            placeholder="Nome do Tipo (ex: Xis, Dog, Porção...)">
                        <label for="checkIngredientes">
                            <h5>Ingredientes</h5>
                        </label>

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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark"></i></button>
                    <button type="button" class="btn btn-dark">Salvar</button>
                </div>
            </div>
        </div>
    </div>

</main>
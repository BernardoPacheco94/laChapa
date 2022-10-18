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
                                <?php $counter1=-1;  if( isset($tipos) && ( is_array($tipos) || $tipos instanceof Traversable ) && sizeof($tipos) ) foreach( $tipos as $key1 => $value1 ){ $counter1++; ?>
                                <option value="<?php echo htmlspecialchars( $value1["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nometipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                <?php } ?>
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
                            <th scope="col">Nome</th>
                            <th scope="col">Ingredientes</th>
                            <th scope="col">Valor</th>
                            <th scope="col" class="text-center">Editar</th>
                            <th scope="col" class="text-center">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter1=-1;  if( isset($produtos) && ( is_array($produtos) || $produtos instanceof Traversable ) && sizeof($produtos) ) foreach( $produtos as $key1 => $value1 ){ $counter1++; ?>
                        <tr>
                            <th scope="row" class="text-center"><?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></th>
                            <td><?php echo htmlspecialchars( $value1["nometipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                            <td><?php echo htmlspecialchars( $value1["nomeproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                            <td>
                                <ul class="list-group list-group-horizontal">
                                    <?php $counter2=-1;  if( isset($value1["0"]["ingredientes"]) && ( is_array($value1["0"]["ingredientes"]) || $value1["0"]["ingredientes"] instanceof Traversable ) && sizeof($value1["0"]["ingredientes"]) ) foreach( $value1["0"]["ingredientes"] as $key2 => $value2 ){ $counter2++; ?>
                                    <li class="list-group-item"><?php echo htmlspecialchars( $value2, ENT_COMPAT, 'UTF-8', FALSE ); ?></li>
                                    <?php } ?>
                                </ul>
                            </td>
                            <td>R$ <?php echo formatPrice($value1["valorproduto"]); ?></td>
                            <td class="text-center"><button class="btn" data-bs-toggle="modal"
                                    data-bs-target="#modalEditarProduto<?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i
                                        class="fa-solid fa-2x fa-edit text-info"></i></button>
                            </td>
                            <td class="text-center"><a href="/produto/deletar/<?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                    onclick="return confirm('Deseja realmente excluir o produto <?php echo htmlspecialchars( $value1["nomeproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?')"><i
                                        class="fa-solid fa-2x fa-trash-can text-danger"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php require $this->checkTemplate("modal-editar-produto");?>
                    </tbody>
                </table>
                <div class="container mx-auto col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                    <button class="w-100 btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalNovoProduto">
                        <i class="fa-solid fa-plus"></i>
                    </button>                        
                </div>
            </div>

        </div>

    </section>
</main>
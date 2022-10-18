<?php if(!class_exists('Rain\Tpl')){exit;}?><main>
    
    <section>
        <?php require $this->checkTemplate("side-menu");?>   
                  
        <div class="row container mx-auto">
            <h3 class="mx-auto mt-3">Ingredientes Cadastrados</h3>
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

        <!-- Tabela de ingredientes -->
        <div class="container">
            <div class="table table-responsive" id="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Código</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Valor Adicional</th>
                            <th scope="col" class="text-center">Editar</th>
                            <th scope="col" class="text-center">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter1=-1;  if( isset($ingredientes) && ( is_array($ingredientes) || $ingredientes instanceof Traversable ) && sizeof($ingredientes) ) foreach( $ingredientes as $key1 => $value1 ){ $counter1++; ?>
                        <tr>       
                            <th scope="row" class="text-center"><?php echo htmlspecialchars( $value1["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?></th>
                            <td class="text-start"><?php echo htmlspecialchars( $value1["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                            <td class="text-start">R$ <?php echo formatPrice($value1["valoradicional"]); ?></td>
                            <td class="text-center"><button class="btn" data-bs-toggle="modal" data-bs-target="#modalEditarIngrediente<?php echo htmlspecialchars( $value1["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa-solid fa-2x fa-edit text-info"></i></button>
                            </td>
                            <td class="text-center"><a href="/ingrediente/deletar/<?php echo htmlspecialchars( $value1["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('Deseja realmente deletar o ingrediente <?php echo htmlspecialchars( $value1["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?')"><i
                                        class="fa-solid fa-2x fa-trash-can text-danger"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php require $this->checkTemplate("modal-editar-ingrediente");?>
                    </tbody>
                </table>
                    <div class="container mx-auto col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                        <button class="w-100 btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalNovoIngrediente">
                            <i class="fa-solid fa-plus"></i>
                        </button>                        
                    </div>
               
            </div>

        </div>
    </section>

</main>
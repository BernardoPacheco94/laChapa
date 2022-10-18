<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Modal - Novo Produto -->
<div class="modal fade" id="modalNovoProduto" tabindex="-1" aria-labelledby="modalNovoProdutoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="modalNovoProdutoLabel">Novo Produto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/salvaProduto" autocomplete="off">
                <div class="modal-body">
                    <!-- Dados do produto -->

                    <label for="nomeproduto">
                        Nome do Produto:
                    </label>
                    <input type="text" class="form-control" name="nomeproduto"  id="nomeproduto"
                        placeholder="Nome do Produto">

                    <label for="select_tipo_produto">Tipo:</label>
                    <select class="form-control" name="idtipo" id="select_tipo_produto">
                        <option value="idtipo" disabled selected>Tipo</option>
                        <?php $counter1=-1;  if( isset($tipos) && ( is_array($tipos) || $tipos instanceof Traversable ) && sizeof($tipos) ) foreach( $tipos as $key1 => $value1 ){ $counter1++; ?>
                        <option name="<?php echo htmlspecialchars( $value1["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nometipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        <?php } ?>
                    </select>

                    <label for="check_ingredientes">Ingredientes:</label>
                    <div class="card">
                        <div class="card-body">
                            <!-- <input type="search" class="form-control" placeholder="Pesquisar Ingrediente" name="pesquisar"> -->
                            <?php $counter1=-1;  if( isset($ingredientes) && ( is_array($ingredientes) || $ingredientes instanceof Traversable ) && sizeof($ingredientes) ) foreach( $ingredientes as $key1 => $value1 ){ $counter1++; ?>
                            <div class="form-check form-switch">
                                <input class="mb-2 form-check-input" type="checkbox" role="switch"
                                    id="<?php echo htmlspecialchars( $value1["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="ingredientes[]" value="<?php echo htmlspecialchars( $value1["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" >
                                <label class="mb-2 form-check-label"
                                    for="<?php echo htmlspecialchars( $value1["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <label for="valorproduto">Valor</label>
                    <input class="form-control" type="number" name="valorproduto"  id="valorproduto" step="0.01"
                        placeholder="R$">

                </div>
                <div class="row m-3">
                    <button type="submit" class="btn btn-dark col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mx-auto">
                        <i class="fa-solid fa-save"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
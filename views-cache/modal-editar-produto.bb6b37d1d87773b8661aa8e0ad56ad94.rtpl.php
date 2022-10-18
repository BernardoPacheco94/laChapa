<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $counter1=-1;  if( isset($produtos) && ( is_array($produtos) || $produtos instanceof Traversable ) && sizeof($produtos) ) foreach( $produtos as $key1 => $value1 ){ $counter1++; ?>
<div class="modal fade" id="modalEditarProduto<?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" tabindex="-1"
    aria-labelledby="modalEditarProduto<?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditarProduto<?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>Label">Alterar Produto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/editarProduto/<?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="modal-body">
                    <label for="nomeproduto">
                        Nome:
                    </label>
                    <input type="text" class="form-control" name="nomeproduto" id="nomeproduto"
                        value="<?php echo htmlspecialchars( $value1["nomeproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

                    <label for="valorproduto">
                        Valor:
                    </label>
                    <input type="number" step="0.01" class="form-control" name="valorproduto" id="valorproduto"
                        value="<?php echo htmlspecialchars( $value1["valorproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

                    <label for="select_tipo_produto">Tipo:</label>
                    <?php $tipo=$value1["idtipo"]; ?>
                    <select class="form-control" name="select_tipo_produto" id="select_tipo_produto">
                        <?php $counter2=-1;  if( isset($tipos) && ( is_array($tipos) || $tipos instanceof Traversable ) && sizeof($tipos) ) foreach( $tipos as $key2 => $value2 ){ $counter2++; ?>
                        <option name="<?php echo htmlspecialchars( $value2["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value2["idtipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $value2["idtipo"] == $tipo ){ ?> selected
                            <?php } ?>><?php echo htmlspecialchars( $value2["nometipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        <?php } ?>
                    </select>
                    <label for="check_ingredientes">Ingredientes:</label>
                    <div class="card">
                        <div class="card-body">
                            <!-- <input type="search" class="form-control" placeholder="Pesquisar Ingrediente" name="pesquisar"> -->
                            <?php $counter2=-1;  if( isset($ingredientes) && ( is_array($ingredientes) || $ingredientes instanceof Traversable ) && sizeof($ingredientes) ) foreach( $ingredientes as $key2 => $value2 ){ $counter2++; ?>
                            <div class="form-check form-switch">
                                <input class="mb-2 form-check-input" type="checkbox" role="switch"
                                    id="<?php echo htmlspecialchars( $value2["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="ingredientes[]" value="<?php echo htmlspecialchars( $value2["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <label class="mb-2 form-check-label"
                                    for="<?php echo htmlspecialchars( $value2["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value2["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

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
<?php } ?>
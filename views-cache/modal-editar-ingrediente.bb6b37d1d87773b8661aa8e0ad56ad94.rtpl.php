<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $counter1=-1;  if( isset($ingredientes) && ( is_array($ingredientes) || $ingredientes instanceof Traversable ) && sizeof($ingredientes) ) foreach( $ingredientes as $key1 => $value1 ){ $counter1++; ?>
<div class="modal fade" id="modalEditarIngrediente<?php echo htmlspecialchars( $value1["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" tabindex="-1" aria-labelledby="modalEditarIngrediente<?php echo htmlspecialchars( $value1["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditarIngrediente<?php echo htmlspecialchars( $value1["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>Label">Alterar Ingrediente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/editarIngrediente/<?php echo htmlspecialchars( $value1["idingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="modal-body">
                    <label for="nomeingrediente">
                        Nome: 
                    </label>
                    <input type="text" class="form-control" name="nomeingrediente" id="nomeingrediente"
                        value="<?php echo htmlspecialchars( $value1["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        
                        <label for="valoradicional">
                            Valor: 
                        </label>
                        <input type="number" step="0.01" class="form-control" name="valoradicional" id="valoradicional"
                            value="<?php echo htmlspecialchars( $value1["valoradicional"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

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
<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $counter1=-1;  if( isset($atendentes) && ( is_array($atendentes) || $atendentes instanceof Traversable ) && sizeof($atendentes) ) foreach( $atendentes as $key1 => $value1 ){ $counter1++; ?>
<div class="modal fade" id="modalEditarAtendente<?php echo htmlspecialchars( $value1["idatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" tabindex="-1" aria-labelledby="modalEditarAtendente<?php echo htmlspecialchars( $value1["idatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditarAtendente<?php echo htmlspecialchars( $value1["idatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>Label">Alterar Atendente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/editarAtendente/<?php echo htmlspecialchars( $value1["idatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="modal-body">
                    <label for="nomeatendente">
                        Nome: 
                    </label>
                    <input type="text" class="form-control" name="nomeatendente" id="nomeatendente"
                        value="<?php echo htmlspecialchars( $value1["nomeatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
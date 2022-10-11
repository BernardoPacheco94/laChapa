<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Modal - Gerenciar mesas -->
<div class="modal fade" id="modal_gerenciar_mesas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Gerenciar Mesas</h3>

            </div>
            <div class="modal-body">
                <div class="card w-100" style="width: 18rem;">
                    <?php $counter1=-1;  if( isset($mesaOculta) && ( is_array($mesaOculta) || $mesaOculta instanceof Traversable ) && sizeof($mesaOculta) ) foreach( $mesaOculta as $key1 => $value1 ){ $counter1++; ?>
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-8">
                                <h3>Mesa Nº <?php echo htmlspecialchars( $value1["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                            </div>
                            <div class="col-4">
                                <a href="/exibeMesa/<?php echo htmlspecialchars( $value1["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    <button class="btn btn-dark">
                                        Alocar Mesa
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="card-footer">
                        <div class="text-center">
                            <a href="/addMesa">
                                <button class="btn btn-dark" >
                                    Nova Mesa
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
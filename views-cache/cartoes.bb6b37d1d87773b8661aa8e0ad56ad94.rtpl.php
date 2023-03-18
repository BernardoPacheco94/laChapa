<?php if(!class_exists('Rain\Tpl')){exit;}?><main>

    <section>

        <div class="row container mx-auto">
            <h3 class="mx-auto mt-3">Comandas</h3>
        </div>

        <div class="container text-center">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalGerarCartoes">
                Novas comandas
            </button>
        </div>

        <!-- Tabela de cartoes -->
        <div class="container col-xs-8 col-sm-8 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
            <div class="table table-responsive" id="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Número</th>
                            <th scope="col" class="text-center">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter1=-1;  if( isset($listacartoes) && ( is_array($listacartoes) || $listacartoes instanceof Traversable ) && sizeof($listacartoes) ) foreach( $listacartoes as $key1 => $value1 ){ $counter1++; ?>
                        <tr>
                            <td class="text-center"><?php echo htmlspecialchars( $value1["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                            <td class="text-center"><a href="/cartao/deletar/<?php echo htmlspecialchars( $value1["idcartao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                    onclick="return confirm('Deseja realmente deletar a comanda <?php echo htmlspecialchars( $value1["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?')"><i
                                        class="fa-solid fa-2x fa-trash-can text-danger"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</main>

<?php require $this->checkTemplate("modal-gerar-cartoes");?>
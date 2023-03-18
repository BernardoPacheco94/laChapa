<?php if(!class_exists('Rain\Tpl')){exit;}?><main>

    <section>

        <div class="row container mx-auto">
            <h3 class="mx-auto mt-3">Comandas</h3>
        </div>

        <!-- Cadastrar comandas -->
        <!-- <form action="/salvacartoes" method="get">
            <div class="container">
                <div class="mx-auto mb-4 col-xs-6 col-sm-6 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                    <input type="number" name="inicial" id="idnuminicial" class="form-control mb-4"
                        placeholder="Número inicial">
                    <input type="number" name="final" id="idnumfinal" class="form-control" placeholder="Número final">
                </div>
            </div>

            <div class="container mx-auto col-xs-6 col-sm-6 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                <button type="submit" class="w-100 btn btn-dark">
                    Gerar Comandas
                </button>
            </div>
        </form> -->

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
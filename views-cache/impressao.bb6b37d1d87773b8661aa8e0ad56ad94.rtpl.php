<?php if(!class_exists('Rain\Tpl')){exit;}?>
<body onload="window.print()">
    <div>
        <span><?php echo htmlspecialchars( $dadosComanda["nomeatendente"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
        <span><?php echo formatDate($dadosComanda["datacomanda"]); ?></span>
    </div>
    <hr>
    <div>
        <span>Mesa: <?php echo htmlspecialchars( $dadosComanda["idmesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
        <span>Comanda <?php echo htmlspecialchars( $dadosComanda["idcartao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
    </div>
    <hr>
    <hr>
    <table>
        <thead>
            <th>Descricao</th>
            <th>Valor</th>
        </thead>
        <tbody>
            <?php $counter1=-1;  if( isset($dadosComanda["produtos"]) && ( is_array($dadosComanda["produtos"]) || $dadosComanda["produtos"] instanceof Traversable ) && sizeof($dadosComanda["produtos"]) ) foreach( $dadosComanda["produtos"] as $key1 => $value1 ){ $counter1++; ?>
            <tr>
                <td><?php echo htmlspecialchars( $value1["nomeproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <br>
                    <?php $i=0; ?>
                    <!-- Ingredientes a serem removidos -->
                    <?php $counter2=-1;  if( isset($value1["removeringrediente"]) && ( is_array($value1["removeringrediente"]) || $value1["removeringrediente"] instanceof Traversable ) && sizeof($value1["removeringrediente"]) ) foreach( $value1["removeringrediente"] as $key2 => $value2 ){ $counter2++; ?>
                    <?php $i=$counter2+1; ?>
                    <?php } ?>
                    <?php if( $i>0 ){ ?>
                    <ul class="text-start fw-normal">
                        Sem:
                        <?php $counter2=-1;  if( isset($value1["removeringrediente"]) && ( is_array($value1["removeringrediente"]) || $value1["removeringrediente"] instanceof Traversable ) && sizeof($value1["removeringrediente"]) ) foreach( $value1["removeringrediente"] as $key2 => $value2 ){ $counter2++; ?>
                        <li>
                            <?php echo htmlspecialchars( $value2["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php $i=0; ?>
                    <?php } ?>


                    <!-- Porçoes extra -->
                    <?php $counter2=-1;  if( isset($value1["porcaoextra"]) && ( is_array($value1["porcaoextra"]) || $value1["porcaoextra"] instanceof Traversable ) && sizeof($value1["porcaoextra"]) ) foreach( $value1["porcaoextra"] as $key2 => $value2 ){ $counter2++; ?>
                    <?php $i=$counter2+1; ?>
                    <?php } ?>
                    <?php if( $i>0 ){ ?>
                    <ul class="text-start fw-normal">
                        Porção extra:
                        <?php $counter2=-1;  if( isset($value1["porcaoextra"]) && ( is_array($value1["porcaoextra"]) || $value1["porcaoextra"] instanceof Traversable ) && sizeof($value1["porcaoextra"]) ) foreach( $value1["porcaoextra"] as $key2 => $value2 ){ $counter2++; ?>
                        <li>
                            <?php echo htmlspecialchars( $value2["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value2["qtdporcaoextra"], ENT_COMPAT, 'UTF-8', FALSE ); ?>x
                        </li>
                        <?php } ?>
                    </ul>
                    <?php $i=0; ?>
                    <?php } ?>

                    <!-- Ingredientes adicionais -->
                    <?php $counter2=-1;  if( isset($value1["ingredienteadicional"]) && ( is_array($value1["ingredienteadicional"]) || $value1["ingredienteadicional"] instanceof Traversable ) && sizeof($value1["ingredienteadicional"]) ) foreach( $value1["ingredienteadicional"] as $key2 => $value2 ){ $counter2++; ?>
                    <?php $i=$counter2+1; ?>
                    <?php } ?>
                    <?php if( $i>0 ){ ?>
                    <ul class="text-start fw-normal">
                        Adicional:
                        <?php $counter2=-1;  if( isset($value1["ingredienteadicional"]) && ( is_array($value1["ingredienteadicional"]) || $value1["ingredienteadicional"] instanceof Traversable ) && sizeof($value1["ingredienteadicional"]) ) foreach( $value1["ingredienteadicional"] as $key2 => $value2 ){ $counter2++; ?>
                        <li>
                            <?php echo htmlspecialchars( $value2["nomeingrediente"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value2["qtdingredienteadicional"], ENT_COMPAT, 'UTF-8', FALSE ); ?>x
                        </li>
                        <?php } ?>
                    </ul>
                    <?php $i=0; ?>
                    <?php } ?>

                    <?php if( $value1["observacao"] ){ ?>
                    <ul class="text-start fw-normal">
                        OBS:
                        <li>
                            <?php echo htmlspecialchars( $value1["observacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </li>
                    </ul>
                    <?php } ?>
                </td>
                <td>R$ <?php echo formatPrice($value1["vlfinalproduto"]); ?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>TOTAL: </th>
                <td>R$ <?php echo formatPrice($dadosComanda["valortotal"]); ?></td>
            </tr>
        </tfoot>
    </table>
</body>
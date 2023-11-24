<?php
require_once '../scr/funcoes-fabricantes.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabricantes</title>
</head>
<body>
    <div class="container">
        <h1>Fabricantes | SELECT</h1>
        <hr>
        <h2>Lendo e carregando todos os fabricantes</h2>

        <p><a href="inserir.php" style ="color:Blue;">Inserir um novo fabricante</a></p>

        <!-- __________________________________________ -->
        <!-- Trecho para exibir a mensagem se clicar botao atualizar -->
        <?php if(isset($_GET['status']) && $_GET['status'] == 'sucesso' ){?>
            <p>Fabricante atualizado com sucesso!</p>
            <?php } ?>
            <!-- ___________________________________________ -->

            <table>
                <caption>Lista de Fabricantes
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th colspan="2">Operações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        //echo "<pre>"
                        // var_dump($resultado); // Teste
                        // echo "<pre>";

        foreach($listadeFabricantes as $fabricantes) { ?>
        <tr>
            <td>  <?=$fabricante['id']?> </td>
            <td>  <?=$fabricante['nome']?> </td>
            <!-- Link dinâmico -->
            <td><a href="atualizar.php?id=<?=$fabricante['id']?>" style ="color:blue;">Atualizar</a></td>
            <td><a class="excluir" href="excluir.php?id=<?=$fabricante['id']?>" style ="color:red;">Excluir</a></td>

            <!-- Solução mais simples para perguntar antes de excluir -->
            <!-- Colocacar depois do <a:onclick="return confirm('Deseja excluir o item ?')" -->

            </tr>

            <?php } ?>

                        
            </tbody>
        </table>
    </div>

    <!-- Chamando arquivo js para perguntar antes de excluir -->
    <script scr="../js/confirm.js"></script>
    
</body>
</html>
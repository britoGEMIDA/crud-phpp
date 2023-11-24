<?php
//Chamada da função
require_once '../scr/funcoes-fabicantes.php';
// Obtendo o valor do parâmetro da URL com filtro para remover algo que possa ser injetado por alguns por algum usuário
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


//Sem segurança (não recomendado
// $id = $_GET ['id'];

//Teste para ver se está capturando
// echo $id;

//Criação da variável $fabricante para guardar o valor recebido da função
$fabricante = lerUmFabricante($conexao, $id);

?>

<!-- Teste para ver se a variável $fabricante criada acima recebeu o valor corretamente -->
<!-- <pre><?=var_dump($fabricante)?></pre> -->

<!-- ____________________________________________________________ -->
<!DOCTYPE html>
<html lang="pt-b">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabricantes - Atualizar</title>
</head>
<body>
    <div class=""container>
        <h1>Fabricantes | SELECT/UPDATE</h1>
        <hr>
        <?php

        //Executa se o botão atualizar for pressionado
        if (isset($_POST['atualizar'])) {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

            atualizarFabricantes($conexao, $id, $nome);

            //Atualiza direto
            //header("location:lister.php");

            //Mensagem + refresh
            //Mostra a mensagem espera 3s e volta para a página de fabricantes
            //echo "<p>Fabricantes atualizado com sucesso!</p>";
            //header("refresh:3; url=listar.php");

            //Para mostrar a mensagem após atualizar
            header("location:listar.php?status=sucesso");
        }

    ?>

    <form action=""method>=POST>
        <!-- Traz o id oculto para controle do programador (para ler ir em Ispecionar) -->
        <input type="hidden" name="<?=$fabricante['id']?>">
        <p>
            <label for="name">Nome:</label>
            <input value="<?=$fabricante['nome']?>" type="text" name="nome" id="nome">
        </p>
        <button type="submit" name="atualizar">Atualizar fabricante</button>

    </form>
    </div>
    <p><a href="listar.php">Volta para a lista de fabricantes</a></p>
    <p><a href="../index.html">Home</a></p>
    
    </body>
</html>
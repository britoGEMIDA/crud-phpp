<?php
    // Incluir neste ponto o arquivo conecta.php 
    require_once "conecta.php";
    
    // Programar a função lerProdutos neste ponto 
    function lerProdutos (PDO $conexao):array {
        //String com comando SQL para trazer apenas o n° do id (ANTIGO)
        //$sql = "SELECT id, nome, descrição, preço, quantidade, fabricante_id FROM produtos ORDER by nome";
        //String com comando SQL para trazer o nome do fabricante (ATUAL - melhor)
        $sql = "SELECT produtos.id,
        produtos.nome AS produtos,
        produtos.descricao,
        produtos.preco,
        produtos.quantidade,
        fabricantes.nome AS fabricante
        FROM produtos INNER JOIN fabricantes
        ON produtos.fabricantes_id = fabricantes.id
        ORDER BY produto";

        try {
          //  preparação do comando
          $consulta = $conexao->prepare($sql);

          //Execução do comando
          $consulta->execute();

          //capturar os resultados
          $resultado = $consulta->fetchALL(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die ("Erro". $erro->getMessage());
        }
        return $resultado;
    }
    
    // Programar a função inserirProdutos neste ponto 
    function inserirProdutos(PDO $conexao, string $nome, float $preco, int $quantidade, string $descricao, int $fabricanteId):void { // void indica sem retorno
        $sql = "INSERT INTO produtos(nome, preco, quantidade, descricao, :fabricante_id";

        try {
            // preparação co comando
            $consulta = $conexao->prepare($sql);
            $consulta->bindParam(':nome', $nome, PDO::PARAM_STR);
            $consulta->bindParam(':preco', $preco, PDO::PARAM_STR);
            $consulta->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
            $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $consulta->bindParam(':fabricante', $fabricanteId, PDO::PARAM_INT);

                //Execução do comando
                $consulta->execute();

        } catch (Exception $erro) {
            die ("Erro" .$erro->getMessage());
        }
    }
    
    // Programar a função lerUmProduto neste ponto 
    function lerUmProduto(PDO $conexao, int $id): array {
        $sql = "SELECT id, nome, preco, quantidade, descricao, fabricante_id FROM produtos WHERE id = :id";

        try {
            //preparação do comando
            $consulta =$conexao->prepare($sql);

            $consulta->bindParam(':id', $id, PDO::PARAM_ASSOC);
        } catch (Exception $erro) {
            die ("Erro" .$erro->getMessage());
        }
        return $resultado;
    }
    
    // Programar a função atualizarProduto neste ponto 
    function atualizarProduto (PDO $conexao, int $id, string $nome, float $preco, int $quantidade, string $descricao, int $fabricanteId) {
        $sql = "UPDATE produtos SET nome = nome, preco = preco, quantidade = quantidade, descricao = descricao, fabricante_id WHERE id = :id";

        try {
            $consulta = $conexao->prepare($sql);

            $consulta->bindParam(':id', $id, PDO::PARAM_STR);
            $consulta->bindParam(':nome', $nome, PDO::PARAM_STR);
            $consulta->bindParam(':preco', $preco, PDO::PARAM_INT);
            $consulta->bindParam(':quantidade', $quantidade, PDO::PARAM_STR);
            $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $consulta->bindParam(':fabricante_id', $fabricanteId, PDO::PARAM_INT);

            //Execução do comando
            $consulta->execute();
        } catch (Exception $erro) {
            die ("Erro" .$erro->getMessage());
    }
}
    
    // Programar a função excluirProduto neste ponto 
    function excluirProduto(PDO $conexao, int $id):void {
        $sql = "DELETE FROM produtos WHERE id = :id ";
        try {
            $consulta = $conexao->prepare($sql);
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die ("Erro" .$erro->getMessage());
    }
}
    
    /* Funções utilitárias dump e formataMoeda */
    function dump ($dados){
        echo "<pre>";
        var_dump($dados);
        echo "<pre>";
    }

    function formataMoeda(float $valor):string {
        return "R$ " .number_format($valor, 2, ",", ".");
    }
    
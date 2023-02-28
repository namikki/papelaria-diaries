<?php

    $servidor = "localhost";
    $admin = "***";
    $senha = "***";
    $banco = "papelariadiaries";

    $BD = new mysqli($servidor, $admin, $senha, $banco);

    if($BD){
        //Insere_Dados($BD);
        Consulta_Dados($BD);
    }
    else{
        $msg_erro = $BD->connect_errno;
        echo "Conexão com o BD falhou: " . $msg_erro;
    }
    $BD->close();

    function Consulta_Dados($p_Conexao_BD){
        $sql = "select * from produto;";
        $REGISTROS = $p_Conexao_BD->query($sql);

        while( $registro = $REGISTROS->fetch_assoc() ){

            //o método "fetch_assoc()" retorna um registro da lista de REGISTROS
            //formatado como um vetor, onde o índice é o nome da coluna
            //$registro["XP_Produto"].....
            //a cada iteração, retorna um novo registro
            echo "XP: " . $registro["xp_produto"]. " - Nome: " . $registro["Nome"] . " - Preço: " . $registro["Preco"]. " - Categoria: " . $registro["Categoria"]. " - Marca: " . $registro["Marca"]. " - Tipo: " . $registro["Tipo"] . "<br>";
            //.. 
        }
        echo"<hr>Fim dos dados.<hr>";
    }

?>
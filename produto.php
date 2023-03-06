<?php
include 'doc_html.php';

    $servidor = "localhost";
    $admin = "****";
    $senha = "****";
    $banco = "papelariadiaries";

    $BD = new mysqli($servidor, $admin, $senha, $banco);

    if($BD){
        if(count($_POST) > 0){
            Insere_Dados($BD);
        }
        $formulario = Exibe_Formulario();
        $consulta = Consulta_Dados($BD);

        echo Monta_Doc_HTML( $formulario . "<hr>" . $consulta);
        echo "<hr>POST: <br><pre>"; print_r($_POST); echo "</pre>";
        Consulta_Dados($BD);
    }
    else{
        $msg_erro = $BD->connect_errno;
        echo "Conexão com o BD falhou: " . $msg_erro;
    }
    $BD->close();

    function Exibe_Formulario(){
        $form = "";
        $form .= "<form action='produto.php' method='post'>";
        $form .= "Nome: <input type='text' name='Nome'><br>";
        $form .= "Preço: <input type='text' name='Preco'><br>";
        $form .= "Categoria: <input type='text' name='Categoria'><select>
                <option>Organização</option>
                <option>Cadernos e Fichários</option>
                <option>Canetas em Gel</option>
            </select><br>";
        $form .= "Marca: <input type='text' name='Marca'><select>
                <option>Faber-Castell</option>
                <option>Stabillo</option>
                <option>Zebra</option>
            </select><br> ";
        $form .= "Tipo: <input type='text' name='Tipo'><select>
                <option>Escolar</option>
                <option>Escritório</option>
                <option>Universitário</option>       
            </select><br>";
        $form .= "<input type='submit' value='Enviar'>";
        $form .= "<input type='reset' value='Cancelar'>";
        $form .= "</form>";
        return $form;          
    }

    function Consulta_Dados($p_Conexao_BD){
        $sql = "select * from produto;";
        $REGISTROS = $p_Conexao_BD->query($sql);
        $listagem .= "<hr>Listagem dos dados<hr>";
        while( $registro = $REGISTROS->fetch_assoc() ){
            $listagem .= "XP: " . $registro["xp_produto"]. " - Nome: " . $registro["Nome"] ." - Preço: " . $registro["Preco"]. " - Categoria: " . $registro["Categoria"]. " - Marca: " . $registro["Marca"]. " - Tipo: " . $registro["Tipo"] ."<br>"; 
        }
        $listagem .= "<hr>Fim dos dados.<hr>";
        return $listagem;
    }

    function Insere_Dados($p_Conexao_BD){
        $Nome = 'Cola';
        $Preco = 9.99;
        $Categoria = 'Organização';
        $Marca = 'Pritt';
        $Tipo = 'Escolar';

        $sql = "insert into produto (xp_produto, Nome, Preco, Categoria, Marca, Tipo) values (?,?,?,?,?,?);";
        
        $comando = $p_Conexao_BD->prepare( $sql);
        $comando->bind_param("sdsss",$Nome,$Preco,$Categoria,$Marca,$Tipo);
        $comando->execute();
    }

?>

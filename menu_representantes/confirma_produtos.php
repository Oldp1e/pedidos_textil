<?php    
	session_start();
    if(is_null($_SESSION['online'])){
        echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';
	}		

    
    $username = $_SESSION['user'];

    if(isset($_POST['end_entrega_cliente'])){
        //var_dump($_POST['end_entrega_cliente']);
        $_SESSION['checkbox_end_entrega_cliente'] = $_POST['end_entrega_cliente'];
        $_SESSION['id_cliente'] = $_POST['id_cliente']; // USADO NO TRANSPORTE TODO ESSE TRECHO USADO NO TRANSPORTE
    }



	INCLUDE '/pedidos_textil/pathing.php';  // -> Página com todos os diretórios do Site
	INCLUDE $childDirectory.$dblogin; // -> Pagína de Conexão com o Banco de dados
	INCLUDE $childDirectory.$functions;// -> Página de Funções do Site
    $number = count($_POST["artigo"]);
    $connect = OpenCon();
    $ID_CLIENTE = $_POST['id_cliente'];
    $permite_cadastro = false;
    $pedido_finalizado = false;
    if($number > 0 && isset($_POST["artigo"]) && isset($_POST["desenho"]) && isset($_POST["variante"]) && isset($_POST["quantidade"]) && isset($_POST["valor"]) ){
        for($i=0; $i < $number; $i++){
            if(trim($_POST["artigo"][$i] != 'nulo') && trim($_POST["valor"][$i] != '') && trim($_POST["quantidade"][$i] != '')){
                $permite_cadastro = true;
            }else{
                echo "PREENCHA TODOS OS CAMPOS";
                $permite_cadastro = false;
            }
    }

    if($permite_cadastro == true){
        $sqli = "SELECT ID_Pedido FROM pedidos ORDER BY CAST(id_pedido AS UNSIGNED) DESC LIMIT 1;";
                $result = mysqli_query(OpenCon(), $sqli);
                while ($row = mysqli_fetch_array($result)) {
                $ULTIMO_PEDIDO = $row['ID_Pedido'];
                }
                if(isset($ULTIMO_PEDIDO)){
                    $pedido_atual = $ULTIMO_PEDIDO + 1;
                }else{
                    $pedido_atual = 1;
                }
                

                abrePedido($ID_CLIENTE,$username,$pedido_atual);
    }
        



      for($i=0; $i < $number; $i++){
        if(trim(utf8_encode($_POST["artigo"][$i]) != 'nulo') && trim($_POST["valor"][$i] != '') && trim($_POST["quantidade"][$i] != '')){
            $sqli = "SELECT ID_Pedido FROM pedidos WHERE status_pedido='abrindo' AND username='$username'";
            $result = mysqli_query(OpenCon(), $sqli);
            while ($row = mysqli_fetch_array($result)) {
            $id_pedido_abrindo = $row['ID_Pedido'];
            }
            $artigo[] = utf8_encode($_POST["artigo"][$i]);
            $sqli = "SELECT * FROM produtos WHERE artigo='".$artigo[$i]."'";           
            $result = mysqli_query(OpenCon(), $sqli);
            while ($row = mysqli_fetch_array($result)) {
            $id_produto[] = $row['ID_Produto'];
            $cod_prod[] = $row['COD_Prod'];
            }
            if($result === false){
                echo "Erro: " . $sqli . " " . OpenCon()->error;
            }
            $total[$i] = $_POST['quantidade'][$i] * $_POST['valor'][$i];
            $sql = "INSERT INTO produtos_pedido(ID_Pedido,ID_Produto,quant,preco_unit,total,desenho,variante,colecao) VALUES($id_pedido_abrindo,".$id_produto[$i].",".$_POST["quantidade"][$i].",".$_POST["valor"][$i].",".$total[$i].",'".$_POST['desenho'][$i]."','".$_POST["variante"][$i]."','".$_POST['colecao'][$i]."')";
            if (OpenCon()->query($sql) === TRUE){
                // echo "Inserido Produtos do Pedido".$id_pedido_abrindo;
                // echo "Pedido Aberto e Produtos Inseridos ao Pedido";
            } else {
                echo "Erro: " . $sql . " " . OpenCon()->error;
            }//Fim da Abertura de Conexao e inserção dos dados
            
           



        }
                // Check connection
        if (OpenCon()->connect_error) {
            die("Connection failed: " . OpenCon()->connect_error);
        }
        
        if($permite_cadastro){
            $sql = "UPDATE pedidos SET status_pedido='em aberto' WHERE ID_Pedido=$id_pedido_abrindo";
            //ARRUMAR ESTE TRECHO IMPEDE DE CADASTRAR MULTIPLOS PRODUTOS
            if (OpenCon()->query($sql) === TRUE) {
                $pedido_finalizado = true;
                $_SESSION['id_pedido'] = $id_pedido_abrindo;
            } else {
                echo "Error updating record: " . OpenCon()->error;
            }
        $sqli = "SELECT SUM(total) AS value_sum FROM produtos_pedido WHERE id_pedido=$id_pedido_abrindo";
        $result = mysqli_query(OpenCon(), 'SELECT SUM(total) AS value_sum FROM produtos_pedido WHERE id_pedido='.$id_pedido_abrindo.''); 
        $row = mysqli_fetch_assoc($result); 
        $sum = $row['value_sum'];

        $sql = "UPDATE pedidos SET valor_total=$sum WHERE ID_Pedido=$id_pedido_abrindo";
        //ARRUMAR ESTE TRECHO IMPEDE DE CADASTRAR MULTIPLOS PRODUTOS
        if (OpenCon()->query($sql) === TRUE) {
        } else {
            echo "Error updating record: " . OpenCon()->error;
        }



        }

        
        



      }
    }else{
        echo "PREENCHA TODOS OS CAMPOS";
    }
    

    

    function abrePedido($ID_CLIENTE,$username,$id_pedido){        
        $sql = "INSERT INTO pedidos(ID_Pedido,ID_Cliente,status_pedido,username) VALUES($id_pedido,$ID_CLIENTE,'abrindo','$username')";
            if (OpenCon()->query($sql) === TRUE){
                // echo "Inserido ID_Cliente";
                // echo "Pedido Aberto";
            } else {
                echo "<br>Erro: " . $sql . " " . OpenCon()->error;
            }//Fim da Abertura de Conexao e inserção dos dados              
    }


    if($pedido_finalizado){
        echo "\r\nPedido aberto com sucesso o ID de Seu Pedido é o ".$id_pedido_abrindo."\r\nProssiga para a pagina com endereço de entrega.";
    }

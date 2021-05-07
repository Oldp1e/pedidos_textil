<?php
	session_start();
    if(is_null($_SESSION['online'])){
        echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';
	}		

    $username = $_SESSION['user'];
	INCLUDE '/pedidos_textil/pathing.php';  // -> Página com todos os diretórios do Site
	INCLUDE $childDirectory.$dblogin; // -> Pagína de Conexão com o Banco de dados
	INCLUDE $childDirectory.$functions;// -> Página de Funções do Site



    if(isset($_SESSION['id_pedido']))	
    $id_pedido = $_SESSION['id_pedido'] ;
    if(isset($_GET['id_pedido']) && !isset($_SESSION['id_pedido'])){
        $id_pedido = $_GET['id_pedido'];
    }	
    if(isset($_POST['id_pedido']) && !isset($_SESSION['id_pedido'])){
        $id_pedido = $_POST['id_pedido'];
    }	

    if(isset($_FILES['file'])){
       echo 'FILE SET UPLOADED';
        //Define um nome aleatório para a inserção do ID de Anexo do Pedido inserido no banco
        $pname = rand(100,10000)."-".$_FILES['file']['name'];
    
        $tname = $_FILES['file']['tmp_name'];
        $uploads_dir = './document';
    
        move_uploaded_file($tname, $uploads_dir.'/'.$pname);
    
      }
    

 
	if(isset($_SESSION['checkbox_end_entrega_cliente']))	
	unset($_SESSION['checkbox_end_entrega_cliente']);
	if(isset($_SESSION['id_cliente']))	
	unset($_SESSION['id_cliente']);

date_default_timezone_set("America/Sao_Paulo");

if(isset($_POST['cnpj']) && isset($_POST['transp']) && isset($_POST['end_entrega']) && isset($_POST['end_cobranca'])){


    $cnpj = $_POST['cnpj'];
    $nome_local_entrega = $_POST['nome_local_entrega'];
    $transportadora = $_POST['transp'];
    $end_entrega = $_POST['uf_entrega'].' '.$_POST['cidade_entrega'].' '.$_POST['bairro_entrega'].' '.$_POST['end_entrega'].' '.$_POST['CEP_entrega'].$_POST['logradouro_entrega'];
    $end_cobranca = $_POST['cidade_cobranca'].' '.$_POST['uf_cobranca'].' '.$_POST['bairro_cobranca'].' '.$_POST['end_cobranca'].' '.$_POST['CEP_cobranca'].''.$_POST['logradouro_cobranca'];
    $pedido_finalizado = false;
    if(isset($pname)){
        $sql = "INSERT INTO transporte(CNPJ,nome_local_entrega,ID_Pedido,End_Entrega,End_Cobranca,nome_transp,anexo) VALUES ('$cnpj','$nome_local_entrega','$id_pedido','$end_entrega','$end_cobranca','$transportadora','$pname')";
    }else{
        $sql = "INSERT INTO transporte(CNPJ,nome_local_entrega,ID_Pedido,End_Entrega,End_Cobranca,nome_transp) VALUES ('$cnpj','$nome_local_entrega','$id_pedido','$end_entrega','$end_cobranca','$transportadora')";
    }
    
    if (OpenCon()->query($sql) === TRUE){
        // echo "Inserido Produtos do Pedido".$id_pedido_abrindo;
        // echo "Pedido Aberto e Produtos Inseridos ao Pedido";
        $data_hoje = date("y-m-d");
        $hora_atual = date("h:i:sa");          
        $pedido_finalizado = true;
    } else {
        echo "Erro: " . $sql . " " . OpenCon()->error;
    }//Fim da Abertura de Conexao e inserção dos dados  


    if($pedido_finalizado){

        $sqli = "SELECT id_transport FROM transporte WHERE ID_Pedido='$id_pedido'";
        $result = mysqli_query(OpenCon(), $sqli);
        while ($row = mysqli_fetch_array($result)) {
        $id_transporte = $row['id_transport'];
        }

        $username = $_SESSION['user'];
        $sqli = "SELECT id_usuario FROM usuarios WHERE username='$username'";
        $result = mysqli_query(OpenCon(), $sqli);
        while ($row = mysqli_fetch_array($result)) {
        $id_usuario = $row['id_usuario'];
        }
        
        $sql = "INSERT INTO fechamento_pedido(id_pedido,id_transport,DATA_FECH,HORA_FECH,id_usuario) VALUES ('$id_pedido','$id_transporte', now(),'$hora_atual','$id_usuario')";
    if (OpenCon()->query($sql) === TRUE){
        // echo "Inserido Produtos do Pedido".$id_pedido_abrindo;
        // echo "Pedido Aberto e Produtos Inseridos ao Pedido";        
    } else {
        echo "Erro: " . $sql . " " . OpenCon()->error;
    }//Fim da Abertura de Conexao e inserção dos dados  

    $sql = "UPDATE pedidos SET status_pedido='finalizado' WHERE ID_Pedido=$id_pedido";
            //ARRUMAR ESTE TRECHO IMPEDE DE CADASTRAR MULTIPLOS PRODUTOS
            if (OpenCon()->query($sql) === TRUE) {
                $pedido_finalizado = true;
                echo "Pedido Finalizado, a Data do Pedido é: ".date("d/m/Y")." a hora do Fechamento é ".date("h:i:sa")." o Número de Seu pedido é ".$id_pedido;
                sendMailToManager('email@email.com',$id_pedido,$username);
            } else {
                echo "Error updating record: " . OpenCon()->error;
            }
    
    }
    
}else if(isset($_POST['mesmoCNPJ'])){

    $cnpj = $_POST['CNPJ'];
    $nome_local_entrega = $_POST['nome_cliente'];
    $transportadora = $_POST['transp'];
    $end_entrega = $_POST['ESTADO'].' '.$_POST['MUNICIPIO'].' '.$_POST['BAIRRO'].' '.$_POST['endereco'].' '.$_POST['CEP'];
    $end_cobranca = $_POST['ESTADO'].' '.$_POST['MUNICIPIO'].' '.$_POST['BAIRRO'].' '.$_POST['endereco'].' '.$_POST['CEP'];
    $obs=$_POST['obs'];
    $cond_pag=$_POST['cond_pag'];
    $n_pedido=$_POST['n_pedido'];
    $pedido_finalizado = false;
    if(isset($pname)){
        $sql = "INSERT INTO transporte(CNPJ,nome_local_entrega,ID_Pedido,End_Entrega,End_Cobranca,nome_transp,obs,n_pedido, cond_pag, anexo) VALUES ('$cnpj','$nome_local_entrega','$id_pedido','$end_entrega','$end_cobranca','$transportadora','$obs','$n_pedido','$cond_pag','$pname')";
    }else{
        $sql = "INSERT INTO transporte(CNPJ,nome_local_entrega,ID_Pedido,End_Entrega,End_Cobranca,nome_transp,obs,n_pedido, cond_pag) VALUES ('$cnpj','$nome_local_entrega','$id_pedido','$end_entrega','$end_cobranca','$transportadora','$obs','$n_pedido','$cond_pag')";
    }    
    if (OpenCon()->query($sql) === TRUE){
        // echo "Inserido Produtos do Pedido".$id_pedido_abrindo;
        // echo "Pedido Aberto e Produtos Inseridos ao Pedido";
        $data_hoje = date("y-m-d");
        $hora_atual = date("h:i:sa");          
        $pedido_finalizado = true;
    } else {
        echo "Erro: " . $sql . " " . OpenCon()->error;
    }//Fim da Abertura de Conexao e inserção dos dados  


    if($pedido_finalizado){

        $sqli = "SELECT id_transport FROM transporte WHERE ID_Pedido='$id_pedido'";
        $result = mysqli_query(OpenCon(), $sqli);
        while ($row = mysqli_fetch_array($result)) {
        $id_transporte = $row['id_transport'];
        }

        $username = $_SESSION['user'];
        $sqli = "SELECT id_usuario FROM usuarios WHERE username='$username'";
        $result = mysqli_query(OpenCon(), $sqli);
        while ($row = mysqli_fetch_array($result)) {
        $id_usuario = $row['id_usuario'];
        }
        
        $sql = "INSERT INTO fechamento_pedido(id_pedido,id_transport,DATA_FECH,HORA_FECH,id_usuario) VALUES ('$id_pedido','$id_transporte', now(),'$hora_atual','$id_usuario')";
    if (OpenCon()->query($sql) === TRUE){
        // echo "Inserido Produtos do Pedido".$id_pedido_abrindo;
        // echo "Pedido Aberto e Produtos Inseridos ao Pedido";        
    } else {
        echo "Erro: " . $sql . " " . OpenCon()->error;
    }//Fim da Abertura de Conexao e inserção dos dados  

    $sql = "UPDATE pedidos SET status_pedido='finalizado' WHERE ID_Pedido=$id_pedido";
            //ARRUMAR ESTE TRECHO IMPEDE DE CADASTRAR MULTIPLOS PRODUTOS
            if (OpenCon()->query($sql) === TRUE) {                
                $pedido_finalizado = true;

                //Seleciona os emails de encaminhamento do Banco de Dados
                $sqli = "SELECT email_enc_1, email_enc_2 FROM usuarios WHERE id_usuario='".$id_usuario."'";
                $result = mysqli_query(OpenCon(), $sqli);
                while($row = mysqli_fetch_array($result)){
                    $email_enc_1 = $row["email_enc_1"];
                    $email_enc_2 = $row["email_enc_2"];
                }
                    sendMailToManager($email_enc_1,$email_enc_2,$id_pedido,$username, $cnpj, $end_entrega, $obs);                                                    
                echo "Pedido Finalizado, a Data do Pedido é: ".date("d/m/Y")." a hora do Fechamento é ".date("h:i:sa")." o Número de Seu pedido é ".$id_pedido;
            } else {
                echo "Error updating record: " . OpenCon()->error;
            }
    }
}
?>
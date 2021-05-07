<?php 
    session_start();
//Alterado o Session Start para o começo da Pagina devido ao seguinte erro no Debug no dia 05/04/2021 09:53

        //INCLUDE 'dblogin.php';

        function isEmpty($input) 
        {               
            $strTemp = $input;
            $strTemp = trim($strTemp);

            if($strTemp !== '')
            {
                return true;
            }else{
                return false;
            }            
        }

        function DebugLog($debugMessage){

            echo '<br> System Debug diz: ( '.$debugMessage.' )';
            
        }

        function DebugLogError($debugMessage){

            echo '<br> System Debug diz: ERRO ( '.$debugMessage.' )';
            
        }

        function ReceivePosts($postName){



        }
            

        //Cadastro e Inserção de Usuario
        function InsereUsuario(){
                //_________________________________________________________________________________________________________
                //
                // CADASTRO DE USUARIO
                //_________________________________________________________________________________________________________        
                
                //Validação de Existencia de usuario no sistema

                // Campos Obrigatorios
                $required = array('username', 'password', 'email');

                // Loop sobre todos os POST's dos campos de cadastro
                $error = false;
                foreach($required as $field) {
                    if (empty($_POST[$field])) {//Caso esteja vazio seta a variavel $error = true
                        $error = true;
                    }
                }

                if ($error) {
                echo "Preencha todos os campos.";
                }else{//Caso todos os campos estejam preenchidos prossegue com o cadastro
                    DebugLog("Campos Preenchidos Prosseguindo...");

                    //Checa se as variaveis de Post estão Set
                    if((!isset($_POST['username']) && !isset($_POST['password']) && !isset($_POST['email']) && !isset($_POST['nivel_perm']))){
                        echo 'Por favor complete todos os campos';
                    }else{//Caso estejam Set prossegue com o Cadastro 
                            //Define as váriaveis que serão utilizadas na inserção
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $email = $_POST['email'];
                            $nivel_perm = $_POST['nivel_perm'];

                            //Debug Line
                            DebugLog(' Variavel User('.$username.') Senha('.$password.') Email('.$email.')');

                            $sql = "SELECT username FROM usuarios WHERE (username='$username' OR email='$email')";
                            $result = OpenCon()->query($sql);
                            
                            if ($result->num_rows > 0) {            
                                while($row = $result->fetch_assoc()) {
                                //$username = $row["username"];
                                DebugLog('Usuario já cadastrado com o mesmo email ou nome de usuario');
                                }
                            }else{
                                DebugLog("Não existe ninguem cadastrado com este nome Prosseguindo com cadastro");
                                $permite_cadastro = true;//Permite a inclusao do cadastro
                            }            
                            //FIM VALIDAÇÃO
                            //Validação se irá Permitir a inclusão do novo usuario no banco
                            if(isset($permite_cadastro) && $permite_cadastro==true){
                                sendMailToNewUser($email,$nivel_perm, $username, $password);
                                $sql = "INSERT INTO usuarios(nivel_perm, username, password, email)
                                        VALUES ('$nivel_perm','$username','$password','$email')";

                                        
                                if (OpenCon()->query($sql) === TRUE){
                                    DebugLog("Cadastrado");
                                    echo "<p>
                                        <h2>Usuario cadastrado</h2>
                                        </p>";
                                    echo "<form>
                                    <input type='button' value='Voltar' onclick='history.back()'>
                                </form>";
                                } else {
                                    echo "<br>Erro: " . $sql . "<br>" . OpenCon()->error;
                                }//Fim da Abertura de Conexao e inserção dos dados    
                            }//Fim do Check de Validação de Permissao de cadastro
                    }//Fim do Check se as variaveis de POST estão set's
                }//Fim do Check de Post's Vazios
        }//Fim da Função InsereUsuario()

        //Cadastro e Inserção de Cliente
        function InsereCliente(){
                //_________________________________________________________________________________________________________
                //
                // CADASTRO DE CLIENTE
                //_________________________________________________________________________________________________________        
                
                //Validação de Existencia de Clinte no sistema

                // Campos Obrigatorios 
                //Alteração nos Campos Obrigatórios 05-04-2021 09:39 - Criado nova Função para os Registros de Novo Pedido
                // $required = array('nome', 'cnpj', 'endereco','cep','estado','municipio','bairro','fone','inscricao_estadual');
                $required = array('nome', 'cnpj','inscricao_estadual');

                // Loop sobre todos os POST's dos campos de cadastro
                $error = false;
                foreach($required as $field) {
                    if (empty($_POST[$field])) {//Caso esteja vazio seta a variavel $error = true
                        $error = true;
                    }
                }

                if ($error) {
                echo "Preencha todos os campos.";
                }else{//Caso todos os campos estejam preenchidos prossegue com o cadastro
                    DebugLog("Campos Preenchidos Prosseguindo...");

                    //Checa se as variaveis de Post estão Set
                    if((!isset($_POST['nome']) && !isset($_POST['cnpj']) && !isset($_POST['endereco']) && !isset($_POST['estado']) && !isset($_POST['municipio']) && !isset($_POST['bairro']) && !isset($_POST['fone']) && !isset($_POST['inscricao_estadual']) && !isset($_POST['cep']))){
                        echo 'Por favor complete todos os campos';
                    }else{//Caso estejam Set prossegue com o Cadastro 
                            //Define as váriaveis que serão utilizadas na inserção
                            $nome = $_POST['nome'];
                            $cnpj = $_POST['cnpj'];
                            $endereco = $_POST['endereco'];
                            $bairro = $_POST['bairro'];
                            $municipio = $_POST['municipio'];
                            $fone = $_POST['fone'];
                            $inscricao_estadual = $_POST['inscricao_estadual'];
                            $cep = $_POST['cep'];
                            $estado = $_POST['estado'];

                            //Debug Line
                            //DebugLog(' Variavel nome('.$nome.') cnpj('.$cnpj.') endereco('.$endereco.') bairro('.$bairro .') municipio('.$municipio.') fone('.$fone.') inscricao_estadual('.$inscricao_estadual.') cep('.$cep.') estado('.$estado.')');

                            $sql = "SELECT CNPJ, nome_cliente FROM clientes WHERE (CNPJ='$cnpj' OR nome_cliente='$nome')";
                            $result = OpenCon()->query($sql);
                            
                            if ($result->num_rows > 0) {            
                                while($row = $result->fetch_assoc()) {
                                //$username = $row["username"];
                                DebugLog('Cliente já cadastrado com este cnpj e/ou nome.');
                                }
                            }else{
                                DebugLog("Não existe ninguem cadastrado com este CNPJ e/ou Nome Prosseguindo com cadastro");
                                $permite_cadastro = true;//Permite a inclusao do cadastro
                            }            
                            //FIM VALIDAÇÃO

                            //SELECIONA O USUARIO ATUAL
                            
                            $currentUser = $_SESSION['user'];
                            DebugLog('O Usuario atual é '.$_SESSION['user']);
                            $sql = "SELECT id_usuario FROM usuarios WHERE (username = '$currentUser')";
                            $result = OpenCon()->query($sql);
                            
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                  $id_usuario_atual = $row['id_usuario'];
                                  DebugLog('O ID do Usuario atual é ('.$id_usuario_atual.')');
                                }
                              } else {
                                echo "Nao foi encontrado usuario para este ID";
                              }                                                                                   
                                
                             //FIM DE SELECAO DO USUARIO ATUAL

                            //Validação se irá Permitir a inclusão do novo usuario no banco
                            if(isset($permite_cadastro) && $permite_cadastro==true){                                
   
                                $sql = "INSERT INTO clientes(nome_cliente, endereco, CEP, MUNICIPIO, BAIRRO, ESTADO, FONE, CNPJ, insc_est, id_usuario)
                                        VALUES ('$nome','$endereco','$cep','$municipio','$bairro','$estado','$fone','$cnpj','$inscricao_estadual', '$id_usuario_atual')";

                                        
                                if (OpenCon()->query($sql) === TRUE){
                                    DebugLog("Cadastrado");
                                    echo "<p>
                                        <h2>Clientes cadastrado</h2>
                                        </p>";
                                    echo "<form>
                                    <input type='button' value='Voltar' onclick='history.back()'>
                                </form>";
                                } else {
                                    echo "<br>Erro: " . $sql . "<br>" . OpenCon()->error;
                                }//Fim da Abertura de Conexao e inserção dos dados    
                            }//Fim do Check de Validação de Permissao de cadastro
                    }//Fim do Check se as variaveis de POST estão set's
                }//Fim do Check de Post's Vazios
        }//Fim da Função InsereCliente()



        //Cadastro e Inserção de Cliente a Partir da Area de Novos Pedidos - Funcao criada no dia 05/04/2021 as 11:10
        function InsereClienteNovoRegistro(){
            //_________________________________________________________________________________________________________
            //
            // CADASTRO DE CLIENTE COMO NOVO REGISTRO NA PAGINA DE NOVOS PEDIDOS
            //_________________________________________________________________________________________________________        
            
            //Validação de Existencia de Clinte no sistema

            // Campos Obrigatorios 
            //Alteração nos Campos Obrigatórios 05-04-2021 09:39 - Criado nova Função para os Registros de Novo Pedido
            // $required = array('nome', 'cnpj', 'endereco','cep','estado','municipio','bairro','fone','inscricao_estadual');
            $required = array('nome', 'cnpj');

            // Loop sobre todos os POST's dos campos de cadastro
            $error = false;
            foreach($required as $field) {
                if (empty($_POST[$field])) {//Caso esteja vazio seta a variavel $error = true
                    $error = true;
                }
            }

            if ($error) {
            echo "Preencha todos os campos.";
            }else{//Caso todos os campos estejam preenchidos prossegue com o cadastro
                //DebugLog("Campos Preenchidos Prosseguindo...");

                //Checa se as variaveis de Post estão Set
                if(!isset($_POST['nome']) && !isset($_POST['cnpj'])){
                    echo 'Por favor complete todos os campos';
                }else{//Caso estejam Set prossegue com o Cadastro 
                        //Define as váriaveis que serão utilizadas na inserção
                        $nome = $_POST['nome'];
                        $cnpj = $_POST['cnpj'];

                        //Debug Line
                        //DebugLog(' Variavel nome('.$nome.') cnpj('.$cnpj.') endereco('.$endereco.') bairro('.$bairro .') municipio('.$municipio.') fone('.$fone.') inscricao_estadual('.$inscricao_estadual.') cep('.$cep.') estado('.$estado.')');

                        $sql = "SELECT CNPJ, nome_cliente FROM clientes WHERE (CNPJ='$cnpj' OR nome_cliente='$nome')";
                        $result = OpenCon()->query($sql);
                        
                        if ($result->num_rows > 0) {            
                            while($row = $result->fetch_assoc()) {
                            //$username = $row["username"];
                            DebugLog('Cliente já cadastrado com este cnpj e/ou nome.');
                            }
                        }else{
                            //DebugLog("Não existe ninguem cadastrado com este CNPJ e/ou Nome Prosseguindo com cadastro");
                            $permite_cadastro = true;//Permite a inclusao do cadastro
                        }            
                        //FIM VALIDAÇÃO

                        //SELECIONA O USUARIO ATUAL
                        
                        $currentUser = $_SESSION['user'];
                        //DebugLog('O Usuario atual é '.$_SESSION['user']);
                        $sql = "SELECT id_usuario FROM usuarios WHERE (username = '$currentUser')";
                        $result = OpenCon()->query($sql);
                        
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                              $id_usuario_atual = $row['id_usuario'];
                              //DebugLog('O ID do Usuario atual é ('.$id_usuario_atual.')');
                            }
                          } else {
                            echo "Nao foi encontrado usuario para este ID";
                          }                                                                                   
                            
                         //FIM DE SELECAO DO USUARIO ATUAL

                        //Validação se irá Permitir a inclusão do novo usuario no banco
                        if(isset($permite_cadastro) && $permite_cadastro==true){                                

                            $sql = "INSERT INTO clientes(nome_cliente, CNPJ, id_usuario, username)
                                    VALUES ('$nome','$cnpj','$id_usuario_atual','$currentUser')";

                                    
                            if (OpenCon()->query($sql) === TRUE){
                                //DebugLog("Cadastrado");
                                echo "<p>
                                    <h2>Cliente ".$nome." Registrado com Sucesso, selecione-o na Caixa de Seleção a Seguir</h2>
                                    </p>";
                                echo "<form action='novo_pedido.php'>
                                <input type='submit' value='Prosseguir'>
                            </form>";
                            } else {
                                echo "<br>Erro: " . $sql . "<br>" . OpenCon()->error;
                            }//Fim da Abertura de Conexao e inserção dos dados    
                        }//Fim do Check de Validação de Permissao de cadastro
                }//Fim do Check se as variaveis de POST estão set's
            }//Fim do Check de Post's Vazios
    }//Fim da Função InsereCliente()

        function InsereProduto(){
                //_________________________________________________________________________________________________________
                //
                // CADASTRO DE PRODUTO
                //_________________________________________________________________________________________________________        
                
                //Validação de Existencia de PRODUTO no sistema

                // Campos Obrigatorios
                $required = array('artigo', 'cod_produto');

                // Loop sobre todos os POST's dos campos de cadastro
                $error = false;
                foreach($required as $field) {
                    if (empty($_POST[$field])) {//Caso esteja vazio seta a variavel $error = true
                        $error = true;
                    }
                }

                if ($error) {
                echo "Preencha todos os campos.";
                }else{//Caso todos os campos estejam preenchidos prossegue com o cadastro
                    DebugLog("Campos Preenchidos Prosseguindo...");

                    //Checa se as variaveis de Post estão Set
                    if((!isset($_POST['artigo']) && !isset($_POST['cod_produto']) && !isset($_POST['cor_fundo']))){
                        echo 'Por favor complete todos os campos';
                    }else{//Caso estejam Set prossegue com o Cadastro 
                            //Define as váriaveis que serão utilizadas na inserção
                            $artigo = $_POST['artigo'];
                            $cod_produto = $_POST['cod_produto'];                    


                            //Debug Line
                            DebugLog(' Variavel Artigo ('.$artigo.') Cod Produto ('.$cod_produto.')');

                            $sql = "SELECT artigo FROM produtos WHERE (artigo='$artigo')";
                            $result = OpenCon()->query($sql);
                            
                            if ($result->num_rows > 0) {            
                                while($row = $result->fetch_assoc()) {                                
                                DebugLog('Artigo Já Cadastrado');
                                }
                            }else{
                                DebugLog("Não existe nenhum cadastro para este artigo");
                                $permite_cadastro = true;//Permite a inclusao do cadastro
                            }            
                            //FIM VALIDAÇÃO
                            //Validação se irá Permitir a inclusão do novo Produto no banco
                            if(isset($permite_cadastro) && $permite_cadastro==true){                            
                                $sql = "INSERT INTO produtos(artigo, COD_Prod)
                                        VALUES ('$artigo','$cod_produto')";

                                        
                                if (OpenCon()->query($sql) === TRUE){
                                    DebugLog("Cadastrado");
                                    echo "<p>
                                        <h2>Produto cadastrado</h2>
                                        </p>";
                                    echo "<form>
                                    <input type='button' value='Voltar' onclick='history.back()'>
                                </form>";
                                } else {
                                    echo "<br>Erro: " . $sql . "<br>" . OpenCon()->error;
                                }//Fim da Abertura de Conexao e inserção dos dados    
                            }//Fim do Check de Validação de Permissao de cadastro
                    }//Fim do Check se as variaveis de POST estão set's
                }//Fim do Check de Post's Vazios
        }//Fim da Função InsereProduto()

        // Funcoes de criação de campos de entrada HTML com informação do Banco da Pagina novo_pedido.php
       function createField($fieldName, $id_cliente = null){        
            if(isset($_GET["Cliente"])){ // Verifica se o campo de Cliente foi selecionado
                $nome_cliente = $_GET["Cliente"]; // Verifica qual o cliente pelo nome no banco
                $sqli = "SELECT * FROM clientes WHERE nome_cliente='$nome_cliente'";// Seleciona as informações do cliente no banco							
                $result = mysqli_query(OpenCon(), $sqli); // Executa a query										
                while ($row = mysqli_fetch_array($result)) { //Verifica a lista de resultados da query
                echo '<td><input type="text" id="'.$fieldName.'" name="'.$fieldName.'" placeholder="'.$row[$fieldName].'" class="form-controls" value="'.$row[$fieldName].'" readonly="readonly"  /></td>'; //Cria o campo
                }
            }
            if(isset($id_cliente)){           
                $sqli = "SELECT * FROM clientes WHERE id_cliente='$id_cliente'";// Seleciona as informações do cliente no banco							
                $result = mysqli_query(OpenCon(), $sqli); // Executa a query										
                while ($row = mysqli_fetch_array($result)) { //Verifica a lista de resultados da query
                echo '<td><label for="'.$fieldName.'">'.$fieldName.'</label><input type="text" id="'.$fieldName.'" name="'.$fieldName.'" placeholder="'.$row[$fieldName].'" class="form-control name_list" value="'.$row[$fieldName].'" readonly="readonly"  /></td>'; //Cria o campo
                }
            }																					
        }

        function sendMailToNewUser($emailAddress, $nivel_perm, $username, $password){
            $to_email = "$emailAddress";
            $subject = "Seu Cadastro foi Efetuado com Sucesso no sistema de Pedidos de Representantes";
            $body = "Você foi cadastrado no Sistema de Pedidos de Representantes como $nivel_perm, seu usuário é $username, e sua senha é $password, acesse pelo link: http://192.168.1.4/representantes/
            <br> Para pedir uma nova senha envie um e-mail para email@email.com, não responda a este email.";
            $headers = "Content-Type: text/html; charset=UTF-8";
            
            if (mail($to_email, $subject, $body, $headers)) {
                echo "<br> Email successfully sent to $to_email...";
            } else {
                echo "Email sending failed...";
            }

        }//Fim da Função sendMailToNewUser()



        function sendMailToManagerOld($emailAddress, $id_pedido, $username){
            $to_email = "$emailAddress";
            $subject = "Um Novo Pedido foi Aberto por $username";
            $body = "Um novo pedido foi aberto no sistema de pedidos de representantes WEB, clique no Link a seguir para acessa-lo<br>
            /menu_representantes/ficha_pedido.php?id_pedido=".$id_pedido."<br> Mensagem automática de Sistema por favor não responda";
            $headers = "Content-Type: text/html; charset=UTF-8";
            $headers .= "From: email@email.com\n";
            $headers .= "Reply-To: email@email.com\n";
            $headers .= "Return-Path: email@email.com\n";
            
            if (mail('email@email.com', $subject, $body, $headers)) {
                echo " - Email com detalhes do pedido enviado para $to_email...";
            } else {
                echo " Email inserido invalido";
            }
        }

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'PHPMailer-master/src/Exception.php';
        require 'PHPMailer-master/src/PHPMailer.php';
        require 'PHPMailer-master/src/SMTP.php';

        function sendMailToManager($emailAddress1,$emailAddress2, $id_pedido, $username, $cnpj, $end_entrega,$obs){                   
                    $mailer = new PHPMailer();
                    $mailer->IsSMTP();
                    $mailer->SMTPDebug = 0;
                    $mailer->CharSet = 'UTF-8';
                    $mailer->Port = 587; //Indica a porta de conexão 
                    $mailer->isHTML(true);
                    $mailer->Host = 'email-ssl.com.br';//Endereço do Host do SMTP 
                    $mailer->SMTPAuth = true; //define se haverá ou não autenticação 
                    $mailer->SMTPSecure = 'tls';              // sets the prefix to the servier
                    $mailer->Username = 'email@email.com'; //Login de autenticação do SMTP
                    $mailer->Password = ''; //Senha de autenticação do SMTP
                    $mailer->FromName = 'Sistema de Abertura de Pedidos'; //Nome que será exibido
                    $mailer->From = 'email@email.com'; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP
                    $mailer->AddEmbeddedImage('img/logo.png', 'logo');
                    $mailer->AddEmbeddedImage('img/qr_code.png', 'qr');
                    $mailer->AddAddress($emailAddress1,'Departamento Comercial');
                    $mailer->AddBCC($emailAddress2,'Comercial');
                    $mailer->AddBCC('email@email.com','TI Responsavel');
                    //Destinatários
                    $mailer->Subject = 'PEDIDO DE N° '.$id_pedido.' ABERTO PELO REPRESENTANTE '.$username;
                    $mailer->Body = "
                    <html>
                    <head>
                    <title></title>
                    </head>
                    <body>                
                    <div style='width:800px;background:#fff;border-style:groove;'>
                    <div style='width:50%;text-align:left;'><a href='your website url'> <img 
                    src='cid:logo' height=126 width=256;'></a></div>
                    <hr width='100%' size='2' color='#A4168E'>
                    <div style='width:50%;height:20px; text-align:right;margin-
                    top:-32px;padding-left:390px;'><a href='/menu_representantes/relatorio.php' style='color:#00BDD3;text-
                    decoration:none;'> 
                    Todos os Pedidos</a> | <a href='menu_representantes/' style='color:#00BDD3;text-
                    decoration:none;'>Painel</a> </div>
                    <h2 style='width:50%;height:40px; text-align:right;margin:0px;padding-
                    left:390px;color:#B24909;'>Confirmacao do Pedido</h2>
                    <div style='width:50%;text-align:right;margin:0px;padding-
                    left:390px;color:#0A903B'> ID DO PEDIDO:".$id_pedido." </div>
                    <h4 style='color:#ea6512;margin-top:-20px;'> Pedido Aberto pelo usuario: " .$username."
                    </h4>
                    <p>Pedido aberto pelo sistema de abertura de pedidos online.</p><br>
                    <a href='/menu_representantes/ficha_pedido.php?id_pedido=$id_pedido' style='color:#00BDD3;text-
                    decoration:none;'> 
                    CLIQUE AQUI PARA ABRIR A FICHA DO PEDIDO</a> 
                    <BR> PARA VISUALIZAR A FICHA VOCÊ DEVE ESTAR LOGADO NO SISTEMA ANTES.                                                           
                    <p><br> - Mensagem automática de Sistema por favor não responda. - <BR>
                    <hr/>
                    <div style='height:210px;'>
                    <table cellspacing='0' width='100%' >
                    <thead>
                    <col width='80px' />
                    <col width='40px' />
                    <col width='40px' />
                    <tr>          
                    <th style='color:#0A903B;text-align:center;'>"."</th>                           
                    <th style='color:#0A903B;text-align:left;'>Informacoes do Pedido</th>
                    <th style='color:#0A903B;text-align:left;'>Detalhes: </th>                                                                            
                    </tr>
                    </thead>
                    <tbody>   
                    <tr>
                    <td style='color:#0A903B;text-align:left;padding-bottom:5px;text-
                    align:center;'><img src='cid:qr' height='90' width='90'></td>
                    <td style='text-align:left;'>"." <br> "." 
                    <br> "." <br>"." </td>
                    <td style='text-align:left;'>"." <br> CNPJ do Cliente:" 
                    .$cnpj." <br> Data de Fechamento:".date("Y/d/m")." 
                    <br> Endereco: ".$end_entrega."</td>
                    </tr>   
                    <tr>
                    </tbody> 
                    </table>                        
                    <hr width='100%' size='1' color='black' style='margin-top:10px;'>                          
                    <table cellspacing='0' width='100%' style='padding-left:300px;'>
                    <thead>                                                                       
                    <tr>                                        
                    <th style='color:#0A903B;text-align:right;padding-bottom:5px;width:70%'>Observacao: ".$obs."</th>
                    <th style='color:black;text-align:left;padding-bottom:5px;padding-
                    left:10px;width:30%'>"."</th>
                    </tr>
                    </thead>   
                    </table>             
                    </div> 
                    </div>              
                    </body>
                    </html>";
                    if(!$mailer->Send())
                    {
                    echo "Message was not sent";
                    echo "Mailer Error: " . $mailer->ErrorInfo; exit; 
                     }
                    //print "E-mail enviado!";                 
                    
                }


        function criaCampoArtigo(){
            $string1 = '<td>Artigo<select id="artigo" name="artigo[]"  required >';
            $string = '<option>Selecione</option>';
                $sqli = "SELECT artigo FROM produtos ORDER BY artigo";
                $result = mysqli_query(OpenCon(), $sqli);
                while ($row = mysqli_fetch_array($result)) {
                $string2[] = "<option value='".utf8_encode($row['artigo'])."'>".utf8_encode($row['artigo'])."</option>";
                }
             $string3 = '</select></td>';
          
                $stringOptions = implode($string2);

             return $string1.$string.$stringOptions.$string3;
        }

        function criaCampos(){
            $string = '<td>Desenho<input type="text" name="desenho[]" placeholder="Desenho" class="form-control name_list" required /></td>  
            <td>Variante<input type="text" name="variante[]" placeholder="Variante" class="form-control name_list" required /></td>
            <td>Colecao<input type="text" name="colecao[]" placeholder="Coleção" class="form-control name_list" /></td>
            <td>Quantidade<input type="number" name="quantidade[]" placeholder="Quantidade" class="form-control name_list" required /></td>  
            <td>R$<input type="number" name="valor[]" placeholder="Valor" class="form-control name_list" required /></td>';
            return $string;
        }


?> 
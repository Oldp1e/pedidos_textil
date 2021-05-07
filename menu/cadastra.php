<?php 
//Inicio do Desenvolvimento do Backend 12-02-2021 - Samuel P. 

//Inicio PHP

//Essa página é onde todas as requisições ao banco de dados serão feitas como Inserções, atualizações e 
//qualquer tipo de alteração

 INCLUDE '/pedidos_textil/pathing.php';  // -> Página com todos os diretórios do Site
 INCLUDE $childDirectory.$dblogin; // -> Pagína de Conexão com o Banco de dados
 INCLUDE $childDirectory.$functions;// -> Página de Funções do Site


    
 //Incluem arquivos importantes para a Pagina   

   //Variavel que verifica em qual página estamos
   if(isset($_POST["pagina"])){
        $pagina_atual = $_POST["pagina"];// Define a variavel de pagina atual para ser igual ao input pagina que veio da pagina anterior   
        switch($pagina_atual){ // Condição que ira verificar em qual pagina estamos

            case "$cadastro_usuario":        
                //Função da Página Funções de Cadastro de Usuario
                InsereUsuario();                
            break; // Fim do cadastro de Usuario
            
            case "$cadastro_cliente":
                //Função da Página Funções de Cadastro de Cliente
                InsereCliente();
            break;
            
            case "$cadastro_produto":
                //Função da Página Funções de Cadastro de Produto
                InsereProduto();
            break;  


        }//FIM SWITCH CASE
    }//FIM DO CHECK DO POST DE PAGINA
    else{
        DebugLog('!! Houve um erro na váriavel de Definição de página por favor tente novamente !!');        
    }//FIM DA CONDICAO CASO NAO HAJA VARIAVEL DE PAGINA
   
















?>
<!--FIM DO DOCUMENTO--> 
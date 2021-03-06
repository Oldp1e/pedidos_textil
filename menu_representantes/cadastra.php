<?php
session_start();
if(is_null($_SESSION['online'])){
	echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';
}	
if (isset($_SESSION['id_pedido']))
	unset($_SESSION['id_pedido']);
if (isset($_SESSION['checkbox_end_entrega_cliente']))
	unset($_SESSION['checkbox_end_entrega_cliente']);
if (isset($_SESSION['id_cliente']))
	unset($_SESSION['id_cliente']);



?>

<html>
<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="contentStyle.css">	
			<link rel="stylesheet" href="menuStyle.css">		
			<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
			<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">PEDIDOS TEXTIL</a>
			</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
			<li><a href="index.php">COMO USAR</a><span class="hover"></span></li>
			<li><a href="novo_pedido.php">Novo Pedido</a><span class="hover"></span></li>
			<li><a href="relatorio.php">Relatorio de Pedidos</a><span class="hover"></span></li>
			<li><a href="logoff.php">Logoff</a><span class="hover"></span></li>
			</ul>
		</div>
		</div>
		</nav>

	<div class='content'>
				<?php 
			//Inicio do Desenvolvimento do Backend 12-02-2021 - Samuel P. 

			//Inicio PHP

			//Essa p??gina ?? onde todas as requisi????es ao banco de dados ser??o feitas como Inser????es, atualiza????es e 
			//qualquer tipo de altera????o

			INCLUDE "../pathing.php";  // -> P??gina com todos os diret??rios do Site
			INCLUDE $childDirectory.$dblogin; // -> Pag??na de Conex??o com o Banco de dados
			INCLUDE $childDirectory.$functions;// -> P??gina de Fun????es do Site


				
			//Incluem arquivos importantes para a Pagina   

			//Variavel que verifica em qual p??gina estamos
			if(isset($_POST["pagina"])){
					$pagina_atual = $_POST["pagina"];// Define a variavel de pagina atual para ser igual ao input pagina que veio da pagina anterior   
					switch($pagina_atual){ // Condi????o que ira verificar em qual pagina estamos

						case "$cadastro_usuario":        
							//Fun????o da P??gina Fun????es de Cadastro de Usuario
							InsereUsuario();                
						break; // Fim do cadastro de Usuario
						
						case "$cadastro_cliente":
							//Fun????o da P??gina Fun????es de Cadastro de Cliente
							InsereClienteNovoRegistro();
						break;
						
						case "$cadastro_produto":
							//Fun????o da P??gina Fun????es de Cadastro de Produto
							InsereProduto();
						break;  


					}//FIM SWITCH CASE
				}//FIM DO CHECK DO POST DE PAGINA
				else{
					DebugLog('!! Houve um erro na v??riavel de Defini????o de p??gina por favor tente novamente !!');        
				}//FIM DA CONDICAO CASO NAO HAJA VARIAVEL DE PAGINA

			?>
	</div>

</body>

</html>

<!-- Fim Documento-->
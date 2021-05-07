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
	INCLUDE '/pedidos_textil/pathing.php';  // -> Página com todos os diretórios do Site
	include $childDirectory . $dblogin; // -> Pagína de Conexão com o Banco de dados
	include $childDirectory . $functions; // -> Página de Funções do Site


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
		<div class="container">
			<br />
			<br />

			<h2 align="center">Finalizar Pedido em Aberto</h2>

			<h4 align="center">Selecione caso o endereço de entrega e cobrança for o mesmo do Cliente no Pedido Selecionado</h4>
			<div class="form-group">
				<?php $getID = $_GET['id_pedido']; ?>
				<form name="clientes" id="clientes" method="GET" action="transporte.php">
					<div class="form-group">
						<form name="add_name" id="add_name">
							<input type="hidden" id="id_pedido" name="id_pedido" value="<?php echo $getID ?>">
							<input type="checkbox" id="end_entrega_cliente" name="end_entrega_cliente" checked>
							<label for="end_entrega_cliente">Endereço de Entrega e cobrança é o mesmo do Cliente</label>
							<input class="btn btn-primary" type="submit" value="Confirmar">
						</form>
					</div>
			</div>

</body>

</html>

<!-- Fim Documento-->
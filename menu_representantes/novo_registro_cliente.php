<?php 	
	session_start();
	if(is_null($_SESSION['online'])){
        echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';
	}	

	?>
	<!--  Alteração no Novo Pedido para Inclusão de Clientes Prévios 05/04/2021-->
	<html>
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
				<h1>Novo Registro de Cliente</h1>
					<form action="cadastra.php" method="POST">
							<input type="hidden" id="pagina" name="pagina" value="cadastro_cliente.php">
							<input type="text" id="nome" name="nome" class="form-control" placeholder="Nome do Cliente">	
							<br>					
							<input oninput="mascara(this, 'cnpj')" id="cnpj" type="text" class="form-control" autocomplete="off" name="cnpj" placeholder="CNPJ">			
							<br>									
							<input type="submit" value="FINALIZAR E VOLTAR AO PEDIDO">
					</form>
			</div>
		</div>	
		</body>
	</html>
	<script>
	function mascara(i,t){
   
			var v = i.value;
			
			if(isNaN(v[v.length-1])){
				i.value = v.substring(0, v.length-1);
				return;
			}
			if(t == "cnpj"){
				i.setAttribute("maxlength", "18");
				if (v.length == 2 || v.length == 6) i.value += ".";
				if (v.length == 10) i.value += "/";
				if (v.length == 15) i.value += "-";
			}
		}


	</script>
	<!-- Fim Documento-->
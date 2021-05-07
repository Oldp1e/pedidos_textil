<?php 	
    session_save_path("/pedidos_textil/tmp");
	session_start();
	if(is_null($_SESSION['online'])){
        echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';
	}		





	?>

	<html>
		<head>
		<link rel="stylesheet" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>		
		</head>
		<body>
		<ul>
			<li><a href="index.php">Menu</a></li>
			<li><a href="cadastro_usuario.php">Cadastro de Novo Usuario</a></li>
			<li><a href="cadastro_cliente.php">Cadastro de Clientes</a></li>
			<li><a class="active" href="cadastro_produto.php">Cadastro de Novos Produtos</a></li>
			<li><a href="relatorio.php">Relatorio de Pedidos</a></li>
			<li><a href="logoff.php">Logoff</a></li>
		</ul>
		<div class="container">
			<div class='content'>
				<h1>Cadastro de Artigo</h1>
					<form action="cadastra.php" method="POST">
						<?php 						
 						INCLUDE '/pedidos_textil/pathing.php';  // -> Página com todos os diretórios do Site						 
						?>
						<input type="hidden" id="pagina" name="pagina" value=<?php echo $cadastro_produto;?>>
							<label for="fname">Artigo</label>
							<input type="text" id="artigo" name="artigo" placeholder="Artigo">
							<label for="lname">Codigo do Artigo</label>
							<input type="text" id="cod_produto" name="cod_produto" placeholder="Codigo do Produto">
							<input type="submit" value="CADASTRAR">
		</form>
			</div>
	    </div>				
		</body>
	</html>
	<!-- Fim Documento-->
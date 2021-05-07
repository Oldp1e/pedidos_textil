<?php 	
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
			<li><a class="active" href="cadastro_usuario.php">Cadastro de Novo Usuario</a></li>
			<li><a href="cadastro_cliente.php">Cadastro de Clientes</a></li>
			<li><a href="cadastro_produto.php">Cadastro de Novos Produtos</a></li>
			<li><a href="relatorio.php">Relatorio de Pedidos</a></li>
			<li><a href="logoff.php">Logoff</a></li>
		</ul>
		<div class='content'>
			<div class="container">
				<h1>Cadastro de Usuario</h1>
					<form action="cadastra.php" method="POST">
					<input type="hidden" id="pagina" name="pagina" value="cadastro_usuario.php">
							<label for="fname">Usuario</label>
							<input type="text" id="username" name="username" placeholder="Usuario">
							<label for="lname">Senha</label>
							<input type="password" id="password" name="password" placeholder="Senha">
							<label for="lname">Email</label>
							<input type="text" id="email" name="email" placeholder="Email">
							<label for="nivel_perm">Nivel de Acesso</label>
							<select id="nivel_perm" name="nivel_perm">
							<option value="administrador">Administrador</option>
							<option value="coordenador">Coordenador</option>
							<option value="representante">Representante</option>							
							</select>


							<input type="submit" value="CADASTRAR">

		</form>
			</div>
		</div>	
		</body>
	</html>

	<!-- Fim Documento-->
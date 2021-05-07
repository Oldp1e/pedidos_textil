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
			<li><a href="cadastro_usuario.php">Cadastro de Novo Usuario</a></li>
			<li><a class="active" href="cadastro_cliente.php">Cadastro de Clientes</a></li>
			<li><a href="cadastro_produto.php">Cadastro de Novos Produtos</a></li>
			<li><a href="relatorio.php">Relatorio de Pedidos</a></li>
			<li><a href="logoff.php">Logoff</a></li>
		</ul>

		<div class='content'>
			<div class="container">
				<h1>Cadastro de Clientes</h1>
					<form action="cadastra.php" method="POST">
							<input type="hidden" id="pagina" name="pagina" value="cadastro_cliente.php">
							<label for="nome">Nome do Cliente</label>
							<input type="text" id="nome" name="nome" placeholder="Nome do Cliente">						
							<label for="cnpj">CNPJ</label>
							<input oninput="mascara(this, 'cnpj')" id="cnpj" type="text" class="form-control" autocomplete="off" name="cnpj" placeholder="CNPJ">
							<label for="endereco">Endereco</label>
							<input type="text" id="endereco" name="endereco" placeholder="Endereco">
							<label for="cep">CEP</label>							
							<input oninput="mascara(this, 'cep')" id="cep" type="text" class="form-control" autocomplete="off" name="cep" placeholder="CEP">
							<label for="estado">Estado</label>
							<select id="estado" name="estado">							
							<option value="">Selecione</option>
							<option value="AC">AC-Acre</option>
							<option value="AL">AL-Alagoas</option>
							<option value="AP">AP-Amapá</option>
							<option value="AM">AM-Amazonas</option>
							<option value="BA">BA-Bahia</option>
							<option value="CE">CE-Ceará</option>
							<option value="DF">DF-Distrito Federal</option>
							<option value="ES">ES-Espírito Santo</option>
							<option value="GO">GO-Goiás</option>
							<option value="MA">MA-Maranhão</option>
							<option value="MT">MT-Mato Grosso</option>
							<option value="MS">MS-Mato Grosso do Sul</option>
							<option value="MG">MG-Minas Gerais</option>
							<option value="PA">PA-Pará</option>
							<option value="PB">PB-Paraíba</option>
							<option value="PR">PR-Paraná</option>
							<option value="PE">PE-Pernambuco</option>
							<option value="PI">PI-Piauí</option>
							<option value="RJ">RJ-Rio de Janeiro</option>
							<option value="RN">RN-Rio Grande do Norte</option>
							<option value="RS">RS-Rio Grande do Sul</option>
							<option value="RO">RO-Rondônia</option>
							<option value="RR">RR-Roraima</option>
							<option value="SC">SC-Santa Catarina</option>
							<option value="SP">SP-São Paulo</option>
							<option value="SE">SE-Sergipe</option>
							<option value="TO">TO-Tocantins</option>
							</select>
							<label for="municipio">MUNICIPIO</label>
							<input type="text" id="municipio" name="municipio" placeholder="Municipio">
							<label for="bairro">BAIRRO</label>
							<input type="text" id="bairro" name="bairro" placeholder="Bairro">
							<label for="fone">FONE</label>
							<input oninput="mascara(this, 'fone')" id="fone" type="text" class="form-control" autocomplete="off" name="fone" placeholder="FONE">
							<label for="inscricao_estadual">Inscricao Estadual</label>
							<input oninput="mascara(this, 'inscricao_estadual')" id="inscricao_estadual" type="text" class="form-control" autocomplete="off" name="inscricao_estadual" placeholder="INSCRIÇÃO ESTADUAL">
						

							
						
							<input type="submit" value="CADASTRAR">
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

			if(t == "cep"){
				i.setAttribute("maxlength", "9");
				if (v.length == 5) i.value += "-";
			}

			if(t == "inscricao_estadual"){
				i.setAttribute("maxlength", "15");
				if (v.length == 3 || v.length == 7) i.value += ".";
				if (v.length == 11) i.value += ".";
			}

			if(t == "fone"){
				if(v[0] == 12){
					i.setAttribute("maxlength", "10");
					if (v.length == 5) i.value += "-";
				}else{
					i.setAttribute("maxlength", "12");
					if (v.length == 2) i.value += " ";
					i.setAttribute("maxlength", "12");
					if (v.length == 7) i.value += "-";
				}
			}

			
		}


	</script>
	<!-- Fim Documento-->
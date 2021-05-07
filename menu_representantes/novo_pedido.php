<?php 	
	session_start();
	if(is_null($_SESSION['online'])){
        echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';
	}		
	if(isset($_SESSION['id_pedido']))			
	unset($_SESSION['id_pedido']);
	if(isset($_SESSION['checkbox_end_entrega_cliente']))	
	unset($_SESSION['checkbox_end_entrega_cliente']);
	if(isset($_SESSION['id_cliente']))	
	unset($_SESSION['id_cliente']);
	INCLUDE '/pedidos_textil/pathing.php'; // -> Página com todos os diretórios do Site
	INCLUDE $childDirectory.$dblogin; // -> Pagína de Conexão com o Banco de dados
	INCLUDE $childDirectory.$functions;// -> Página de Funções do Site
	$username = $_SESSION['user'];

	?>
	<html>
		<head>
		<meta charset="UTF-8">
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
			<a class="navbar-brand" href="#">PEDIDOS TEXTILL</a>
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

				<h2 align="center">Cliente</h2>
				<div class="form-group">  
                     <form name="cliente" id="clientes" method="GET" action="novo_pedido.php">    
                               <table>  
                                    <tr>  																														
										<?php										
										//Alterações dia 05-04-2021 10:11 - Novo botão adicionado abaixo da Caixa de Seleção de Clientes para adicionar cliente novo no sistema indiretamente caso não haja registro
										
											$fieldList = array('id_cliente','CNPJ','FONE','insc_est','ESTADO','endereco','CEP','MUNICIPIO','BAIRRO'); // Todos os campos que serão
											// adicionados tem que estar na array acima para que o campo seja criado dinamicamente										
											$defineLimiteLinha = 0; // Reset do limite de linha
											$arrayLenght = 0; // Reset da Largura de Array
											foreach($fieldList as $value){
												$arrayLenght +=1; // Define o cumprimento do Array de acordo com a quantidade de itens no array
											} 
											$criaLinha = round($arrayLenght/2); // Divide por 2 para pegar a linha de divisão das colunas da tabela
											$criaLinha++; // Adiciona mais um na criação de Linha para poder ser feito o calculo da divisao de coluna
												foreach($fieldList as $value){
													//Criação dos campos do Cliente de Acordo com a quantidade de campos no array
													$defineLimiteLinha += 1; // Soma o limite da linha para criação da divisão da coluna
													if($defineLimiteLinha < $criaLinha){
														createField($value); // Crias os campos ate chegar no valor de visiao definido pelo calculo acima
													}else{														
														if($defineLimiteLinha == $criaLinha){ // Cria a coluna quando atinge o limite da linha
															echo '<tr>';	
															echo '</tr>';	
														}																																										
														createField($value); // Cria campos enquanto houver Itens no array
													}
												  }											
												  
												  $selecionouCliente = false;

												  echo '<td>';
												  if(isset($_GET["Cliente"])){
													  echo '<input type="hidden" id="nome_cliente" name="nome_cliente" value="'.$_GET["Cliente"].'">';
													  echo '<select id="Cliente" name="Cliente" onchange="this.form.submit()">';
													  echo '<option selected>'.$_GET["Cliente"].'</option>';
													  //PREENCHE COMBO BOX
													  $sqli = "SELECT id_cliente, nome_cliente FROM clientes WHERE nome_cliente!='".$_GET["Cliente"]."' ORDER BY nome_cliente";
													  $result = mysqli_query(OpenCon(), $sqli);													
													  while ($row = mysqli_fetch_array($result)) {													  											  
													  echo "<option value='".$row['nome_cliente']."'>".$row['nome_cliente']."</option>";												
													  }													  
													  //PEGA ID
													  $sqli = "SELECT id_cliente, nome_cliente FROM clientes WHERE nome_cliente='".$_GET["Cliente"]."' ORDER BY nome_cliente";
													  $result = mysqli_query(OpenCon(), $sqli);
													  while ($row = mysqli_fetch_array($result)) {
													  $id_cliente = $row['id_cliente'];													  													 												
													  }
													  echo '</select>';														  
													  $selecionouCliente = true;
												  }else{
													  echo '<select id="Cliente" name="Cliente" onchange="this.form.submit()">';
													  echo '<option selected>SELECIONE UM CLIENTE</option>';
													  $sqli = "SELECT nome_cliente FROM clientes WHERE username='".$username."' ORDER BY nome_cliente";
													  $result = mysqli_query(OpenCon(), $sqli);
													  while ($row = mysqli_fetch_array($result)) {
													  echo "<option value='".$row['nome_cliente']."'>".$row['nome_cliente']."</option>";
													  }
													  echo '</select>';	
													  $selecionouCliente = false;						
												  }																	
										?>
										</td>
                                    </tr>  
                               </table>                              
                          
						  <?php 
						 	echo '<input type="button" name="registroNovoCliente" id="registroNovoCliente" class="btn btn-info" value="Novo Registro de Cliente"/>'; 
						  ?>
                     </form>  
                </div> 
			<div>
												  
				<?php						
					if($selecionouCliente){
					
					echo '<h2 align="center">Adicionar Produtos</h2>';
					}						
				?>				  
                
                <div class="form-group">  
                     <form name="add_name" id="add_name">  
                               <table id="dynamic_field">  
							   <div>
								<input type="checkbox" id="end_entrega_cliente" name="end_entrega_cliente"
										checked>
								<label for="end_entrega_cliente">Endereço de Entrega e cobrança é o mesmo do Cliente</label>
								</div>
				</div>
                                    <tr>  
										 <input type="hidden" id="pagina" name="pagina" value="abrePedido">

										<?php 
										if(isset($id_cliente)){											
											echo '<input type="hidden" id="id_cliente" name="id_cliente" value="'.$id_cliente.'">';
										}
										

										?>										 
										<?php
										 //selecionaArtigo();
										if($selecionouCliente){
											echo criaCampoArtigo();											
											echo criaCampos();
											echo '<td><button type="button" name="add" id="add" class="btn btn-success">+ Produto</button></td>';
										}
										 

										?>											 
										
                                    </tr>  
                               </table>  




							   </form>
							   <form name="final" action="gereciamento_pedido.php">
							   <?php
								if(isset($_GET['id_cliente'])){
									echo '<input type="hidden" id="id_cliente" name="id_cliente" value="'.$_GET['id_cliente'].'">';
								}										
								if($selecionouCliente){
									echo '<input type="button" name="submit" id="submit" class="btn btn-info" value="Confirma Produtos"/>';
									}	

							  ?>                                							   
                          </div>  
                     </form>  
           </div>  
		</div>
			
		</body>
	</html>
	
	<script>  
		$( "li" ).hover(
			function() {
				$(this).find("span").stop().animate({
				width:"100%",
				opacity:"1",
				}, 400, function () {
				})
			}, function() {
				$(this).find("span").stop().animate({
				width:"0%",
				opacity:"0",
				}, 400, function () {
				})
			}
			);
							
		function checkInputs() {//<====
				var isValid = true;//<====
				$('input').filter('[required]').each(function() {//<====
					if ($(this).val() === '') {//<====
					$('#submit').prop('disabled', true)//<====
					isValid = false;//<====
					return false;//<====
					}//<====
				});//<====
				if(isValid) {$('#submit').prop('disabled', false)}//<====
				return isValid;//<====
				}//<====
				checkInputs()


			//Enable or disable button based on if inputs are filled or not //<====
			$('input').filter('[required]').on('keyup',function() {//<====
			checkInputs()//<====
			})//<====		





		$(document).ready(function(){  
			var i=1;  			
			$('#add').click(function(){
				<?php
				$campos = criaCampoArtigo();
				$campos2 = criaCampos();
				?>
				var campos = <?php echo json_encode($campos) ?>;
				var campos2 = <?php echo json_encode($campos2) ?>;  
				i++;  
				$('#dynamic_field').append('<tr id="row'+i+'">\
				"'+campos+'" \
				"'+campos2+'" \
				<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
			});  
			$(document).on('click', '.btn_remove', function(){  
				var button_id = $(this).attr("id");   
				$('#row'+button_id+'').remove();  
			});  
			$('#submit').click(function(){            			
						$.ajax({  
						url:"confirma_produtos.php",  
						method:"POST",  
						data:$('#add_name').serialize(),  
						success:function(data)  
						{  
							alert(data);
							window.location.href = "transporte.php";							
							$('#add_name')[0].reset();  
						}

				});  
			});  
			$('#registroNovoCliente').click(function(){            			
				window.location.href='novo_registro_cliente.php';
			}); 
		});  
		
		</script>
   
	<!-- Fim Documento-->
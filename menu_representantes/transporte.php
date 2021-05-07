<?php 	
session_start();
	INCLUDE '/pedidos_textil/pathing.php';  // -> Página com todos os diretórios do Site
	INCLUDE $childDirectory.$dblogin; // -> Pagína de Conexão com o Banco de dados
	INCLUDE $childDirectory.$functions;// -> Página de Funções do Site
	if(is_null($_SESSION['online'])){
        echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';
	}	
	if(isset($_SESSION['id_pedido'])){
		$id_pedido = $_SESSION['id_pedido'];			
	}
	if(isset($_GET['id_pedido'])){
		$id_pedido = $_GET['id_pedido'];		
	}
	
	if(isset($_SESSION['id_cliente']))			
	$id_cliente = $_SESSION['id_cliente'];	

	if(isset($_SESSION['checkbox_end_entrega_cliente'])){
		$mesmoEndereco = true;
	}		

	if(isset($_GET['end_entrega_cliente'])){
		$_SESSION['id_pedido'] = $_GET['id_pedido'];
		$sqli = "SELECT pedidos.ID_Cliente FROM pedidos 
		WHERE pedidos.ID_Pedido=$id_pedido";
        $result = mysqli_query(OpenCon(), $sqli);
        while ($row = mysqli_fetch_array($result)) {
        $id_cliente = $row['ID_Cliente'];
        }
		$mesmoEndereco = true;
	}	
	if(!isset($_SESSION['checkbox_end_entrega_cliente']) && !isset($_GET['end_entrega_cliente'])){
		$mesmoEndereco = false;
	}




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

				<h1>Transporte</h1>		
				<div class="loader">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					</div>
				<br />  
                <br />  

				<?php 

				if(isset($id_pedido) && $mesmoEndereco){

					if(!isset($_GET['end_entrega_cliente'])){
					$id_cliente = $_SESSION['id_cliente'];
					}

					$transporte = true;

					//PAROU A PROGAMAÇAO FAZENDO ESQUEMA DE CNPJ TRANSPORTE PARA CLIENTE JA CADASTRADO
					$sqli ="SELECT id_cliente, nome_cliente FROM clientes WHERE id_cliente!=.$id_cliente";
					$result = mysqli_query(OpenCon(), 'SELECT id_cliente, nome_cliente FROM clientes WHERE id_cliente!='.$id_cliente.''); 
					$row = mysqli_fetch_assoc($result); 
					$nome_cliente = $row['nome_cliente'];



					echo '<div class="form-group">  
					<form name="add_name" id="add_name">  
						 <div class="table-responsive">  
							  <table class="table table-bordered" id="dynamic_field2">
							  ';
							 
							  $fieldList = array('id_cliente','nome_cliente','CNPJ','ESTADO','endereco','CEP','MUNICIPIO','BAIRRO'); // Todos os campos que serão
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
														createField($value,$id_cliente); // Crias os campos ate chegar no valor de visiao definido pelo calculo acima
													}else{														
														if($defineLimiteLinha == $criaLinha){ // Cria a coluna quando atinge o limite da linha
															echo '<tr>';															
															echo '</tr	>';	
														}																																										
														createField($value,$id_cliente); // Cria campos enquanto houver Itens no array
													}
												  }											
												  												 
							  echo '
							  <input type="hidden" id="mesmoCNPJ" name="mesmoCNPJ" value="true">';
							  if(isset($_GET['id_pedido'])){
								echo '<input type="hidden" id="id_pedido" name="id_pedido" value='.$id_pedido.'>';
							  } 
							  echo '
								   <tr>  								   								
										<td>
										<label for="transp">Transportadora</label>
										<input type="text" name="transp" id="transp" placeholder="Nome Transportadora" class="form-control name_list" required="required"/>
										<label for="transp">N° Pedido do Cliente</label>
										<input type="text" name="n_pedido" id="n_pedido" placeholder="N° Pedido do Cliente" class="form-control name_list" "/>
										<label for="transp">Observação</label>
										<textarea class="form-control" id="obs" name="obs" rows="3"></textarea>
										<label for="transp">Condição de Pagamento</label>
										<input type="text" name="cond_pag" id="cond_pag" placeholder="Condição de Pagamento" class="form-control name_list" "/>
										<h3>BOTAO ANEXO AINDA EM DESENVOLVIMENTO FAVOR NAO UTILIZAR</h3>
										<label for="anexo">Anexo Adicional:</label>
											<input type="file" id="file" name="file" accept="image/*"/>
											<input type="hidden" name="MAX_FILE_SIZE" value="67108864"/> <!--64 MBs worth in bytes-->	
										</td>																						
								   </tr>  								 								
							  </table>  
						
							  <br>

							  <input type="button" name="submit3" id="submit3" class="btn btn-info" value="Manter em Aberto e Abrir Novo Pedido"/> 
							  <!--<input type="button" name="submit2" id="submit2" class="btn btn-info" value="Cancelar Pedido e Voltar" disabled/> -->
							  <input type="button" onlick="mostraProgresso()" name="submit" id="submit" class="btn btn-info" value="Confirmar Pedido e Enviar"/> 							                             
						 </div>  
					</form>  							  
			   </div>';

		

			

				}

				if(isset($id_pedido) && !$mesmoEndereco){
					echo '<h2 align="center">Informações de Entrega do Pedido '.$id_pedido.'</h2>'; 
					
				echo '<div class="form-group">  
                     <form name="add_name" id="add_name">  
                          <div class="table-responsive">  
                               <table class="table table-bordered" id="dynamic_field2">  
                                    <tr>  
									
										<td>
										<label for="cnpj">CNPJ</label>';

										if(isset($_GET['id_pedido'])){
											echo '<input type="hidden" id="id_pedido" name="id_pedido" value='.$id_pedido.'>';
										  } 
										  echo '
										<input oninput="mascara(this,\'cnpj\')" type="text" name="cnpj" id="cnpj" placeholder="CNPJ Entrega." class="form-control name_list" required="required"/>										
										</td>
                                         <td>
										 <label for="transp">Nome do local que irá Receber</label>
										 <input type="text" name="nome_local_entrega" id="nome_local_entrega" placeholder="Nome Local Entrega" class="form-control name_list" required="required"/>
										 </td>	
										 <td>
										<label for="transp">Transportadora</label>
										<input type="text" name="transp" id="transp" placeholder="Nome Transportadora" class="form-control name_list" required="required"/>
										<label for="transp">N° Pedido do Cliente</label>
										<input type="text" name="n_pedido" id="n_pedido" placeholder="N° Pedido do Cliente" class="form-control name_list" />
										<label for="transp">Observação</label>
										<textarea class="form-control" id="obs" name="obs" rows="3"></textarea>
										<label for="transp">Condição de Pagamento</label>
										<input type="text" name="cond_pag" id="cond_pag" placeholder="Condição de Pagamento" class="form-control name_list" "/>
										</td>		
										</td>											 										  										                                           
                                    </tr>  
									<tr>  
										<td>
										<label for="end_entrega">Endereço de Entrega</label>
										<input type="text" name="end_entrega" id="end_entrega" placeholder="Endereço" class="form-control name_list" required="required"/>
										<input type="text" name="bairro_entrega" id="bairro_entrega" placeholder="Bairro" class="form-control name_list" required="required" />
										<input type="text" name="uf_entrega" id="uf_entrega" placeholder="UF" class="form-control name_list" required="required"/>
										<input type="text" name="cidade_entrega" id="cidade_entrega" placeholder="Cidade" class="form-control name_list" required="required"/>
										<input type="text" name="CEP_entrega" id="CEP_entrega" placeholder="CEP" class="form-control name_list" required="required"/>
										<input type="text" name="logradouro_entrega" id="logradouro_entrega" placeholder="Logradouro" class="form-control name_list"/>
										</td>
                                         <td>										 
										<label for="end_cobranca">Endereço de Cobrança</label>
										<input type="text" name="end_cobranca" id="end_cobranca" placeholder="Endereço" class="form-control name_list" required="required"/>
										<input type="text" name="bairro_cobranca" id="bairro_cobranca" placeholder="Bairro" class="form-control name_list" required="required"/>
										<input type="text" name="uf_cobranca" id="uf_cobranca" placeholder="UF" class="form-control name_list" required="required"/>
										<input type="text" name="cidade_cobranca" id="cidade_cobranca" placeholder="Cidade" class="form-control name_list" required="required"/>
										<input type="text" name="CEP_cobranca" id="CEP_cobranca" placeholder="CEP" class="form-control name_list" required="required"/>
										<input type="text" name="logradouro_cobranca" id="logradouro_cobranca" placeholder="Logradouro" class="form-control name_list" />
										</td>										 
										 </td>																				  										                                           
                                    </tr>  								
                               </table>    
							   <input type="button" name="submit3" id="submit3" class="btn btn-info" value="Manter em Aberto e Abrir Novo Pedido"/> 
							   <!--<input type="button" name="submit2" id="submit2" class="btn btn-info" value="Cancelar Pedido e Voltar" disabled/> -->
							   <input type="button" name="submit" id="submit" class="btn btn-info" value="Confirmar Pedido e Enviar"/> 							                             
                          </div>  
                     </form>  
                </div>';
				
				}
				if(!isset($id_pedido)){
					echo '<h2 align="center">Abra um Novo Pedido para Acessar a esta Pagina ou vá até relatórios e selecione o pedido que deseja finalizar</h2>';
				}						
				?>
				



				</div>
			</div>
			
		</body>
	</html>
<script>

				//Esconde a barra de progressão
				$(document).ready(function() {
					document.getElementsByClassName('loader')[0].style.visibility = 'hidden';
				});				


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

				$('#submit').click(function(){
					document.getElementById("submit").disabled = true;		
					document.getElementsByClassName('loader')[0].style.visibility = 'visible';		
					document.getElementsByClassName('loader')[0].style.paddingLeft = '43%' ;													
						$.ajax({  
									url:"fechamento_pedido.php",  
									method:"POST",  
									data:$('#add_name').serialize(),  
									success:function(data)  
									{    $(this).prop('disabled', true);
										alert(data);
										
										window.location.href = "novo_pedido.php";
										$('#add_name')[0].reset();  
									}
							});									
			}); 

			$('#submit2').click(function(){            			
						$.ajax({  
						url:"novo_pedido.php",  
						method:"POST",  
						data:$('#add_name2').serialize(),  
						success:function(data)  
						{  
							//alert(data);
							//window.location.href = "novo_pedido.php";
							$('#add_name2')[0].reset();  
						}

				});  
			}); 
			$('#submit3').click(function(){            			
						$.ajax({  
						url:"novo_pedido.php",  
						method:"POST",  
						data:$('#add_name2').serialize(),  
						success:function(data)  
						{  
							//alert(data);
							window.location.href = "novo_pedido.php";
							$('#add_name2')[0].reset();  
						}

				});  
			}); 
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
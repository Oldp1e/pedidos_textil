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
			<li><a href="novo_pedido.php">Novo Pedido</a></li>
			<li><a class="active" href="relatorio.php">Relatorio de Pedidos</a></li>
			<li><a href="logoff.php">Logoff</a></li>

		</ul>
	<div class="content">
		<div class="container">
		<h2 align="center">Relatorio de Pedidos do Representante Teste</h2>
				<div class="form-group">  
                     <form name="cliente" id="cliente">  
                          <div class="table-responsive">  
                               <table class="table table-bordered" id="dynamic_field2">  
                                    <tr>  
										<td>N° PEDIDO</td>   
										<td>PRODUTO</td>  
										<td>QUANTIDADE</td>  
										<td>PREÇO UNITARIO</td>      
										<td>TOTAL</td>                                   										                                           
                                    </tr>  
									<tr>  
                                        <td>1</td>	
										<td>T0125</td>
										<td>2000</td>
										<td>R$8.54</td>										
										<td>R$17087.00</td>																		                                           
                                    </tr>  
									<tr>  
                                        <td>1</td>		
										<td>T0125</td>
										<td>2000</td>
										<td>R$8.54</td>										
										<td>R$17087.00</td>																		                                           
                                    </tr> 
                               </table>  
							   <form name="ver_produto" id="ver_produto" action="relatorio.php">
								    <input type="button" name="submit" id="submit" class="btn btn-info" value="Voltar"/> 
								</form>                            
                          </div>  
                     </form>  
                </div> 

		</div>
	</div>
			
		</body>
	</html>
	<script>
		$('#submit').click(function(){            			
							$.ajax({  
							url:"relatorio.php",  
							method:"POST",  
							data:$('#add_name').serialize(),  
							success:function(data)  
							{  
								//alert(data);
								window.location.href = "relatorio.php";
								$('#add_name')[0].reset();  
							}

					});  
				}); 
		</script>
	<!-- Fim Documento-->
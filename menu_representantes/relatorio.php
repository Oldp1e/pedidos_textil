<?php 
			session_start();
			if(is_null($_SESSION['online'])){
				echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';
			}		

			$username = $_SESSION['user'];
			INCLUDE '/pedidos_textil/pathing.php';  // -> Página com todos os diretórios do Site
			INCLUDE $childDirectory.$dblogin; // -> Pagína de Conexão com o Banco de dados
			INCLUDE $childDirectory.$functions;// -> Página de Funções do Site

			if(isset($_SESSION['id_pedido']))	
			$id_pedido = $_SESSION['id_pedido'] ;

	?>

	<html>

		<!-- <head>
		<meta http-equiv="content-type" content=text/html; charset=UTF-8">
		<meta http-equiv="content-type" content=application/vnd.ms-excel; charset=UTF-8">
		<script>
		function pop_up(url){
		window.open(url,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=768,directories=no,location=no') 
		}
		</script>
		<link rel="stylesheet" href="style.css">	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		</head>
		
 -->
		<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script>
			function pop_up(url){
			window.open(url,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=768,directories=no,location=no') 
			}
			</script>
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
	<div class="content">
		<div class="container">
		<h2 align="center">Informações de Seus Pedidos</h2>
		<form name="ver_produto" id="ver_produto" action="relatorio.php">								   
									<button onclick="exportTableToExcel('dynamic_field2')" class="btn btn-info" >Excel</button>                                    
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>							
								</form> 
				<div class="form-group">  
                     <form name="clientes" id="clientes">  
                          <div class="table-responsive">  
						  <?php						  							
							/* Attempt MySQL server connection. Assuming you are running MySQL
							server with default setting (user 'root' with no password) */
							$link = mysqli_connect($dbhost , $dbuser, $dbpass, $db);
							
							// Check connection
							if($link === false){
								die("ERROR: Could not connect. " . mysqli_connect_error());
							}
							echo '<table class="table table-bordered" id="dynamic_field2">';
							// Attempt select query execution						
									$sql_info_geral = "SELECT pedidos.ID_Pedido AS Numero_Pedido,pedidos.username AS Usuario,produtos.Artigo,produtos.COD_Prod AS CODIGO, usuarios.username,
									produtos_pedido.desenho,produtos_pedido.variante,pedidos.status_pedido, produtos_pedido.colecao, produtos_pedido.preco_unit, produtos_pedido.quant, produtos_pedido.total, clientes.nome_cliente, pedidos.valor_total AS VALOR_TOTAL,
									fechamento_pedido.DATA_FECH AS data_pedido
									FROM pedidos
									INNER JOIN produtos_pedido ON pedidos.ID_Pedido=produtos_pedido.id_pedido
									INNER JOIN clientes ON pedidos.ID_Cliente=clientes.id_cliente
									INNER JOIN produtos ON produtos.ID_Produto=produtos_pedido.id_produto
									INNER JOIN usuarios ON pedidos.username=usuarios.username
									LEFT JOIN fechamento_pedido ON pedidos.ID_Pedido=fechamento_pedido.id_pedido
									WHERE usuarios.username ='$username'																																				
									ORDER BY CAST(Numero_Pedido AS UNSIGNED)";																

						echo'    	<tr>
       									<td><b><u>Codigo do Pedido</b></u></td>   
										<td><b><u>Nome Cliente</b></u></td>
										<td><b><u>Situação</b></u></td>
										<td><b><u>Usuario que Efetuou o Pedido</b></u></td>
										<td><b><u>Artigo</b></u></td>  
										<td><b><u>Codigo do Produto</b></u></td>  
										<td><b><u>Desenho</b></u></td>  
										<td><b><u>Variante</b></u></td>  										
										<td><b><u>Coleção</b></u></td>    
										<td><b><u>Preço Unitário</b></u></td>      
										<td><b><u>Quantidade</b></u></td> 								  
										<td><b><u>Total do Produto</b></u></td> 																				      										
										<td><b><u>Total do Pedido</b></u></td> 
										<td><b><u>Data do Pedido</b></u></td>	
                                    </tr> ';									
							if($result = mysqli_query($link, $sql_info_geral)){
								if(mysqli_num_rows($result) > 0){
									while($row = mysqli_fetch_array($result)){
								echo'
									<tr>
       									<td>'.$row['Numero_Pedido'].'</td>   
										<td>'.$row['nome_cliente'].'</td> 

										';
										
										if(strcmp($row['status_pedido'], 'finalizado') == 0 || strcmp($row['status_pedido'], 'cancelado') == 0){
											echo'
											<td>'.$row['status_pedido'].'</td> ';
										}else{
											echo'
											<td>
											<form name="finalizar" id="finalizar" method="POST">
											<input type="hidden" id="id_pedido" name="id_pedido" value="'.$row['Numero_Pedido'].'">'.$row['status_pedido'].
											'<a class="btn btn-primary" href="finalizar_pedido_em_aberto.php?id_pedido='.$row['Numero_Pedido'].'" role="button">Finalizar Pedido</a>																					
											</form>
											</td> 
											';											
										}
										
										echo'
										<td>'.$row['Usuario'].'</td>  
										<td>'.utf8_encode($row['Artigo']).'</td> 
										<td>'.$row['CODIGO'].'</td> 
										<td>'.$row['desenho'].'</td>  
										<td>'.$row['variante'].'</td>  										
										<td>'.$row['colecao'].'</td>    
										<td>R$'.$row['preco_unit'].'</td>      
										<td>'.$row['quant'].'</td>
										<td>R$'.$row['total'].'</td> 
										<td>R$'.$row['VALOR_TOTAL'].'</td> 
										<td>'.$row['data_pedido'].'</td> 										
                                    </tr>';																										
										echo "</tr>";																	
									// Free result set
								}
								mysqli_free_result($result);
							} else{
								echo "Não há resultados para a busca.";
							}
						} else{
							echo "ERROR: Could not able to execute $sql_info_geral. " . mysqli_error($link);
						}
						echo '</table>';

							
							// Close connection
							mysqli_close($link);
							?>
							<br>																	                           
                          </div>  
                     </form>  
                </div> 
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
	function exportTableToExcel(dynamic_field2, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(dynamic_field2);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
	
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
		
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}	
</script>
	<!-- Fim Documento-->
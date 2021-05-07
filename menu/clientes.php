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
			<li><a href="index.php">Menu</a><span class="hover"></span></li>
			<li><a href="novo_pedido.php">Novo Pedido</a><span class="hover"></span></li>
			<li><a href="configuracao_sistema.php">Configurações do Sistema</a><span class="hover"></span></li>
			<li><a href="logoff.php">Logoff</a><span class="hover"></span></li>
			</ul>
		</div>
		</div>
		</nav>

		<?php
		
		if(isset($_POST['representante'])){
			$representante = $_POST['representante'];
			$id_cliente = $_POST['id_cliente'];
			$sql = "UPDATE clientes SET username='$representante' WHERE id_cliente=$id_cliente";
			if (OpenCon()->query($sql) === TRUE) {        
				echo "<H1>ATUALIZADO O REPRESENTANTE</H1>";
            } else {
                echo "<H1> ERRO AO INSERIR ATUALIZACAO </H1>: " . OpenCon()->error;
            }

		}

		
		?>
	<div class="content">
		<div class="container">
		<h2 align="center">Informações dos Clientes</h2>
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
							$link = mysqli_connect("bd_brandrep.mysql.dbaas.com.br", "bd_brandrep", "bdRep@Brand202", "bd_brandrep");
							
							// Check connection
							if($link === false){
								die("ERROR: Could not connect. " . mysqli_connect_error());
							}
							echo '<table class="table table-bordered" id="dynamic_field2">';
							// Attempt select query execution						
									$sql_info_geral = "SELECT * FROM clientes";																

						echo'    	<tr>
       									<td><b><u>ID</b></u></td>   
										<td><b><u>Nome Cliente</b></u></td>																		
										<td><b><u>CNPJ</b></u></td>    						  									  
										<td><b><u>Representante do Cliente</b></u></td> 	
										<td><b><u>Salvar</b></u></td> 																				      										
                                    </tr> ';									
							if($result = mysqli_query($link, $sql_info_geral)){
								if(mysqli_num_rows($result) > 0){
									while($row = mysqli_fetch_array($result)){
								echo'
									<tr>
       									<td>'.$row['id_cliente'].'</td>   
										<td>'.$row['nome_cliente'].'</td>';																				
										echo'	 
										<td>'.$row['CNPJ'].'</td>      					
										<form action="clientes.php" method="POST">
										<input type="hidden" name="id_cliente" id="id_cliente" value="'.$row['id_cliente'].'">
										<td>Representante<input type="text" name="representante" id="representante" placeholder="'.$row['username'].'" class="form-control name_list" required /></td> 	
										<td><br><input type="submit" class="btn btn-info" value="Salvar"></td>									
										</form>
                                    </tr>
									
									';																										
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

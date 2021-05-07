<?php 
    setlocale(LC_MONETARY,"pt_BR", "ptb");
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
    <!DOCTYPE html>
            <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="tableStyle.css">	
			<link rel="stylesheet" href="menuStyle.css">		
			<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
			<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            </head>
            <body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
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
                
            <form name="formPDF" id="formPDF" class="formPDF" style="max-width: none; width: 1045;">  
            <h2 align="center"><img src="img\logo.png" alt="Logo" width="128" height="63"><b>PEDIDO <?php ECHO $_GET['id_pedido'];?></b></h2>
                    <div class="form-group">  
                        <form name="cliente" id="cliente">  
                            <div class="table-responsive">  
                            <?php



    $link = mysqli_connect($dbhost , $dbuser, $dbpass, $db);
    
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    // Attempt select query execution
    $id_pedido = $_GET['id_pedido'];
            $sql_info_cliente = "SELECT pedidos.ID_Pedido AS Numero_Pedido,pedidos.username,
            clientes.nome_cliente,clientes.FONE, clientes.CNPJ, clientes.CEP, clientes.MUNICIPIO,
            clientes.BAIRRO, clientes.endereco, clientes.ESTADO,
            fechamento_pedido.DATA_FECH AS data_pedido, transporte.End_Entrega, transporte.End_Cobranca, clientes.insc_est,
            transporte.nome_transp, transporte.obs, transporte.n_pedido, transporte.cond_pag
            FROM pedidos
            INNER JOIN clientes ON pedidos.ID_Cliente=clientes.id_cliente
            LEFT JOIN transporte ON pedidos.ID_Pedido=transporte.ID_Pedido
            LEFT JOIN fechamento_pedido ON pedidos.ID_Pedido=fechamento_pedido.id_pedido
            WHERE pedidos.ID_Pedido=$id_pedido
            ORDER BY CAST(Numero_Pedido AS UNSIGNED)";	

            $sql_info_pedido="SELECT pedidos.ID_Pedido AS Numero_Pedido,produtos.Artigo,produtos.COD_Prod AS CODIGO
            ,produtos_pedido.desenho,produtos_pedido.variante, produtos_pedido.colecao, produtos_pedido.preco_unit, 
            produtos_pedido.quant,produtos_pedido.total, pedidos.valor_total AS VALOR_TOTAL
            FROM pedidos
            INNER JOIN produtos_pedido ON pedidos.ID_Pedido=produtos_pedido.id_pedido
            INNER JOIN produtos ON produtos.ID_Produto=produtos_pedido.id_produto
            WHERE pedidos.ID_Pedido=$id_pedido
            ORDER BY CAST(Numero_Pedido AS UNSIGNED)";										
    


    if($result = mysqli_query($link, $sql_info_cliente)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
            echo '<table class="table table-bordered" id="dynamic_field2">';
            echo '<col width="90">
            <col width="140">
            <col width="140">
            <col width="140">
            <col width="140">
            <col width="140">
            <col width="140">
            <col width="140">
            <col width="140">';
            echo '<tbody>
            <tr>                   
                <td colspan="6">Nome do Representante: <br>'.$row['username'].'</td>   
                <td colspan="2">Data do Pedido: <br> '.date("d-m-Y", strtotime($row['data_pedido'])).'</td>                       
            </tr>
            <tr>
                <td colspan="6">Cliente: <br>'.$row['nome_cliente'].'</td>
                <td colspan="2">Telefone: <br> '.$row['FONE'].'</td>
            </tr>
            <tr>
                <td colspan="6">Endereço: <br>'.$row['endereco'].'</td>
                <td colspan="2">Bairro: <br>'.$row['BAIRRO'].'</td>									
            </tr>  
            <tr>
                <td colspan="2">CEP: <br>'.$row['CEP'].'</td>
                <td colspan="4">Municipio: <br>'.$row['MUNICIPIO'].'</td>
                <td colspan="2">Estado: <br>'.$row['ESTADO'].'</td>										
            </tr>  
            <tr>
                <td colspan="2">CNPJ: <br>'.$row['CNPJ'].'</td>
                <td colspan="4">Inscrição Estadual: <br>'.$row['insc_est'].'</td>
                <td colspan="2">Transportadora: <br>'.$row['nome_transp'].'</td>										
            </tr> 
            <tr>
                <td colspan="6">Endereço de Entrega: <br>'.$row['End_Entrega'].'</td>
                <td colspan="2">CNPJ: <br>'.$row['CNPJ'].'</td>
            </tr>       
            <tr>
                <td colspan="8">Endereço de Cobrança: <br>'.$row['End_Cobranca'].'</td>
            </tr>   
            <tr>
            <td colspan="6">Observação: <br>'.$row['obs'].'</td>
            <td colspan="2">N° do Pedido: <br>'.$row['n_pedido'].'<br> Condição de Pagamento: <br>'.$row['cond_pag'].'</td>
            </tr>'
           ;	

        }
        mysqli_free_result($result);
    } else{
        echo "Não há resultados para a busca.";
    }
    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    echo'   <tr>
                <td><b><u>Artigo</b></u></td>   
                <td><b><u>Cod. Prod.</b></u></td>  
                <td><b><u>Desenho</b></u></td>  
                <td><b><u>Variante</b></u></td>  
                <td><b><u>Coleção</b></u></td>  										
                <td><b><u>Quantidade</b></u></td>    
                <td><b><u>Preço Unitario</b></u></td>    
                <td><b><u>Total</b></u></td>   										
            </tr> ';									
    if($result = mysqli_query($link, $sql_info_pedido)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $total_geral = money_format('%.2n', $row['VALOR_TOTAL']);
        echo'
            <tr>
                <td>'.$row['Artigo'].'</td>   
                <td>'.$row['CODIGO'].'</td>  
                <td>'.$row['desenho'].'</td>  
                <td>'.$row['variante'].'</td>  
                <td>'.$row['colecao'].'</td>  										
                <td>'.$row['quant'].'</td>    
                <td>'.money_format('%.2n', $row['preco_unit']).'</td>    
                <td>'.money_format('%.2n', $row['total']).'</td>   										
            </tr>';														
           											             																
            // Free result set
        }
        mysqli_free_result($result);
    } else{
        echo "Não há resultados para a busca.";
    }
    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    echo'<tr><td><b><u>TOTAL GERAL</b></u></td>
    <td>'.$total_geral.'</td>   	
    </tr>';	
    echo '</table>';

    
    // Close connection
    mysqli_close($link);
    ?>
                                </form>
    <style>  
            table {  
                font-family: Helvetica, sans-serif;  
                border-collapse: collapse;              
                width: 100%;  
                font-size: 18px;
            }  
    
            td, th {  
                border: solid;
                border-color:black;
                border-width: 1px; 
                text-align: left;  
                padding: 8px;  
            }  
    
            tr:nth-child(even) {  
                background-color: #dddddd;  
            }  
        </style> 							
                            </div>  
                        </form>  
                    </div> 
                                    <form name="ver_produto" id="ver_produto" action="relatorio.php">
                                        <input type="button" name="submit" id="submit" class="btn btn-info" value="Voltar"/> 
                                        <button onclick="exportTableToExcel('dynamic_field2')" class="btn btn-info" >Excel</button>
                                        <input type="button" id="create_pdf" class="btn btn-info" value="Gerar PDF">
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>							
                                    </form> 
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
	

    (function () {  
        var  
         form = $('.formPDF'),  
         cache_width = form.width(),  
         a4 = [595.28, 841.89]; // for a4 size paper width and height  
  
        $('#create_pdf').on('click', function () {  
            // $('body').scrollTop(0);  
            createPDF();  
            // window.print()
        });  
        //create pdf  
        function createPDF() {  
            getCanvas().then(function (canvas) {  
                var  
                 img = canvas.toDataURL("image/png"), 				 
                 doc = new jsPDF({  
                     unit: 'px',  
                     format: 'a4'  
                 });  
                doc.addImage(img, 'JPEG', 20, 20);  
                doc.save('Pedido.pdf');  
                form.width(cache_width);  
            });  
        }  
  
        // create canvas object  
        function getCanvas() {  
            form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');  
            return html2canvas(form, { 			
                imageTimeout: 2000,  
                removeContainer: true  
				
            });  
        }  
		
  
    }());  
			// menu
 $(function(){
     $(".button-collapse").sideNav();
 });
</script>  

	

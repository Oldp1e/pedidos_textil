<?php
session_start();
if(is_null($_SESSION['online'])){
	echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';
}	
if (isset($_SESSION['id_pedido']))
	unset($_SESSION['id_pedido']);
if (isset($_SESSION['checkbox_end_entrega_cliente']))
	unset($_SESSION['checkbox_end_entrega_cliente']);
if (isset($_SESSION['id_cliente']))
	unset($_SESSION['id_cliente']);

	INCLUDE '/pedidos_textil/public_html/representantes/pathing.php';  // -> Página com todos os diretórios do Site
	INCLUDE $childDirectory.$dblogin; // -> Pagína de Conexão com o Banco de dados
	INCLUDE $childDirectory.$functions;// -> Página de Funções do Site


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
			<li><a href="index.php">Menu</a><span class="hover"></span></li>
			<li><a href="novo_pedido.php">Novo Pedido</a><span class="hover"></span></li>
			<li><a href="configuracao_sistema.php">Configurações do Sistema</a><span class="hover"></span></li>
			<li><a href="logoff.php">Logoff</a><span class="hover"></span></li>
			</ul>
		</div>
		</div>
		</nav>
	

        <div class='content'>
				<div class='pagina_uso'>
				<h1>Configurações de Email</h1>
                <form action="configuracao_email.php" method="POST">
                <?php
                    $string1 = '<td><label for="usuario">Usuario: </label> <select id="usuario" name="usuario" onchange="this.form.submit()" required >';
                    $string = '<option>Selecione</option>';
                        $sqli = "SELECT username FROM usuarios";
                        $result = mysqli_query(OpenCon(), $sqli);
                        while ($row = mysqli_fetch_array($result)) {
                            $string2[] = "<option value='".utf8_encode($row['username'])."'>".utf8_encode($row['username'])."</option>";                                        
                        }
                        $string3 = '</select></td>';                     
                        $stringOptions = implode($string2);        

                        
                                                  
                        //Imprime a combo box com os resultados do Select acima na query da variavel SQLI
                        //TRECHO ABAIXO RESPONSAVEL POR LIMPAR A COMBO BOX DO VALOR COM O NOME DO USUARIO SELECIONADO SIMPLES POREM UM POUCO COMPLEXO EM EXECUCAO
                        if(isset($_POST["usuario"])){
                            $string = '<option value="'.$_POST["usuario"].'"selected>'.$_POST["usuario"].'</option>';                                     
                            $search=  "<option value='".utf8_encode($_POST['usuario'])."'>".utf8_encode($_POST['usuario'])."</option>";
                            $arraySelectIndex = array_search($search,$string2,true);                           
                            unset($string2[$arraySelectIndex]);
                            $stringOptions = implode($string2);                                                     
                        }
                        echo $string1.$string.$stringOptions.$string3;
                            echo '</form>';
                        
                            

                            if(isset($_POST["usuario"])){
                                $usuarioSelecionado = $_POST["usuario"];                                
                                $foiEnviado = true;
                                $sqli = "SELECT email_enc_1, email_enc_2 FROM usuarios WHERE username='".$usuarioSelecionado."'";                                
                                $result = mysqli_query(OpenCon(), $sqli);
                                while($row = mysqli_fetch_array($result)){
                                    $email_enc_1 = $row["email_enc_1"];
                                    $email_enc_2 = $row["email_enc_2"];
                                }
                            }

                            function debugAlert($debugString){
                                echo "
                                <script>
                                alert('".$debugString."');
                                </script>                                                                
                                ";
                            }

                            function debugEcho($debugString){
                                echo "DEBUG -> ".$debugString;
                            }
                            ?>
                            <br><br>                            
                            <label for="email_enc_1">E-mail's de Encaminhamento: </label><br>
                            <?php
                            if($foiEnviado == true){
                                echo '<input type="text" id="email_enc_1" placeholder="Email 1" value='.$email_enc_1.'>';
                                echo '<input type="text" id="email_enc_2" placeholder="Email 2" value='.$email_enc_2.'>';
                            } else{
                                echo '<input type="text" id="email_enc_1" placeholder="Email 1">';
                                echo '<input type="text" id="email_enc_2" placeholder="Email 2">';
                            }                                                       
                            ?>

                            <input type="button" id="CONFIRMA" value="CONFIRMA">



                



			</div>
		</div>


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
		</script>		
</body>
<footer class="py-4 bg-dark flex-shrink-0">
    <div class="container text-center">
      <a href="https://github.com/oldp1e" class="text-muted">Desenvolvido por Samuel P.</a>
	  <p>
	  <a href="#" class="text-muted">Layout por Alefer F.</a>
	  <br>
	  <a href="#" class="text-muted">Coordenação e Orientação Angélica e Sergio Ricardo</a>
    </div>
  </footer>
</html>

<!-- Fim Documento-->

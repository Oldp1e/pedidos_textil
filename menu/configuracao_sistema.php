<?php
    session_save_path("/pedidos_textil/tmp");
session_start();
if(is_null($_SESSION['online'])){
	// header('Location: '.'/representantes/login/index.php');
	echo '<script> location.replace("/representantes/login/index.php"); </script>';
}	
if (isset($_SESSION['id_pedido']))
	unset($_SESSION['id_pedido']);
if (isset($_SESSION['checkbox_end_entrega_cliente']))
	unset($_SESSION['checkbox_end_entrega_cliente']);
if (isset($_SESSION['id_cliente']))
	unset($_SESSION['id_cliente']);



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
			<a class="navbar-brand" href="#">BRAND TEXTIL</a>
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
		<main class="site-wrapper">
  <div class="pt-table desktop-768">
    <div class="pt-tablecell page-home relative" style="background-color: white;
    background-position: center;
    background-size: cover;">                    
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                                <div class="page-title  home text-center">
                                  <h1> CONFIGURAÇÕES DO SISTEMA
									</h1>
                                    <p class="mt20">ÁREA EXCLUSIVA DO ADMINISTRADOR <BR> CUIDADO AO UTILIZAR <BR></p>
                                </div>

                                <div class="hexagon-menu clear">
                                    <div class="hexagon-item">
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="https://enationalelectronics.com" target="_blank" class="hex-content">
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-universal-access"></i>
                                                </span>
                                                <span class="title">Representantes</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                    <div class="hexagon-item">
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="configuracao_email.php" target="_blank" class="hex-content">
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-bullseye"></i>
                                                </span>
                                                <span class="title">Configurações de Email</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                    <div class="hexagon-item">
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="clientes.php" target="_blank" class="hex-content">
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-braille"></i>
                                                </span>
                                                <span class="title">CLIENTES</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>    
                                    </div>
                                    <div class="hexagon-item">
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="https://enationalelectronics.com" target="_blank" class="hex-content">
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-id-badge"></i>
                                                </span>
                                                <span class="title">RELATORIOS</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                    <div class="hexagon-item">
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="https://enationalelectronics.com" target="_blank" class="hex-content">
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-life-ring"></i>
                                                </span>
                                                <span class="title">FEEDBACK</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                    <div class="hexagon-item">
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="https://enationalelectronics.com" target="_blank" class="hex-content">
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-clipboard"></i>
                                                </span>
                                                <span class="title">BANCO DE DADOS</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                    <div class="hexagon-item">
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="https://enationalelectronics.com" target="_blank" class="hex-content">
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-map-signs"></i>
                                                </span>
                                                <span class="title">ÁREA DO DESENVOLVEDOR</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  </main>


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

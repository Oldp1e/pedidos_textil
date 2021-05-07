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
				<div class='pagina_uso'>

							<h1>Introdução</h1>
				<p>
				<h3>Bem vindos ao sistema de cadastro de pedidos online.</h3></p>
				<p>Essa é sua área do Representante, aqui você encontra as opções de Abertura de Pedidos, Fechamento, e Relatório de Pedidos.
				<p>Para abrir um novo pedido clique no botão no menu acima "Novo Pedido" e selecione o cliente, caso o cliente não esteja aparecendo no menu para você crie um novo registro para esse cliente clicando no botão
				Novo Registro, 
				<div class="image-wrapper">
				<br><img src="img\novo_registro_cliente2.png" alt="Novo Registro 1"><br> 
				</div>
				Você deve estar munido com a Razão Social e CNPJ do Cliente.
				<div class="image-wrapper">
				<br><img src="img\novo_registro_cliente1.png" alt="Novo Registro 2"><br> 
				</div>
				<p><h1>Produtos do pedido</h1></p>
				<p> Para incluir produtos no Pedido clique no botão "+ Produto" lembrando que essa opção só irá aparecer caso selecionar o cliente na caixa de seleção de cliente, após clicar no "+ Produto" uma caixa
				extra de Produto irá aparecer, preencha-a com as informações do Pedido do Cliente.
				<div class="image-wrapper">
				<br><img src="img\novo_pedido.png" alt="+ Produto"><br>
				</div>
				<br>
				Confirme clicando no Botão Confirmar Produtos.
				<h1> Transporte </h1> <br>				
				Caso o cliente já estava previamente cadastrado e não possui endereço, ao finalizar o pedido, desmarque a caixinha de "Endereço de Entrega é o mesmo do cliente"
				<div class="image-wrapper">
				<br><img src="img\end_entrega_mesmo_cliente.png" alt="End Entrega"><br>
				</div>
				Ao desmarca-la o sistema irá pedir para que digite o endereço de entrega do Cliente, caso não queira inserir nenhum endereço e queira deixar a encargo do setor comercial a entrega deixe a caixinha de "Endereço de Entrega é o mesmo do cliente"
				marcada e coloque na observação o motivo pelo qual deixou sem endereço, no campo transportadora digite "A COMBINAR".
				<div class="image-wrapper">
				<br><img src="img\confirmar_pedido_e_enviar.png" alt="A COMBINAR"><br>
				</div>
				Não se esqueça também de definir a condição de pagamento no campo Condição de Pagamento conforme imagem abaixo:
				<div class="image-wrapper">
				<br><img src="img\condicao_pagamento.png" alt="CONDICAO PAGAMENTO"><br>
				</div>
				Após confirmar produtos será aberto um novo pedido no sistema, e ele ficara em aberto até que seja finalizado as informações de transporte, sendo preenchidas pelo próprio representante ou deixado em branco e preenchido proprio departamento
				comercial.
				Após clicar em Finalizar Pedido um e-mail será encaminhando para o assistente comercial Responsável pelo Representante com um ficha detalhada do Pedido.
				<br>Você também tem uma opção de deixar o Pedido em aberto e finalizar depois pela aba de relatórios.
				<div class="image-wrapper">
				<br><img src="img\manter_em_aberto.png" alt="MANTER EM ABERTO"><br>
				</div>
				<h1> Relatório </h1> <br>
				<p>Para verificar todos os pedidos que foram abertos pelo representante, clique no botão "Relatório" do menu acima, nele você encontrará um resumo de todos os pedidos que foram abertos e finalizados, podendo através do botão "finalizar pedido"
				finalizar os pedidos em Aberto e enviar o email automaticamente para o setor responsável.
				<div class="image-wrapper">
				<br><img src="img\relatórios.png" alt="MANTER EM ABERTO"><br>
				</div>

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

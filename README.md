# Sistema de Abertura de Pedidos Online - Versão Open Source
  Sistema de Pedidos Online Versão Open Source
  Abrindo uma versão Open Source de meu sistema de Pedidos Online, ainda é necessário arrumar os caminhos das pastas, porém o sistema inteiro está funcionando.
  Caso queira utilizar basta efetuar o download do repositório e ir editando os caminhos de acordo, as imagens e logos do sistema precisam ser alterados para imagens que já tenha.
  Para utilizar é necessário importar o banco de dados disponivel no arquivo SQL.
  
  Para utilizar o sistema é necessário criar um usuário diretamente no Banco, pois subi o BD limpo, sem dado algum.
  
  A tabela de usuarios se encontra no banco com o nome "usuarios"
  
  Usuario Padrão de Login
  
  nivel_perm: representante  
  username: representante  
  password: sys123%  
- - - -
# Configurando Envio de Emails ao Finalizar Pedido

Você irá encontrar todas as funções principais do sistema no arquivo functions.php, nele você poderá editar as configuraçõs do PHP Mailer com o provedor e email de sua preferencia.

- - - -
# Configurando Páginas
O caminho mais importante é o caminho do Login do Banco tenha certeza de que estão todos os caminhos configurados corretamente no pathing.php.

- - - -
# Resumo do Sistema - Comentários do Desenvolvedor
A abertura do pedido é feita por um usuário com o nível de permissão "representante", esse usuário possui autorização no sistema para abrir, alterar e excluir pedidos abertos por ele mesmo, inicialmente é selecionado o cliente com o qual ele irá abrir o pedido, automaticamente o sistema irá dar um retrieve nas informações do Banco de Dados daquele cliente e exibir na tela para o usuário. Após selecionado o cliente o Javascript irá liberar a janela de inserção de produtos do pedido, onde o usuário pode cadastrar os produtos que irão ser incluidos nesse pedido, nele o usuário pode selecionar os detalhes de cada produtos desde artigo, até preço unitário, foi feita de tal forma que caso o usuário quisesse definir valores unítarios especifícios para cada artigo ele conseguisse sem depender de alterações individuais para cada artigo. 
Após a inserção dos produtos o usuário confirma a ação e é encaminhando para a tela de finalização/transporte, nela ele pode escolher se irá finalizar agora ou se deseja manter o pedido em aberto. Caso ele opte por finalizar o pedido o usuário será encaminhado para a tela de confirmação onde constará os detalhes do pedido finalizado, bem como o e-mail para o qual o pedido foi encaminhado. Os emails de encaminhamento do pedido são configurados através do painel do administrador onde é possível selecionar o usuário e quais serão as caixas de entrada que irão receber pedidos deste usuário. Toda a programação de e-mails foi feita através da Classe Open Source do PHP Mailer. Na tela de finalização o usuário também preenche todas as informações com relação a entrega do pedido, tendo a opção de utilizar os mesmos dados de entrega do cliente ou de colocar um endereço completamente novo. Ao clicar em finalizar pedido será encaminhando um e-mail para o assistente comercial configurado, ele irá receber um resumo do pedido com detalhes e um link de redirecionamento para a ficha principal do pedido, onde ele tem a opção de exportar para Excel, CSV e/ou gerar um PDF para consulta do pedido.

# Estrutura do Projeto e Ferramentas utilizadas
O Projeto foi Desenvolvido utilizando no Backend PHP e Javascript, no Frontend HTML5, CSS, SCSS, JQUERY e AJAX. Na pasta principal do projeto se encontram as classes principais bem como a página núcleo do sistema, á pagina de funções, chama de functions.php, nela escrevi todas as funções que são utilizadas no sistema desde a execução de rotinas no MySQL até o Envio de E-mails da Classe do PHP Mailer. Todas as páginas do site estão com a extensão de arquivo (.php) por ser a linguagem principal que optei por utilizar no backend, a área do representante é divida em 6 páginas com 5 etapas desde abertura do pedido até á finalização.


ABERTURA/FECHAMENTO DE PEDIDOS
 1 - novo_pedido.php
 2 - confirma_produtos.php
 3 - transporte.php
 4 - fechamento_pedido.php
 4.1 - fechamento_pedido_em_aberto.php
 5 - ficha_pedido.php
 


# Planejamento
Inicialmente foi feito um Fluxograma no Site Draw.io onde pude juntamente com o setor organizar a lógica do sistema e modelar o banco de dados.
Após o Fluxograma ser desenvolvido foi dado inicio ao desenvolvimento do sistema.

# Desenvolvimento
A linguagem utilizada para o desenvolvimento do Backend do sistema foi o PHP 7, onde pude atraves dela resolver a maioria dos problemas lógicos que foram surgindo ao longo do desenvolvimento, criei um Framework proprio que está localizado na pagina de principal de funções localizada no representantes/functions.php onde se encontra a maioria das funções utilizadas no sistema, desde inserção de dados no banco até funções de verificação, debug, logs e utilização de classes externas como PHP Mailer.

# Design
O Design atual do sistema foi desenvolvido utilizado em grande parte CSS e nas animações/funções mais complexas Javascript, onde para que fossem feitas certas páginas precisei combinar PHP com JS e utilizar o JSON_ENCODE para converter strings do PHP para o JS, onde consegui um resultado bem otimizado e limpo na hora de exibir certas requisições do banco.


# Funcionamento e Explicação do Sistema

 Para abrir um novo pedido clique no botão no menu do usuário chamado "Novo Pedido" e selecione o cliente, caso o cliente não esteja aparecendo no menu crie um novo registro para esse cliente clicando no botão Novo Registro,
![alt text](http://brandtextil.com.br/representantes/menu_representantes/img/novo_registro_cliente2.png)

Você deve estar munido com a Razão Social e CNPJ do Cliente.

![alt text](http://brandtextil.com.br/representantes/menu_representantes/img/novo_registro_cliente1.png)

Produtos do pedido
Para incluir produtos no Pedido clique no botão "+ Produto" lembrando que essa opção só irá aparecer caso selecionar o cliente na caixa de seleção de cliente, após clicar no "+ Produto" uma caixa extra de Produto irá aparecer, preencha-a com as informações do Pedido do Cliente.

![alt text](http://brandtextil.com.br/representantes/menu_representantes/img/novo_registro_cliente2.png)

Confirme clicando no Botão Confirmar Produtos.
Transporte

Caso o cliente já estava previamente cadastrado e não possui endereço, ao finalizar o pedido, desmarque a caixinha de "Endereço de Entrega é o mesmo do cliente"

![alt text](http://brandtextil.com.br/representantes/menu_representantes/img/confirmar_pedido_e_enviar.png)

Ao desmarca-la o sistema irá pedir para que digite o endereço de entrega do Cliente, caso não queira inserir nenhum endereço e queira deixar a encargo do setor comercial a entrega deixe a caixinha de "Endereço de Entrega é o mesmo do cliente" marcada e coloque na observação o motivo pelo qual deixou sem endereço, no campo transportadora digite "A COMBINAR".

![alt text](http://brandtextil.com.br/representantes/menu_representantes/img/manter_em_aberto.png)

Relatório

Para verificar todos os pedidos que foram abertos pelo representante, clique no botão "Relatório" do menu acima, nele você encontrará um resumo de todos os pedidos que foram abertos e finalizados, podendo através do botão "finalizar pedido" finalizar os pedidos em Aberto e enviar o email automaticamente para o setor responsável.

![alt text](http://samuelwebdev.com/portfolio/images/ultima_imagem.png)



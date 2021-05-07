SELECT pedidos.ID_Pedido, clientes.ID_Cliente,pedidos.username,produtos.Artigo,produtos.COD_Prod,
produtos_pedido.id_pedido,produtos_pedido.desenho,produtos_pedido.variante, produtos_pedido.colecao, produtos_pedido.total, clientes.nome_cliente
FROM pedidos
INNER JOIN produtos_pedido ON pedidos.ID_Pedido=produtos_pedido.id_pedido
INNER JOIN clientes ON pedidos.ID_Cliente=clientes.id_cliente
INNER JOIN produtos ON produtos.ID_Produto=produtos_pedido.id_produto
WHERE pedidos.ID_Pedido=3
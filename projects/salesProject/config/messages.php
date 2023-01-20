<?php
return [
    'errorLogin' => ['message' => 'As credenciais fornecidas estão incorretas.', 'statusCode' => 422],
    'unavailableService' => ['message' => 'Serviço indisponível no momento. Por favor, tente mais tarde.', 'statusCode' => 500],
    'saleValueNotAccepted' => ['message' => 'O valor da venda é inválido.', 'statusCode' => 422],
    'errorRegisteringSale' => ['message' => 'Somente perfil vendor pode lançar venda.', 'statusCode' => 403],
    'errorViewSaleSalesman' => ['message' => 'Não há permissão para visualizar vendas de outros vendedores.', 'statusCode' => 403],
    'errorViewSaleSalesmanByUnity' => ['message' => 'Não há permissão para visualizar vendas de vendedores de outras unidades.', 'statusCode' => 403],
    'errorViewSaleSalesmanByDirector' => ['message' => 'Não há permissão para visualizar vendas de vendedores de outra diretoria.', 'statusCode' => 403],
    'errorViewSaleByUnity' => ['message' => 'Não há permissão para visualizar vendas de outras unidades.', 'statusCode' => 403],
    'errorViewSaleByDirector' => ['message' => 'Não há permissão para visualizar vendas de outra diretoria.', 'statusCode' => 403],
    'cantSeeSale' => ['message' => 'Não há permissão para visualizar essa venda.', 'statusCode' => 403],
    'saleCreated' => ['message' => 'Venda lançada com sucesso.', 'statusCode' => 200],

];

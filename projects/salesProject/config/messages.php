<?php
return [
    'errorLogin' => ['message' => 'As credenciais fornecidas estão incorretas.', 'statusCode' => 422],
    'unavailableService' => ['message' => 'Serviço indisponível no momento. Por favor, tente mais tarde.', 'statusCode' => 500],
    'saleValueNotAccepted' => ['message' => 'O valor da venda é inválido.', 'statusCode' => 422],
    'errorRegisteringSale' => ['message' => 'Somente perfil vendor pode lançar venda.', 'statusCode' => 401],
    'saleCreated' => ['message' => 'Venda lançada com sucesso.', 'statusCode' => 200],

];

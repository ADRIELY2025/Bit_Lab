<?php
#Importa a clase AppFactory do Slim Framework, responsavel por criar a instancia da aplicação.
use Slim\Factory\AppFactory;

#carrega automaticamente todas as dependencias instaladas via Composer (incluindo Slim e outras bibliotecas).
#sem esse autoload, o framaework e as classes utilizadas no projeto não poderam ser encontradas.
require __DIR__ . '/../vendor/autoload.php';

#cria a aplicação Slim, retornando um objeto que representa o servidor HTP e gerenciador de rotas
$app = AppFactory::create();

#adiciona o mideeleware responsavel por interpretar as rotas e direcionar cada requisição HTP para a rota correta.
#Sem este middeware, o Slim não seberia como "ler" ou processar as rotas definidas na aplicação.
$app->addRoutingMiddleware();

$errorMIddleware = $app->addErrorMiddleware(true, true, true);

require __DIR__ . '/../app/helper/settings.php';
require __DIR__ . '/../app/route/route.php';

$app->run();
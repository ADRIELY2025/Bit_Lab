<?php

use app\controller\User;
use app\controller\Cliente;
use app\controller\Empresa;
use app\controller\Fornecedor;
use app\controller\Home;
use app\controller\Login;
use app\middleware\Middleware;
use Slim\Routing\RouteCollectorProxy;

$app->get('/', Home::class . ':home')->add(Middleware::autentication());
$app->get('/home', Home::class . ':home')->add(Middleware::autentication());
$app->get('/login', Login::class . ':login');


$app->group('/login', function (RouteCollectorProxy $group) {
    $group->post('/precadastro', Login::class . ':precadastro');
    $group->post('/autenticar', Login::class . ':autenticar');
});

$app->group('/usuario', function (RouteCollectorProxy $group) {
    $group->get('/lista', User::class . ':lista')->add(Middleware::autentication());
    $group->get('/cadastro', User::class . ':cadastro')->add(Middleware::autentication());
    $group->post('/listuser', User::class . ':listuser');
    $group->post('/insert', User::class . ':insert');
    $group->post('/delete', User::class . ':delete');
});

$app->group('/cliente', function (RouteCollectorProxy $group) {
    $group->get('/lista', Cliente::class . ':lista')->add(Middleware::autentication());
    $group->get('/cadastro', Cliente::class . ':cadastro')->add(Middleware::autentication());
    $group->post('/listcliente', Cliente::class . ':listcliente');
    $group->post('/insert', Cliente::class . ':insert');
    $group->post('/delete', Cliente::class . ':delete');
});

$app->group('/empresa', function (RouteCollectorProxy $group) {
    $group->get('/lista', Empresa::class . ':lista')->add(Middleware::autentication());
    $group->get('/cadastro', Empresa::class . ':cadastro')->add(Middleware::autentication());
    $group->post('/listempresa', Empresa::class. ':listempresa');
    $group->post('/insert', Empresa::class. ':insert');
    $group->post('/delete', Empresa::class. ':delete');
});

$app->group('/fornecedor', function (RouteCollectorProxy $group) {
    $group->get('/lista', Fornecedor::class . ':lista')->add(Middleware::autentication());
    $group->get('/cadastro', Fornecedor::class . ':cadastro')->add(Middleware::autentication());
    $group->post('/listfornecedor', Fornecedor::class . ':listfornecedor');
    $group->post('/insert', Fornecedor::class . ':insert');
    $group->post('/delete', Fornecedor::class . ':delete');
});
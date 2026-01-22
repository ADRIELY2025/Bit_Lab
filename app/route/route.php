<?php

use app\controller\User;
use app\controller\cliente;
use app\controller\Empresa;
use app\controller\Home;
use app\controller\Fornecedor;
use app\controller\Login;
use app\middleware\Middleware;
use Slim\Routing\RouteCollectorProxy;


$app->get('/', Home::class . ':home');
$app->get('/home', Home::class . ':home')->add(Middleware::authentication());
$app->get('/login', Login::class . ':login');


$app->group('/login', function (RouteCollectorProxy $group) {
    $group->post('/precadastro', Login::class . ':precadastro');
    $group->post('/autenticar', Login::class . ':autenticar');
    $group->post('/recuperar', Login::class . ':recuperar');
    $group->post('/verificarCodigo', Login::class . ':verificarCodigo');
    $group->post('/atualizarSenha', Login::class . ':atualizarSenha');
});
$app->group('/usuario', function (RouteCollectorProxy $group) {
    $group->get('/lista', User::class . ':lista')->add(Middleware::authentication());
    $group->get('/cadastro', User::class . ':cadastro')->add(Middleware::authentication());
    $group->post('/listuser', User::class . ':listuser');
    $group->post('/update', User::class . ':update');
    $group->post('/insert', User::class . ':insert');
    $group->get('/alterar/{id}', User::class . ':alterar')->add(Middleware::authentication());
    $group->post('/delete', User::class . ':delete');
});
    
$app->group('/cliente', function (RouteCollectorProxy $group) {
    $group->get('/lista', Cliente::class . ':lista')->add(Middleware::authentication());
    $group->get('/cadastro', Cliente::class . ':cadastro')->add(Middleware::authentication());
    $group->post('/listcliente', Cliente::class . ':listcliente');
    $group->post('/update', Cliente::class . ':update');
    $group->post('/insert', Cliente::class . ':insert');
    $group->get('/alterar/{id}', Cliente::class . ':alterar')->add(Middleware::authentication());
    $group->post('/delete', Cliente::class . ':delete');
});
$app->group('/empresa', function (RouteCollectorProxy $group) {
    $group->get('/lista', Empresa::class . ':lista')->add(Middleware::authentication());
    $group->get('/cadastro', Empresa::class . ':cadastro')->add(Middleware::authentication());
    $group->post('/listempresa', Empresa::class . ':listempresa');
    $group->post('/update', Empresa::class . ':update');
    $group->post('/insert', Empresa::class . ':insert');
    $group->get('/alterar/{id}', Empresa::class . ':alterar')->add(Middleware::authentication());
    $group->post('/delete', Empresa::class . ':delete');
});

$app->group('/fornecedor', function (RouteCollectorProxy $group) {
    $group->get('/lista', Fornecedor::class . ':lista')->add(Middleware::authentication());
    $group->get('/cadastro', Fornecedor::class . ':cadastro')->add(Middleware::authentication());
    $group->post('/listfornecedor', Fornecedor::class . ':listfornecedor');
    $group->post('/update', Fornecedor::class . ':update');
    $group->post('/insert', Fornecedor::class . ':insert');
    $group->get('/alterar/{id}', Fornecedor::class . ':alterar')->add(Middleware::authentication());
    $group->post('/delete', Fornecedor::class . ':delete');
});

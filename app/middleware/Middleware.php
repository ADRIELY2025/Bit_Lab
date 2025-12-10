<?php

namespace app\middleware;

use app\database\builder\SelectQuery;

class Middleware
{
    public static function autentication()
    {
        # Retorna uma closure (função anônima) que será executada para cada requisição
        $middleware = function ($request, $handler) {
            #A linha $handler->handle($request) é como dizer: "Continua o processo!" - 
            #ela passa a bola para o próximo jogador do time até chegar no gol (resposta final). 🎯
            $response = $handler->handle($request);
            # Captura o método HTTP da requisição (GET, POST, PUT, DELETE, etc.)
            $method = $request->getMethod();
            # Captura a URI da página solicitada pelo usuário (ex: '/login', '/dashboard')
            $pagina = $request->getRequestTarget();
            # Verifica se o método da requisição é GET
            if ($method === 'GET') {
                # Verifica se o usuário NÃO está autenticado
                # Condições: sessão vazia OU flag 'logado' false OU inexistente
                $usuarioLogado = empty($_SESSION['usuario']) || empty($_SESSION['usuario']['logado']);
                # Se usuário não está logado E não está tentando acessar a página de login
                if ($usuarioLogado && $pagina !== '/login') {
                    # Destroi a sessão para limpar qualquer dado residual
                    session_destroy();
                    # Redireciona para a página de login com status HTTP 302 (redirecionamento temporário)
                    return $response->withHeader('Location', '/login')->withStatus(302);
                }
                # Se a página solicitada é a de login
                if ($pagina === '/login') {
                    # Verifica se o usuário JÁ está autenticado
                    if (!$usuarioLogado) {
                        # Se já está logado, redireciona para a home (evita acesso desnecessário ao login)
                        return $response->withHeader('Location', '/')->withStatus(302);
                    }
                }

                if (empty($_SESSION['usuario']['ativo']) or !$_SESSION['usuario']['ativo']) {
                    session_destroy();
                    return $response->withHeader('Location', '/login')->withStatus(302);
                }
            }
            return $handler->handle($request);                  # Se não está logado, destroi qualquer sessão residual
        };
        return $middleware;                                   # Retorna a função middleware para ser usada nas rotas
    }
}

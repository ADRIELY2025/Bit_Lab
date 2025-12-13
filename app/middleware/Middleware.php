<?php

namespace app\middleware;

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
            if ($method == 'GET') {
                # se o usuario esta logado, regenera o id da sessão para renovar o tempo de expiração do cookie. 
                if (isset($_SESSION['usuario']) && boolval($_SESSION['usuario']['logado'])) {
                    # o parametro true remove o arquivo de sessão antigo do servidor.
                    session_regenerate_id(true);
                }
                #Se ja esta logado e tenta acessar /login, redireciona para HOME.
                if ($pagina == '/login' && isset($_SESSION['usuario']) && boolval($_SESSION['usuario']['logado'])) {
                    return $response->withHeader('Location', HOME)->withStatus(302);
                }
                #sE NÃO ESTIVER LOGADO E NÃO ESTA TENTANDO ACESSAR /LOGIN, REDIRECIONA PARA LOGIN
                if ((empty($_SESSION['usuario']) || !boolval($_SESSION['usuario']['logado'])) && $pagina != '/login') {
                    session_destroy();
                    return $response->withHeader('Location', HOME . '/login')->withStatus(302);
                }
            }
            return $response;
        };
        return $middleware;
    }
}

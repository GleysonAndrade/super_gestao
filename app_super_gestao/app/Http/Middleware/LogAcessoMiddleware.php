<?php

namespace App\Http\Middleware;

use App\LogAcesso;
use Closure;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        //recuperar o IP
        $ip = $request->server->get('REMOTE_ADDR');

        //recuperar a rota
        $rota = $request->getRequestUri();

        LogAcesso::create(['log' => "IP $ip requisitou a rota $rota"]);

        //$request - manipular
        //return $next($request);

        $resposta = $next($request);

        $resposta->setStatusCode(201, 'O status da resposta e o texto da resposta foram modificados');
        
        return $next($request);
    }
}

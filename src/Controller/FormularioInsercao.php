<?php

namespace Erick\Sistema\Controller;

use Erick\Sistema\Helper\RenderizadorDeHtmlTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioInsercao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('ordem/formulario.php', [
            'titulo' => 'Nova Ordem de Serviço'
        ]);
        return new Response(200, [], $html);
    }
}

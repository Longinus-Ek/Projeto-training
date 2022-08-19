<?php

namespace Erick\Sistema\Controller;

use Erick\Sistema\Helper\RenderizadorDeHtmlTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioCadastro implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('cadastro/formulario.php', [
            'titulo' => 'Cadastro novo Usuario'
        ]);

        return new Response(200, [], $html);
    }
}
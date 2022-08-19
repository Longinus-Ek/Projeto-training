<?php

namespace Erick\Sistema\Controller;

use Nyholm\Psr7\Response;
use Erick\Sistema\Entity\Ordem;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Erick\Sistema\Helper\RenderizadorDeHtmlTrait;

class ListarOrdens implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $repositorioDeOrdens;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeOrdens = $entityManager
            ->getRepository(Ordem::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('ordens/listar-ordens.php', [
            'ordens' => $this->repositorioDeOrdens->findAll(),
            'titulo' => 'Ordens de Serviço',
        ]);

        return new Response(200, [], $html);
    }
}

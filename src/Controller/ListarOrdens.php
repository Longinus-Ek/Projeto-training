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

    private $repositorioDeCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeCursos = $entityManager
            ->getRepository(Ordem::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('ordens/listar-ordens.php', [
            'Ordens' => $this->repositorioDeCursos->findAll(),
            'titulo' => 'Ordens de Serviço',
        ]);

        return new Response(200, [], $html);
    }
}

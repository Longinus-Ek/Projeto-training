<?php

namespace Erick\Sistema\Controller;

use Nyholm\Psr7\Response;
use Erick\Sistema\Entity\Usuario;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CursosJson implements RequestHandlerInterface
{
    private $repositorioDeCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {   
        $this->respositorioDeCursos = $entityManager->getRepository(Usuario::class);
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->respositorioDeCursos->findAll();
        return new Response(200, ['Content-type' => 'application/json'], json_encode($cursos));
    }
}
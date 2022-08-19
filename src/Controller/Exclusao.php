<?php

namespace Erick\Sistema\Controller;

use Nyholm\Psr7\Response;
use Erick\Sistema\Entity\Ordem;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Erick\Sistema\Helper\FlashMessageTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Exclusao implements RequestHandlerInterface
{
    use FlashMessageTrait;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/listar-ordens']);
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'Curso inexistente');
            return $resposta;
        }

        $ordem = $this->entityManager->getReference(
            Ordem::class,
            $id
        );
        $this->entityManager->remove($ordem);
        $this->entityManager->flush();
        $this->defineMensagem('success', 'Ordem excluída com sucesso');

        return $resposta;
    }
}

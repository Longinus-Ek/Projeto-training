<?php

namespace Erick\Sistema\Controller;

use Nyholm\Psr7\Response;

use Erick\Sistema\Entity\Ordem;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Erick\Sistema\Helper\FlashMessageTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class Persistencia implements RequestHandlerInterface
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
        $descricao = filter_var(
            $request->getParsedBody()['descricao'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $ordem = new Ordem();
        $ordem->setOrdem($descricao);

        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );
        
        $tipo = 'success';
        if (!is_null($id) && $id !== false) {
            $ordem->setId($id);
            $this->entityManager->merge($ordem);
            $this->defineMensagem($tipo, 'Ordem atualizada com sucesso');
        } else {
            $this->entityManager->persist($ordem);
            $this->defineMensagem($tipo, 'Ordem inserida com sucesso');
        }

        $this->entityManager->flush();

        return new Response(302, ['Location' => '/listar-ordens']);
    }
}

<?php

namespace Erick\Sistema\Controller;



use Nyholm\Psr7\Response;
use Erick\Sistema\Entity\Ordem;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Erick\Sistema\Helper\FlashMessageTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Erick\Sistema\Helper\RenderizadorDeHtmlTrait;

class FormularioEdicao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait, FlashMessageTrait;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioOrdens;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioOrdens = $entityManager
            ->getRepository(Ordem::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/listar-ordens']);
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'ID de curso inválido');
            return $resposta;
        }

        $ordem = $this->repositorioOrdens->find($id);

        $html = $this->renderizaHtml('ordens/formulario.php', [
            'ordem' => $ordem,
            'titulo' => 'Alterar curso ' . $ordem->getDescricao(),
        ]);

        return new Response(200, [], $html);
    }
}

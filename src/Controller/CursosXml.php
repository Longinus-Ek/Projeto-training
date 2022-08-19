<?php 

namespace Erick\Sistema\Controller;

use SimpleXMLElement;
use Nyholm\Psr7\Response;
use Erick\Sistema\Entity\Ordem;
use Erick\Sistema\Entity\Usuario;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class OrdensXml implements RequestHandlerInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->respositorioDeCursos = $entityManager->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        
        $ordens = $this->respositorioDeCursos->findAll();
        $ordensEmXml = new SimpleXMLElement('<ordens/>');

        foreach($ordens as $curso){
            $ordemEmXml = $ordensEmXml->addChild('curso');
            $ordemEmXml->addChild('id', $ordens->getId());
            $ordemEmXml->addChild('descricao', $ordens->getDescricao());
        }
        return new Response(200, ['Content-Type' => 'application/xml'], $ordemEmXml->asXML());
    }
    
}


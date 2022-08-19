<?php 

namespace Erick\Sistema\Controller;

use Erick\Sistema\Entity\Usuario;
use Erick\Sistema\Helper\FlashMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CadastrarUsuario implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeUsuarios = $entityManager
            ->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $redirecionamentoLogin = new Response(302, ['Location' => '/login']);
        $redirecionamentoCadastro = new Response(302, ['Location' => '/cadastrar-usuario']);

        $email = filter_var(
            $request->getParsedBody()['email'],
            FILTER_VALIDATE_EMAIL
        );

        $senha = filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $senha2 = filter_input(
            INPUT_POST,
            'senha2',
            FILTER_SANITIZE_SPECIAL_CHARS
        );
        
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $usuario = $this->repositorioDeUsuarios->findOneBy(['email' => $email]);

        if(!is_null($usuario)){
            $this->defineMensagem('danger', 'E-mail já está cadastrado');

            return $redirecionamentoCadastro;
        } else {
            $usuario = new Usuario();
            $usuario->setEmail($email);
        }
        
        if($senha !== $senha2){
            $this->defineMensagem('danger', 'As senhas não são iguais');

            return $redirecionamentoCadastro;

        } else {
            $senha = password_hash($senha, PASSWORD_ARGON2I); //Criptografando senha
            $usuario->setSenha($senha);
            
        }

        if(!is_null($id) && !$id == false){
            $id++;
            return $redirecionamentoCadastro;

        } else {
            $usuario->setId($id);
            $this->defineMensagem('sucess', 'Usuario criado com sucesso');
        }
        
        $this->entityManager->persist($usuario);
        $this->entityManager->flush();

        return $redirecionamentoLogin;

    }
}
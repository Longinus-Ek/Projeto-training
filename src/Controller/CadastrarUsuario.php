<?php 

namespace Erick\Sistema\Controller;

use PDO;
use Nyholm\Psr7\Response;
use Erick\Sistema\Entity\Usuario;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Erick\Sistema\Helper\FlashMessageTrait;
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
        $redirecionamentoCadastro = new Response(302, ['Location' => '/cadastro']);
        
        $email = filter_input(
            INPUT_POST,
            'email',
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

        $encontraEmail = $this->repositorioDeUsuarios->findOneBy(['email' => $email]);

        if(!is_null($encontraEmail)){
            $this->defineMensagem('danger', 'E-mail já está cadastrado');

            return $redirecionamentoCadastro;
        }  
    
        if(strlen(trim($senha)) < 6  && strlen(trim($senha2)) < 6 ){
            $this->defineMensagem('danger', 'Insira uma senha maior que 6 digitos');
            
            return $redirecionamentoCadastro;
        }

        if($senha !== $senha2){
            
            $this->defineMensagem('danger', 'As senhas não são iguais');
           
            return $redirecionamentoCadastro;
        }

        $senha = password_hash($senha, PASSWORD_ARGON2I); //Criptografando senha
        //Conecxão banco via PDO
        $caminhoBanco = __DIR__ . '/../../db.sqlite';
        $pdo = new PDO(dsn: 'sqlite:' . $caminhoBanco);

        $sqlInsert = ("INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha');");
        $pdo->exec($sqlInsert);
       
        $this->defineMensagem('sucess', 'Usuario criado com sucesso');

        return $redirecionamentoCadastro;

    }
}
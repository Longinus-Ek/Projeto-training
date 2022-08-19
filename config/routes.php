<?php

use Erick\Sistema\Controller\Deslogar;
use Erick\Sistema\Controller\Exclusao;
use Erick\Sistema\Controller\CursosXml;
use Erick\Sistema\Controller\CursosJson;
use Erick\Sistema\Controller\ListarOrdens;
use Erick\Sistema\Controller\Persistencia;
use Erick\Sistema\Controller\RealizarLogin;
use Erick\Sistema\Controller\FormularioLogin;
use Erick\Sistema\Controller\CadastrarUsuario;
use Erick\Sistema\Controller\FormularioEdicao;
use Erick\Sistema\Controller\FormularioCadastro;
use Erick\Sistema\Controller\FormularioInsercao;

return [
    '/listar-ordens' => ListarOrdens::class,
    '/nova-ordem' => FormularioInsercao::class,
    '/salvar-ordem' => Persistencia::class,
    '/excluir-ordem' => Exclusao::class,
    '/alterar-ordem' => FormularioEdicao::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizarLogin::class,
    '/logout' => Deslogar::class,
    '/cursosEmJson' => CursosJson::class,
    '/cursosEmXml' => CursosXml::class,
    '/cadastro' => FormularioCadastro::class,
    '/realiza-cadastro' => CadastrarUsuario::class
];


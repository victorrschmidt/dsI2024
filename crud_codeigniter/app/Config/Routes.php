<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*
 * Login
 */
// Telas
$routes->get('/login', 'Login::login');
$routes->get('/criar_conta', 'Login::criarConta');

// Funções
$routes->post('/validar_login', 'Login::validarLogin');
$routes->post('/validar_conta', 'Login::validarConta');
$routes->get('/logout', 'Login::logout');

/*
 * Menus
 */
// Telas
$routes->get('/menu', 'Home::menu');
$routes->get('/meus_livros', 'Home::meusLivros');

// Funções
$routes->post('/alugar_livro', 'Home::alugarLivro');
$routes->post('/devolver_livro', 'Home::devolverLivro');

/*
 * Admin
 */
// Telas
$routes->get('/menu_admin', 'Admin::menuAdmin');
$routes->get('/usuarios', 'Admin::usuarios');
$routes->get('/editar', 'Admin::editar');
$routes->get('/adicionar', 'Admin::adicionar');

// Funções
$routes->post('/adicionar_livro', 'Admin::adicionarLivro');
$routes->post('/editar_livro', 'Admin::editarLivro');
$routes->post('/excluir_livro', 'Admin::excluirLivro');
$routes->post('/remover_usuario', 'Admin::removerUsuario');
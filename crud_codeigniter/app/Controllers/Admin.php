<?php

namespace App\Controllers;

use App\Models\LivrosModel;
use App\Models\UsuariosModel;
use App\Models\AlugueisModel;
use App\Libraries\Ordenacao;

/*
 * Controller para gerenciar os menus e funções de administrador
 */
class Admin extends BaseController
{   
    public function menuAdmin()
    {   
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário admin logado
        if (!$session->ID || $session->TIPO !== 'A') {
            return redirect()->to(base_url().'login');
        }

        $db = new LivrosModel();

        $data = [
            'EMAIL'    => $session->EMAIL,
            'NOME'     => $session->NOME,
            'ORDENADO' => false,
            'LIVROS'   => $db
        ];

        // Ordenação dos livros
        $request = $this->request->getGet();

        // Se foi solicitado um parâmetro de ordenação
        if (isset($request['ordem'])) {
            $ordem = Ordenacao::$ORDENACAO[$request['ordem']];

            $data['LIVROS'] = $data['LIVROS']->orderBy($ordem['coluna'], $ordem['parametro']);
            $data['ORDENADO'] = true;
            $data[$request['ordem']] = true;
        }
        // Ordenar por pesquisa
        else if (isset($request['pesquisa'])) {
            $data['LIVROS'] = $data['LIVROS']->like('titulo', $request['pesquisa']);
            $data['PESQUISA'] = $request['pesquisa'];
        }

        $data['LIVROS'] = $data['LIVROS']->findAll();

        if ($session->MENSAGEM) {
            $data['MENSAGEM'] = $session->MENSAGEM;
            $session->remove('MENSAGEM');
        }
       
        return view('menu_admin', $data);
    }

    public function usuarios()
    {
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário admin logado
        if (!$session->ID || $session->TIPO !== 'A') {
            return redirect()->to(base_url().'login');
        }

        $db = new UsuariosModel();

        $data = [
            'EMAIL'    => $session->EMAIL,
            'NOME'     => $session->NOME,
            'ORDENADO' => false,
            'USUARIOS' => $db->where('tipo !=', 'A')
        ];

        // Ordenação dos usuários
        $request = $this->request->getGet();

        // Se foi solicitado um parâmetro de ordenação
        if (isset($request['ordem'])) {
            $ordem = Ordenacao::$ORDENACAO[$request['ordem']];

            $data['USUARIOS'] = $data['USUARIOS']->orderBy($ordem['coluna'], $ordem['parametro']);
            $data['ORDENADO'] = true;
            $data[$request['ordem']] = true;
        }
        // Ordenar por pesquisa
        else if (isset($request['pesquisa'])) {
            $data['USUARIOS'] = $data['USUARIOS']->like('nome', $request['pesquisa']);
            $data['PESQUISA'] = $request['pesquisa'];
        }

        $data['USUARIOS'] = $data['USUARIOS']->findAll();

        if ($session->MENSAGEM) {
            $data['MENSAGEM'] = $session->MENSAGEM;
            $session->remove('MENSAGEM');
        }
        
        return view('usuarios', $data);
    }

    public function adicionar()
    {
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário admin logado
        if (!$session->ID || $session->TIPO !== 'A') {
            return redirect()->to(base_url().'login');
        }
    
        return view('adicionar', $data);
    }

    public function editar()
    {   
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário admin logado
        if (!$session->ID || $session->TIPO !== 'A') {
            return redirect()->to(base_url().'login');
        }
        
        // Informações do livro
        $data = $this->request->getGet();

        // A página carregou a partir de um get direto
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $session->set($key, $value);  
            }
        }
        // A página carregou por um erro de edição
        else {
            $data = [
                'id'         => $session->id,
                'titulo'     => $session->titulo,
                'quantidade' => $session->quantidade,
                'ano'        => $session->ano,
                'editora'    => $session->editora,
                'autor'      => $session->autor
            ];
        }

        $data['EMAIL'] = $session->EMAIL;
        $data['NOME'] = $session->NOME;

        if ($session->EDIT_ERROR) {
            $data['TITULO_ERROR'] = true;
            $data['TITULO_ERROR_DESC'] = $session->TITULO_ERROR_DESC;

            $session->remove('EDIT_ERROR');
            $session->remove('TITULO_ERROR_DESC');
        }
        
        $session->set('MENSAGEM', 'Livro editado com sucesso!');

        return view('editar', $data);
    }

    public function adicionarLivro()
    {

    }

    public function editarLivro()
    {   
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário admin logado
        if (!$session->ID || $session->TIPO !== 'A') {
            return redirect()->to(base_url().'login');
        }

        // Informações do livro
        $request = $this->request->getPost();

        // Verificar se o titulo do livro já existe no banco de dados
        $db = new LivrosModel();
        $result = $db->where('titulo', $request['titulo'])->first();

        // Se existe outro livro com o mesmo título
        if (!empty($result) && $result['titulo'] === $request['titulo'] && $result['id'] !== $request['id']) {
            $session->set('EDIT_ERROR', true);
            $session->set('TITULO_ERROR_DESC', $request['titulo']);

            return redirect()->to(base_url().'editar');
        }

        $livro_editado = [
            'titulo'     => $request['titulo'],
            'quantidade' => $request['quantidade'],
            'ano'        => $request['ano'],
            'editora'    => $request['editora'],
            'autor'      => $request['autor']
        ];

        $db->update($request['id'], $livro_editado);

        // Remover informações da session
        foreach ($livro_editado as $key => $value) {
            $session->remove($key);
        }

        return redirect()->to(base_url().'menu_admin');
    }

    public function excluirLivro()
    {
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário admin logado
        if (!$session->ID || $session->TIPO !== 'A') {
            return redirect()->to(base_url().'login');
        }

        $db = new LivrosModel();

        $request = $this->request->getPost();

        $db->where('id', $request['excluir_livro'])->delete();

        $session->set('MENSAGEM', 'Livro excluído com sucesso!');

        return redirect()->to(base_url().'menu_admin');
    }

    public function removerUsuario()
    {
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário admin logado
        if (!$session->ID || $session->TIPO !== 'A') {
            return redirect()->to(base_url().'login');
        }

        $db = new UsuariosModel();

        $request = $this->request->getPost();

        $db->where('id', $request['id'])->delete();

        $session->set('MENSAGEM', 'Usuário removido com sucesso!');

        return redirect()->to(base_url().'usuarios');
    }
}
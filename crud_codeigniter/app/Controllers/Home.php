<?php

namespace App\Controllers;

use App\Models\LivrosModel;
use App\Models\UsuariosModel;
use App\Models\AlugueisModel;
use App\Libraries\Ordenacao;
use App\Libraries\Formatacao;

/*
 * Controller para gerenciar os menus
 */
class Home extends BaseController
{   
    public function menu()
    {
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário logado
        if (!$session->ID || $session->TIPO !== 'U') {
            return redirect()->to(base_url().'login');
        }

        $db = new LivrosModel();

        // Livros a serem mostrados no menu:
        // Quantidade > 0
        // Livros cujo o usuário não está atualmente alugando
        $usuario_id = $db->escape($session->ID);
        $data = [
            'EMAIL'    => $session->EMAIL,
            'NOME'     => $session->NOME,
            'ORDENADO' => false,
            'LIVROS'   => $db->select('livros.id, livros.titulo, livros.autor, livros.ano, livros.editora, livros.quantidade')
                            ->join('alugueis', 'alugueis.livro_id = livros.id', 'left outer')
                            ->where("(alugueis.usuario_id IS NULL OR alugueis.usuario_id != {$usuario_id})")
                            ->where('quantidade >', '0')
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
       
        // Mensagem de aluguel feito com sucesso
        if ($session->MENSAGEM) {
            $data['MENSAGEM'] = true;
            $session->remove('MENSAGEM');
        }

        return view('menu', $data);
    }

    public function meusLivros()
    {
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário logado
        if (!$session->ID || $session->TIPO !== 'U') {
            return redirect()->to(base_url().'login');
        }

        $db = new LivrosModel();

        $data = [
            'EMAIL'  => $session->EMAIL,
            'NOME'   => $session->NOME,
            'ORDENADO' => false,
            'LIVROS' => $db->select('livros.id, livros.titulo, livros.autor, alugueis.inicio')
                            ->join('alugueis', 'alugueis.livro_id = livros.id')
                            ->join('usuarios', 'alugueis.usuario_id = usuarios.id')
                            ->where('usuarios.id', $session->ID)
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
        }

        // Formatar a data dos livros
        $data['LIVROS'] = Formatacao::data($data['LIVROS']->findAll());
        
        if ($session->MENSAGEM) {
            $data['MENSAGEM'] = true;
            $session->remove('MENSAGEM');
        }

        return view('meus_livros', $data);
    }

    public function alugarLivro()
    {   
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário logado
        if (!$session->ID || $session->TIPO !== 'U') {
            return redirect()->to(base_url().'login');
        }

        // Resgatar informação da requisição (id do livro que será alugado)
        $request = $this->request->getPost();
        $id = $request['alugar_livro'];

        $db = new LivrosModel();

        // Diminuir em 1 a quantidade de livros disponíveis do livro que foi alugado
        $db->set('quantidade', 'quantidade - 1', false)->where('id', $id)->update();

        $db = new AlugueisModel();

        // Adicionar o livro para a conta do usuário
        date_default_timezone_set('America/Sao_Paulo');

        $livro_alugado = [
            'inicio'     => date('Y/m/d H:i:s', time()),
            'livro_id'   => $id,
            'usuario_id' => $session->ID
        ];

        $db->insert($livro_alugado);

        $session->set('MENSAGEM', true);

        return redirect()->to(base_url().'menu');
    }

    public function devolverLivro()
    {   
        // Iniciar sessão
        $session = session();

        // Retornar ao login se não existe um usuário logado
        if (!$session->ID || $session->TIPO !== 'U') {
            return redirect()->to(base_url().'login');
        }

        $db = new AlugueisModel();

        // Resgatar informação da requisição (id do livro que será devolvido)
        $request = $this->request->getPost();
        $livro_id = $request['devolver_livro'];

        // Remover livro alugado da lista de alugueis
        $db->where('usuario_id', $session->ID)
            ->where('livro_id', $livro_id)
            ->delete();

        $db = new LivrosModel();

        // Aumentar em 1 a quantidade de livros disponíveis do livro que foi devolvido
        $db->set('quantidade', 'quantidade + 1', false)->where('id', $livro_id)->update();

        $session->set('MENSAGEM', true);
    
        return redirect()->to(base_url().'meus_livros');
    }
}
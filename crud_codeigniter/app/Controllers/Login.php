<?php

namespace App\Controllers;

use App\Models\LivrosModel;
use App\Models\UsuariosModel;
use App\Libraries\Bcrypt;

/*
 * Controller para gerenciar login e criação de contas
 */
class Login extends BaseController
{
    public function login()
    {   
        // Iniciar sessão
        $session = session();

        // Se há alguém logado na sessão
        if ($session->ID) {
            if ($session->TIPO === 'A') {
                return redirect()->to(base_url().'menu_admin');
            }

            return redirect()->to(base_url().'menu');
        }

        // Informações a serem enviadas para a página
        $data = [];
        
        // Se houve um erro de login (usuário ou senha incorretas)
        if ($session->LOGIN_ERROR) {
            $data['LOGIN_ERROR'] = true;
            $session->remove('LOGIN_ERROR');
        }

        return view('login', $data);
    }

    public function criarConta() 
    {   
        // Iniciar sessão
        $session = session();

        // Informações a serem enviadas para a página
        $data = [];
        
        // Se houve um erro de login (usuário ou senha incorretas)
        if ($session->LOGIN_ERROR) {
            $data['LOGIN_ERROR'] = true;
            $session->remove('LOGIN_ERROR');
        }

        return view('criar_conta', $data);
    }

    public function validarLogin()
    {
        // Iniciar sessão
        $session = session();

        // Resgatar informações da requisição
        $request = $this->request->getPost();
        $email = $request['email'];
        $senha = $request['senha'];

        // Acessar a tabela de usuários
        $db = new UsuariosModel();
        
        // Verificar se existe um usuário com o email informado
        $result = $db->where('email', $email)->first();

        // Usuário não existe ou senha incorreta.
        if (empty($result) || !Bcrypt::check($senha, $result['senha'])) {
            $session->set('LOGIN_ERROR', true);
            return redirect()->to(base_url().'login');
        }

        // Informações da sessão
        $user_data = [
            'EMAIL' => $email,
            'ID'    => $result['id'],
            'TIPO'  => $result['tipo'],
            'NOME'  => $result['nome']
        ];

        $session->set($user_data);

        // Se for admin, redirecionar ao menu de admin
        if ($result['tipo'] === 'A') {
            return redirect()->to(base_url().'menu_admin');
        }

        return redirect()->to(base_url().'menu');
    }

    public function validarConta()
    {
        // Iniciar sessão
        $session = session();

        // Resgatar informações da requisição
        $request = $this->request->getPost();
        $email = $request['email'];

        // Acessar a tabela de usuários
        $db = new UsuariosModel();
        
        // Verificar se existe um usuário com o email informado
        $result = $db->where('email', $email)->first();

        // Usuário já existe
        if (!empty($result)) {
            $session->set('LOGIN_ERROR', true);
            return redirect()->to(base_url().'criar_conta');
        }

        // Verificar se a conta é de admin
        $tipo_conta = isset($request['admin']) ? 'A' : 'U';

        // Informações do novo usuário
        $novo_usuario = [
            'nome'  => $request['nome'],
            'email' => $email,
            'senha' => Bcrypt::hash($request['senha']),
            'tipo'  => $tipo_conta
        ];

        $db->insert($novo_usuario);
        $id = $db->getInsertID();

        // Informações da sessão
        $user_data = [
            'EMAIL' => $email,
            'ID'    => $id,
            'TIPO'  => $tipo_conta,
            'NOME'  => $request['nome']
        ];

        $session->set($user_data);

        if (isset($request['admin'])) {
            return redirect()->to(base_url().'menu_admin');
        }

        return redirect()->to(base_url().'menu');
    }

    public function logout()
    {   
        // Iniciar sessão
        $session = session();

        // Remover usuário da sessão atual
        $session->remove('EMAIL');
        $session->remove('ID');
        $session->remove('TIPO');
        $session->remove('NOME');

        return redirect()->to(base_url().'login');
    }
}
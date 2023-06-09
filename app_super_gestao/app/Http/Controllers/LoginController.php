<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request){

        $erro  = '';

        if($request->get('erro') == 1){
            $erro = 'Usuário e senha não existe';
        }

        if($request->get('erro') == 2){
            $erro = 'Necessário realizar login para ter acesso a página';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request){
        
        //regras de validação
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        //as mensagens de feedback de validação
        $feedback = [
            'usuario.email' => 'O campos usuário (e-mail) é obrigatorio',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        //recuperação de parâmetros do formulário
        $email = $request->get('usuario');
        $password = $request->get('senha');

        //iniciar o Model User
        $user = new User();
        
        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if(isset($usuario->name)){
            
            if(!isset($_SESSION))
                session_start();

            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            
            return redirect()->route('app.home');
        }else{
            return redirect()->route('site.login', ['erro' => 1]);
        }
        
    }

    public function sair(){
        if(!isset($_SESSION))
            session_destroy();
        
        return redirect()->route('site.index');
    }
}

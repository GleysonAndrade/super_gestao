<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

use function PHPUnit\Framework\returnValueMap;

class ContatoController extends Controller
{
    public function contato(Request $request){

        //buscando informações vinda do banco
        $motivo_contatos = MotivoContato::all();
        
        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request){
        //realizar as validações dos dados do formulário recebidos no request
        $regras = [
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|min:3|max:2000',
        ];

        $feedback = [
            //Mensagem especifica para cada campo e tipo de validação
            'nome.min' => 'O campo nome precisa ter no mínimo  3 caracteres',
            'nome.max' => 'O campo nome dever no máximo 40 caracteres',
            'nome.unique' => 'O nome informado já está em uso',

            'email.email' => 'O email informado não é válido',

            'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres',

            //Mensagem genericas para todos os campos com a mesmo validação
            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback);
        
        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}

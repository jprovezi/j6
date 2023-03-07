<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function store(Request $request)
    {   



        //Recebe os dados do POST
        $dados = $request->all();

        //Cria validações
        if($dados["nome"] == null){
            return redirect('fale-conosco#form')->with('status','Nome não pode estar vazio');
        }else if($dados["email"] == null){
            return redirect('fale-conosco#form')->with('status','Email não pode estar vazio');
        }else if($dados["telefone"] == null){
            return redirect('fale-conosco#form')->with('status','Telefone não pode estar vazio');
        }else if($dados["mensagem"] == null){
            return redirect('fale-conosco#form')->with('status','Mensagem não pode estar vazia');
        }else{

            //Salva os dados no banco
            $contato = new Contato();
            $contato->nome = $dados["nome"];
            $contato->email = $dados["email"];
            $contato->telefone = $dados["telefone"];
            $contato->mensagem = $dados["mensagem"];
            $contato->save();

            //Retorna Usuário
            return redirect('fale-conosco#form')->with('ok','Mensagem gravada com sucesso, em breve entraremos em contato, obrigado :)');
            
        }

    }
}

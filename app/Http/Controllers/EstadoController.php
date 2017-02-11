<?php

namespace App\Http\Controllers;

use App\Estado;
use App\User;
use Illuminate\Http\Request;

class EstadoController extends Controller
{

    public function dashboard()
    {
        $estado = Estado::all();
        $user = User::all();
        return view('estados.lista-estado',['estado'=>$estado, 'user'=> $user]);
    }

    /*
     * Display all data
     */
    public function index()
    {
        $data = Estado::all();
        return view('estados.inserir-estado')->with('estado',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'nome'=>'required',
            'capital'=>'required',
            'sigla'=>'required',
            'bandeira'=>'required',
            'descricao'=>'required',
        ]);

        //create
        $estado = new Estado();
        $estado->nome = $request->nome;
        $estado->capital = $request->capital;
        $estado->regiao = $request->regiao;
        $estado->sigla = $request->sigla;

        $imgName = $_FILES['bandeira']['name'];
        $imgData = $_FILES['bandeira']['tmp_name'];
        $imgType = $_FILES['bandeira']['type'];
        $upload_dir = public_path().'/images/';
        $filename = uniqid()."_".$imgName;
        move_uploaded_file($imgData, $upload_dir.$filename);
        $estado->bandeira = $filename;

        $estado->descricao = $request->descricao;

        $estado->save();

        return back()->with('success','Estado inserido com sucesso!');
    }

    /*
     * View data
     */
    public function view(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = Estado::find($id);
            $info->descricao = htmlspecialchars_decode(stripslashes($info->descricao));
            $info->bandeira = asset('/images/'.$info->bandeira);
            //echo json_decode($info);
            return response()->json($info);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $estado = $request->edit_id;
        $data = Estado::find($estado);
        //dd($request);
        $data->nome      = $request->edit_nome;
        $data->capital   = $request->edit_capital;
        $data->sigla     = $request->edit_sigla;
        $data->regiao    = $request->edit_regiao;

        $imgName = $_FILES['edit_bandeira']['name'];
        $imgData = $_FILES['edit_bandeira']['tmp_name'];
        $imgType = $_FILES['edit_bandeira']['type'];
        $upload_dir = public_path().'/images/';
        $filename = uniqid()."_".$imgName;
        move_uploaded_file($imgData, $upload_dir.$filename);
        $data->bandeira = $filename;

        $data->descricao = $request->edit_descricao;

        $data->save();
        return back()->with('success','Estado atualizado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $estado = $request->id;
        $data = Estado::find($estado);
        $response = $data->delete();
        if($response)
            echo "Removido com sucesso.";
        else
            echo "Falha ao remover";
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /*
     * Display all data
     */
    public function index()
    {
        $data = User::all();
        return view('usuarios.inserir-usuario')->with('usuario',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request['password']);
        $usuario->perfil = $request->optionsRadios;
        $usuario->save();
        return back()->with('success','Usuário inserido com sucesso!');
    }

    /*
     * View data
     */
    public function view(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = User::find($id);
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
        $user = $request->edit_id;
        $data = User::find($user);
        $data->name   = $request->edit_name;
        $data->email  = $request->edit_email;
        $data->perfil = $request->edit_perfil;

        if($data->save()) {
            return back()->with('success', 'Usuário atualizado com sucesso.');
        }else{
            return back()->with('fail', 'Falha ao atualizar!.');
        }

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
        $user = $request->id;
        $data = User::find($user);
        $response = $data->delete();
        if($response)
            echo "Removido com sucesso.";
        else
            echo "Falha ao remover";
    }
}

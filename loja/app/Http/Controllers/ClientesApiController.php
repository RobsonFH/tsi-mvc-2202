<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
class ClientesApiController extends Controller


{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Clientes::all(); //mostrar todos os clientes
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json = $request->getContent();
        return Clientes::create(json_decode($json, JSON_OBJECT_AS_ARRAY));
        //metodo create espera receber um vetor, e não um objeto (transforma um objeto em um array)
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Clientes::find($id);
        if ($cliente){
            return $cliente; //se o cliente existe ele retorna cliente

        }else{
            return json_encode([$id => 'não existe']); //se não ele transforma em um objeto
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Clientes::find($id);
        if($cliente){
            $json = $request->getContent();
            $atualizacao = json_decode($json, JSON_OBJECT_AS_ARRAY); //Transforma json em array
            $cliente->nome = $atualizacao['nome'];
            $cliente->endereco = $atualizacao['endereco'];
            $cliente->email = $atualizacao['email'];
            $cliente->telefone = $atualizacao['telefone'];
            $ret = $cliente->update() ? [$id => 'atualização'] : [$id => 'erro ao atualizar']; //if e else ? :

        }else{
            $ret = [$id => 'Não existe'];

        }

        return json_encode($ret); // Transforma o ret em objeto.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Clientes::find($id);

        if($cliente){
            $ret = $cliente->delete() ? [$id => 'apagado'] : [$id => 'erro ao apagar']; //if else de delete ? :
        }else{
            $ret = [$id => 'não existe'];
        }

        return json_encode($ret);
    }
}

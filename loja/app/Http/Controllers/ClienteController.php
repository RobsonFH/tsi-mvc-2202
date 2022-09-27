<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Clientes;

class ClienteController extends Controller
{
    private $qtdPorPagina = 5;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //Index Lista os dados da tabela
    {
        $cli = Clientes::orderBy('id', 'ASC')->paginate($this->qtdPorPagina);
        return view('clientes.index', compact('cli'))->with('i',($request->input('page', 1) -1 ) * $this->qtdPorPagina);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Retorna a view para criar um item da tabela
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // Salva o novo item na tabela
    {
        $this->validate($request, ['nome' => 'required' , 'email' => 'required|email']);
        $input = $request->all();

        $cliente = Clientes::create($input);

        return redirect()->route('clietnes.index')->with('succes', 'Cliente gravado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //Mostra um item especifico (nesse caso clientes)
    {
        $cliente = Clientes::find($id);
        return view ('clientes.show', compact('cliente'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //Retorna a view para a edição do dado.
    {
        $cliente = Clientes::find(id);

        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //Salva a atualização do Dado.
    {
        $this->validate($request, ['nome' => 'required' , 'email' => 'required|email']);
        $input = $request->all();

        $cliente = Clientes::find($id);

        $cliente->update($input);

        return redirect()->route('clietnes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Remove o dado
    {
        Clientes::find($id)->delete();

        return redirect()->route('Clientes.index')->with('success', 'Cliente removido com sucesso');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Vendedores; //Para poder usar o arquivo model.

class VendedoresController extends Controller
{
    private $qtdPorPagina = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //Index Lista os dados da tabela
    {
        $vend = Vendedores::orderBy('id', 'ASC')->paginate($this->qtdPorPagina);
        return view('vendedores.index', compact('vend'))->with('i',($request->input('page', 1) -1 ) * $this->qtdPorPagina);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Retorna a view para criar um item da tabela
    {
        return view('vendedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // Salva o novo item na tabela
    {
        $this->validate($request, ['nome' => 'required' , 'matricula' => 'required']);
        $input = $request->all();

        $vend = Vendedores::create($input);

        return redirect()->route('vendedores.index')->with('succes', 'Vendedor gravado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)  //Mostra um item especifico 
    {
        $vend = Vendedores::find($id);
        return view ('vendedores.show', compact('vend'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //Retorna a view para a edição do dado.
    {
        $vend = Vendedores::find($id);

        return view('vendedores.edit', compact('vend'));
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
        $this->validate($request, ['nome' => 'required' , 'matricula' => 'required']);
        $input = $request->all();

        $vend = Vendedores::find($id);

        $vend->update($input);

        return redirect()->route('vendedores.index')->with('success', 'Vendedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Remove o dado
    {
        Vendedores::find($id)->delete();

        return redirect()->route('vendedores.index')->with('success', 'Vendedor removido com sucesso');
    }
}

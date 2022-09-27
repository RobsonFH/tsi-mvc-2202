<?php

namespace App\Http\Controllers;
use \App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    private $qtdPorPagina = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //Index Lista os dados da tabela
    {
        $prod = Produtos::orderBy('id', 'ASC')->paginate($this->qtdPorPagina);
        return view('produtos.index', compact('prod'))->with('i',($request->input('page', 1) -1 ) * $this->qtdPorPagina);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // Salva o novo item na tabela
    {
        $this->validate($request, ['nome' => 'required' , 'descricao' => 'required', 'preco' => 'required']);
        $input = $request->all();

        $prod = Produtos::create($input);

        return redirect()->route('produtos.index')->with('succes', 'Produtos gravado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //Mostra um item especifico (nesse caso clientes)
    {
        $prod = Produtos::find($id);
        return view ('produtos.show', compact('prod'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  //Retorna a view para a edição do dado.
    {
        $prod = Vendedores::find($id);

        return view('produtos.edit', compact('prod'));
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
        $this->validate($request, ['nome' => 'required' , 'descricao' => 'required', 'preco' => 'required']);
        $input = $request->all();

        $prod = Produtos::find($id);

        $prod->update($input);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Remove o dado
    {
        Produtos::find($id)->delete();

        return redirect()->route('produtos.index')->with('success', 'produto removido com sucesso');
    }
}

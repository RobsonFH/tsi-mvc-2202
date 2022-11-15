<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Vendedores;

class vendedoresController extends Controller
{
    public function __construct(){
        //tiver qualquer acesso a qualquer uma dessas já pode ver a listagem
        $this->middleware('permission:vendedores-list|vendedores-create|vendedores-edit|vendedores-delete',
                            ['only' => ['index', 'show']]);

        //se tiver a permissão vendedores-create pode acessar o create e store
        $this->middleware( 'permission:vendedores-create',
                            ['only' => ['create', 'store']]);

        //se tiver permissão para acessar perfil
        $this->middleware( 'permission:vendedores-edit',
                            ['only' => ['edit', 'update']]);
        //se tiver a permissão do delete
        $this->middleware( 'permission:vendedores-delete',
                            ['only' => ['destory']]);
    }
    private $qtdPorPagina = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Request $request - receber a requisição vinda do browser

    //Lista os dados da tabela
    public function index(Request $request)
    {
        $vendedor = Vendedores::orderBy('id', 'ASC')->paginate($this->qtdPorPagina);
        return view('vendedores.index', compact('vendedor'))
        ->with('i', ($request->input('page', 1) - 1) * $this->qtdPorPagina);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Retorna a View para criar um item da tabela
    public function create()
    {
        return view('vendedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Salva o novo item na tabela
    public function store(Request $request)
    {
        $this->validate($request, ['nome'=> 'required',
                                   'matricula' => 'required']);
        $input = $request->all();

        $vendedor = Vendedores::create($input);//recebe os dados que vier do formulário, vai pegar os dados, validar os campos(ex: formato válido para email), pega tudo e joga na variável input que vai para a model Clientes

        return redirect()->route('vendedores.index')->with('sucess', 'Vendedor gravado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)  //Mostra um item especifico
    {
        $vendedor = Vendedores::find($id);

        return view('vendedores.show', compact('vendedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Retorna a View para edição do dado
    public function edit($id)
    {
        $vendedor = Vendedores::find($id);

        return view ('vendedores.edit', compact('vendedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //Salva a atualização do dado
    public function update(Request $request, $id)
    {
        $this->validate($request, ['nome'=> 'required',
                                   'matricula' => 'required']);
        $input = $request->all();

        $vendedor = Vendedores::find($id);

        $vendedor->update($input);

        return redirect()->route('vendedores.index')->with('sucess', 'Vendedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // //Remove o dado
    public function destroy($id)
    {
        Vendedores::find($id)->delete();

        return redirect()->route('vendedores.index')->with('sucess', 'Vendedor removido com sucesso!');
    }

    public function checkVendedor(int $x)
    {
        if ($x <= 1) {
            return true;
        }

        return false;
    }

    public function existeVendedor(string $nome):bool
    {
        $vendedores = ['Paula', 'Matheus', 'Amanda', 'José'];

        if ( in_array($nome, $vendedores) ) {
            return true;
        }

        return false;
    }

    public function getVendedor(int $id):?string
    {
        $vendedores = [1 => 'Paula', 2 => 'Romeu', 3 => 'Amanda', 4 => 'José'];

        if ( isset($vendedores[$id]) ) {
            return $vendedores[$id];
        }

        return null;
    }

    public function getVendedorJSON(int $id):?string
    {
        $vendedores = [1 => 'Paula', 2 => 'Romeu', 3 => 'Amanda', 4 => 'José'];

        if ( isset($vendedores[$id]) ) {
            return json_encode($vendedores[$id]);
        }

        return null;
    }
}
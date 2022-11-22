<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Produtos;



class ProdutosApiController extends Controller

{

     /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        return Produtos::all(); //mostrar todos os produtos

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



        return Produtos::create(json_decode($json, JSON_OBJECT_AS_ARRAY));

        //metodo create espera receber um vetor e não um objeto

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $produto = Produtos::find($id);



        if($produto){

            return $produto;  //se o produto existe ele retorna vendedor

        }else{

            return json_encode([$id => 'não existe']); //se não ele não existe

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

        $produto = Produtos::find($id);



        if($produto){

           $json = $request->getContent();

           $atualizacao = json_decode($json, JSON_OBJECT_AS_ARRAY); //Transforma json em array

           $produto->nome = $atualizacao['nome'];

           $produto->descricao = $atualizacao['descricao'];

           $produto->preco = $atualizacao['preco'];

           $ret = $produto->update() ? [$id => 'atualizado'] : [$id => 'erro ao atualizar']; //if e else ? : 

        }else{

            $ret = [$id => 'não existe'];

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

        $produto = Produtos::find($id);



        if($produto){

            $ret = $produto->delete() ? [$id => 'apagado'] : [$id => 'erro ao apagar']; //if else de delete ? :

        }else{

            $ret = [$id => 'Não existe'];

        }

        return json_encode($ret);

    }

}

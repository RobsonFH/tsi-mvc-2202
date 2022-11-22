<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;


class UserController extends Controller
{
    public function __construct(){
        //tiver qualquer acesso a qualquer uma dessas já pode ver a listagem
        $this->middleware('permission:user-list|user-create|user-edit|user-delete',
                            ['only' => ['index', 'show']]);

        //se tiver a permissão user-create pode acessar o create e store
        $this->middleware( 'permission:user-create',
                            ['only' => ['create', 'store']]);

        //se tiver permissão para acessar perfil
        $this->middleware( 'permission:user-edit',
                            ['only' => ['edit', 'update']]);
        //se tiver a permissão do delete
        $this->middleware( 'permission:user-delete',
                            ['only' => ['destory']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5); //criando uma paginação, e retornando a view
        return view('users.index',compact('data'))
        ->with('i',($request->input('page',1)-1)*5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Retorna a view para criar um item da tabela
    {
        $roles=Role::pluck('name','name')->all(); //Extrai a regra de nome da model, e aplica para todos.
        return view('users.create',compact('roles')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // Salva o novo item na tabela (banco)
    {
        //Validando nome, e-mail, e senha do user
        $this->validate($request,['name'=>'required','email'=>'required|email|unique:users,email','password'=>'required|same:confirm-password','roles'=>'required']);
        $input=$request->all();
        $input['password']=Hash::make($input['password']); //Verificando a senha do user, e se corresponde com a que ele colocou.
        $user=User::create($input);
        $user->assignRole($request->input('roles')); //assinar uma regra
        return redirect()->route('users.index')->with('success','Usuário criado com sucesso'); //redirecionamento para view de usuarios.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //Mostra um item especifico (nesse caso user)
    {
        $user=User::find($id); //buscando o usario pelo id
        return view('users.show',compact('user')); //retornando o usuario.
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //Retorna a view para a edição do dado.
    {
        $user=User::find($id); //buscando o usuario pelo id
        $roles=Role::pluck('name','name')->all(); //Extrai a regra de nome da model, e aplica para todos.
        $userRole=$user->roles->pluck('name','name')->all(); //Extrai a regra de nome da model, e aplica para todos.
        return view('users.edit',compact('user','roles','userRole')); //retornando a view de usuario (compact, cria um array contendo variaveis e seus valores) (edit)
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
        //Validando nome, e-mail, e senha
        $this->validate($request,['name'=>'required','email'=>'required|email|unique:users,email,'. $id,'password'=>'same:confirm-password','roles'=>'required']); 
        $input=$request->all();
        if(!empty($input['password'])){ // Se o campo senha, não for vazio ele cai no input e compara a senha armazenada.
        $input['password']=Hash::make($input['password']);
        }else{
        $input=Arr::except($input,array('password')); //Remove as chave e o valor da senha
        }
        $user=User::find($id); //acessando usuario
        $user->update($input); 
        DB::table('model_has_roles')->where('model_id',$id)->delete(); //Consulta no banco de dados, e chama o metodo delete.
        $user->assignRole($request->input('roles')); //assinar uma regra
        return redirect()->route('users.index')->with('success','Usuário atualizado com sucesso'); //Redirecionando para view
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Remove o dado
    {
    {
        User::find($id)->delete(); //busca o usuario pelo id e deleta.
return redirect()->route('users.index')->with('success','Usuário removido com sucesso'); //Redirecionando para view

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JTWException;

class APIController extends Controller
{
    public $loginAfterSignUp = true;

    public function login(Request $request){
        $token = null;
        $campos_json = json_decode($request->getContent(), JSON_OBJECT_AS_ARRAY);//TRANSFORMANDO O JSON ENVIADO PELO USUARIO EM VETOR
        $credenciais = ['email' => $campos_json['email'],
                         'password' => $campos_json['password']];//VETOR COM OS INDICES EMAIL E PASSAWORDS PARA RECEBER OS DADOS ENVIADOS PELO USUARIO

        try{
            if(!$token = JWTAuth::attempt($credenciais)){
        //se não der certo a tentativa o token receber a autenticação retorna o erro 401
                return response()->json(['sucess' => false, 'message' => 'Credenciais inválidas'], 401);
        //devolve um json com campo sucesso e a mensagem, e ainda retorna ao solicitante o código http 401
        }

        }catch(JWTException $e){
            return response()->json(['error' => 'Token não pode ser criado'], 500);
        }
        return response()->json(['sucess' => true, 'token' => $token]);//se deu certo ele vai devolver o token
 }

    public function logout(Request $request){
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['sucess' => true, 'message' => 'Token invalidado']);
        }catch(JWTException $e){
            return response()->json(['sucess' => false, 'message' => 'Erro ao invalidar o token', 'error' => var_export($e->getMessage())], 500);//jogar a exceção para o usuário ver o que aconteceu
        }
    }
}

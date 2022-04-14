<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\models\EntrenadorModel;
use App\models\ClienteModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;

Class Auth extends ResourceController{

    protected $format = 'json';

    protected $token;
    protected $entrenador;
    protected $cliente;
    protected $tipoUsuario;

    public function __construct(){

    }

    public function create(){
        $user = $this->request->getPost("user");
        $password = $this->request->getPost("password");
        $tipo = $this->request->getPost("tipo");

        if($tipo=="entrenador"){
            $entrenadorModel = new EntrenadorModel();
            $this->entrenador = $entrenadorModel->login($user,$password);

            if($this->entrenador){
                $now =time();
                $key = Services::getSecretKey();
                $user_id = $this->entrenador["id"];

                $payload = [
                    'aud' => "http://SusGym.com",
                    'iat' => $now, //cuando se creo
                    'nbf' => $now,  //cuando se empezará a utilizar,
                    //'exp' => $now+(60*60*24*7),
                    'exp' => $now+(60*60*24),
                    'data' =>[  
                                "user_id" => $user_id,
                                "tipo" => $tipo
                            ]
                ];

                $jwt = JWT::encode( $payload, $key,"HS256");

                return $this->respond(["token" => $jwt,"user" =>$this->entrenador, "tipo" =>$tipo]);

                }else{
                return $this->respond(["error" => "token expirado"], 400);
            }
        }
        if($tipo=="cliente"){
            $clienteModel = new ClienteModel();
            $this->cliente = $clienteModel->login($user, $password);
            if($this->cliente){
                $now =time();
                $key = Services::getSecretKey();
                $user_id = $this->cliente["id"];

                $payload = [
                    'aud' => "http://SusGym.com",
                    'iat' => $now, //cuando se creo
                    'nbf' => $now,  //cuando se empezará a utilizar,
                    //'exp' => $now+(60*60*24*7),
                    'exp' => $now+(60*60*24),
                    'data' =>[  
                                "user_id" => $user_id,
                                "tipo" => $tipo
                            ]
                ];

                $jwt = JWT::encode( $payload, $key,"HS256");

                return $this->respond(["token" => $jwt,"user" =>$this->cliente, "tipo" =>$tipo]);

                }else{
                return $this->respond(["error" => "Usuario y contraseña incorrectos"]);
            }
        }
    }

    public function verifyToken(){
        $key = Services::getSecretKey();
        $token_str = $this->request->getHeader("token")->getValue();
        
        try {
            $token = JWT::decode($token_str, new key ($key, 'HS256'));
        }catch(\Throwable $th){
            $token= false;
            }
        
        if(!$token){
            return false;
        }else{
            if($token->data->tipo == "entrenador"){
    
                $entrenadorModel = new EntrenadorModel();
                $this->entrenador = $entrenadorModel->find($token->data->user_id);
                $this->tipoUsuario ="entrenador";
            }else{
                $clienteModel = new ClienteModel();
                $this->cliente = $clienteModel->find($token->data->user_id);
                $this->tipoUsuario ="cliente";
            }
            return true;
        }
    }    
    public function ValidarEntrenador(){

        $user = $this->request->getHeader("user")->getValue();
        $password = $this->request->getHeader("password")->getValue();
        $userModel = new EntrenadorModel();
        $user = $userModel->login($user,$password);

        return $user;
    }
}

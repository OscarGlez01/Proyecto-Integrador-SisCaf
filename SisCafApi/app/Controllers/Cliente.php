<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\models\EntrenadorModel;

Class Cliente extends Auth{

    protected $modelName = 'App\Models\ClienteModel';
    protected $format = 'json';

    public function index(){
        /*
        $user=$this->validarEntrenador();
        if(!$user){
            return  $this->respond(["error"=> "usuario o contraseña incorrectos"]);}
            */

        if(!$this->verifyToken()){
            return $this->respond(["error"=> "usuario o contraseña incorrectos"]);
        }
            
        $data =[
            "clientes"=> $this->model->findAll(),
            "entrenador" => $this->entrenador
        ];

        return $this->respond($data);
    }

    public function show($id=NULL){
        if(!$this->verifyToken()){
            return $this->respond(["error"=> "Token expirado!"]);
        }

        if($this->tipoUsuario == "entrenador" || $this->cliente["id"] == $id){
        
        } else{
            return $this->respond(["error" => "No tienes permisos para ver esta información"]); 
        }

        $data=[
            "cliente" => $this->model->find($id)
        ];
        return $this->respond($data);
    }

    public function create($id=null){

        if(!$this->verifyToken()){
            return $this->respond(["error"=> "usuario o contraseña incorrectos"]);
        }
        $data = [
            "nombre"=>$this->request->getPost('nombre'),
            "apellidos"=>$this->request->getPost('apellidos'),
            "telefono"=>$this->request->getPost('telefono'),
            "correo"=>$this->request->getPost('correo'),
            "contrasena"=>$this->request->getPost('contrasena'),
            "entrenador_id"=>$this->request->getPost('entrenador_id'),
            "gimnasio_id"=>$this->request->getPost('gimnasio_id'),
            "dia_pago"=>$this->request->getPost('dia_pago'),
            "fecha_inicio"=>$this->request->getPost('fecha_inicio'),
            "estado"=> "activo"
        ];
        
        $id =$this->model->insert($data);
        if($id){
            return $this->respond($this->model->find($id));
            return $this->respond(["result"=> "El cliente se agrego correctamente!"]);
        }else{
            return $this->respond(["error"=> "El cliente no se agrego correctamente!"]);
        }
    }

    public function update($id=null){

        if(!$this->verifyToken()){
            return $this->respond(["error"=> "usuario o contraseña incorrectos"]);
        }

        $data = [];
        if(!empty($this->request->getPost('nombre')))
            $data["nombre"] = $this->request->getPost('nombre');
        if(!empty($this->request->getPost('apellidos')))
            $data["apellidos"] = $this->request->getPost('apellidos');
        if(!empty($this->request->getPost('telefono')))
            $data["telefono"] = $this->request->getPost('telefono');
        if(!empty($this->request->getPost('correo')))
            $data["correo"] = $this->request->getPost('correo');
        if(!empty($this->request->getPost('contrasena')))
            $data["contrasena"] = $this->request->getPost('contrasena');
        if(!empty($this->request->getPost('entrenador_id')))
            $data["entrenador_id"] = $this->request->getPost('entrenador_id');
        if(!empty($this->request->getPost('dia_pago')))
            $data["dia_pago"] = $this->request->getPost('dia_pago');
        if(!empty($this->request->getPost('fecha_inicio')))
            $data["nomfecha_iniciobre"] = $this->request->getPost('fecha_inicio');
        if(!empty($this->request->getPost('estado')))
            $data["estado"] = $this->request->getPost('estado');

        $result = $this->model->update($id,$data);

        if($result){
            $cliente = $this->model->find($id);
            return $this->respond(["result"=> "El registro se editó correctamente!","data"=>$cliente]);
        }else{
            return $this->respond(["error"=> "El cliente no se agrego correctamente!"]);
        }
    }

    public function delete($id=null){

        if(!$this->verifyToken()){
            return $this->respond(["error"=> "usuario o contraseña incorrectos"]);
        }

        $result= $this->model->delete($id);
        if($result){
            return $this->respond(["result"=> "El registro se elimino correctamente!"]);
        }else{
            return $this->respond(["error"=> "El cliente no se agrego correctamente!"]);
        }


    }

}
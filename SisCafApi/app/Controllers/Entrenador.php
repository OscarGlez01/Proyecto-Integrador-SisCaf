<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

Class Entrenador extends ResourceController{

    protected $modelName = 'App\Models\EntrenadorModel';
    protected $format = 'json';

    public function index(){
        $data =[
            "entrenadores"=> $this->model->FindAll()
        ];

        return $this->respond($data);
    }

    public function show($id=NULL){
        $data=[
            "entrenador" => $this->model->find($id)
        ];
        return $this->respond($data);
    }

    public function create(){

        $data = [
            "nombre"=>$this->request->getPost('nombre'),
            "apellidos"=>$this->request->getPost('apellidos'),
            "telefono"=>$this->request->getPost('telefono'),
            "correo"=>$this->request->getPost('correo'),
            "contrasena"=>$this->request->getPost('contrasena'),
            "gimnasio_id"=>$this->request->getPost('gimnasio_id'),
            "hora_inicio"=>$this->request->getPost('hora_inicio'),
            "hora_fin"=>$this->request->getPost('hora_fin'),
            "fecha_inicio"=> date("Y-m-d"),
            "estado"=>'activo'
        ];
        
        $id =$this->model->insert($data);
        if($id){
            return $this->respond($this->model->find($id));
        }else{
            return $this->respond(["error"=> "El entrenador no se agrego correctamente!"]);
        }
    }

    public function update($id=null){

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
        if(!empty($this->request->getPost('gimnasio_id')))
            $data["gimnasio_id"] = $this->request->getPost('gimnasio_id');
        if(!empty($this->request->getPost('hora_inicio')))
            $data["hora_inicio"] = $this->request->getPost('hora_inicio');
        if(!empty($this->request->getPost('hora_fin')))
            $data["hora_fin"] = $this->request->getPost('hora_fin');
        if(!empty($this->request->getPost('fecha_inicio')))
            $data["fecha_inicio"] = $this->request->getPost('fecha_inicio');
        if(!empty($this->request->getPost('estado')))
            $data["estado"] = $this->request->getPost('estado');

        $result = $this->model->update($id,$data);

        if($result){
            $entrenador = $this->model->find($id);
            return $this->respond(["result"=> "El registro se editó correctamente!","data"=>$entrenador]);
        }else{
            return $this->respond(["error"=> "El entrenador no se agrego correctamente!"]);
        }
    }

    public function delete($id=null){
        $result= $this->model->delete($id);
        if($result){
            return $this->respond(["result"=> "El registro se elimino correctamente!"]);
        }else{
            return $this->respond(["error"=> "El entrenador no se agrego correctamente:("]);
        }


    }

}
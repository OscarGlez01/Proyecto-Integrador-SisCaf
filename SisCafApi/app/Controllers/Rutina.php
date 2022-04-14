<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

Class Rutina extends ResourceController{

    protected $modelName = 'App\Models\RutinaModel';
    protected $format = 'json';

    public function index(){
        $data =[
            "rutinas"=> $this->model->FindAll()
        ];

        return $this->respond($data);
    }

    public function show($id=NULL){
        $data=[
            "rutina" => $this->model->find($id)
        ];
        return $this->respond($data);
    }

    public function create(){

        $data = [
            "cliente_id"=>$this->request->getPost('cliente_id'),
            "entrenador_id"=>$this->request->getPost('entrenador_id'),
            "mes"=>$this->request->getPost('mes'),
            "anio"=>$this->request->getPost('anio'),
            "rutina"=>$this->request->getPost('rutina')
        ];
        
        $id =$this->model->insert($data);
        if($id){
            return $this->respond($this->model->find($id));
        }else{
            return $this->respond(["error"=> "La rutina no se agrego correctamente!"]);
        }
    }

    public function update($id=null){

        $data = [];
        if(!empty($this->request->getPost('cliente_id')))
            $data["cliente_id"] = $this->request->getPost('cliente_id');
        if(!empty($this->request->getPost('entrenador_id')))
            $data["entrenador_id"] = $this->request->getPost('entrenador_id');
        if(!empty($this->request->getPost('mes')))
            $data["mes"] = $this->request->getPost('mes');
        if(!empty($this->request->getPost('anio')))
            $data["anio"] = $this->request->getPost('anio');
        if(!empty($this->request->getPost('rutina')))
            $data["rutina"] = $this->request->getPost('rutina');

        $result = $this->model->update($id,$data);

        if($result){
            $rutina = $this->model->find($id);
            return $this->respond(["result"=> "El registro se editó correctamente!","data"=>$rutina]);
        }else{
            return $this->respond(["error"=> "La rutina no se agrego correctamente!"]);
        }
    }

    public function delete($id=null){
        $result= $this->model->delete($id);
        if($result){
            return $this->respond(["result"=> "El registro se elimino correctamente!"]);
        }else{
            return $this->respond(["error"=> "La rutina no se elimino correctamente"]);
        }
    }
}
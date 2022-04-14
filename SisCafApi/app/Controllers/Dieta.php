<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

Class Dieta extends ResourceController{

    protected $modelName = 'App\Models\DietaModel';
    protected $format = 'json';

    public function index(){
        $data =[
            "dietas"=> $this->model->FindAll()
        ];

        return $this->respond($data);
    }

    public function show($id=NULL){
        $data=[
            "dieta" => $this->model->find($id)
        ];
        return $this->respond($data);
    }

    public function create($id=null){

        $data = [
            "cliente_id"=>$this->request->getPost('cliente_id'),
            "entrenador_id"=>$this->request->getPost('entrenador_id'),
            "mes"=>$this->request->getPost('mes'),
            "dieta"=>$this->request->getPost('dieta'),
        ];
        
        $id =$this->model->insert($data);
        if($id){
            return $this->respond($this->model->find($id));
            return $this->respond(["result"=> "La dieta se agrego correctamente!"]);
        }else{
            return $this->respond(["error"=> "La dieta no se agrego correctamente!"]);
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
        if(!empty($this->request->getPost('dieta')))
            $data["dieta"] = $this->request->getPost('dieta');
        
        $result = $this->model->update($id,$data);

        if($result){
            $dieta = $this->model->find($id);
            return $this->respond(["result"=> "El registro se editó correctamente!","data"=>$dieta]);
        }else{
            return $this->respond(["error"=> "La dieta no se agrego correctamente!"]);
        }
    }

    public function delete($id=null){
        $result= $this->model->delete($id);
        if($result){
            return $this->respond(["result"=> "El registro se elimino correctamente!"]);
        }else{
            return $this->respond(["error"=> "El dieta no se agrego correctamente!"]);
        }


    }

}
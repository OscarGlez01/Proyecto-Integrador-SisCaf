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
            "mes"=>$this->request->getPost('mes'),
            "fecha"=>$this->request->getPost('fecha'),
            "peso"=>$this->request->getPost('peso'),
            "estatura"=>$this->request->getPost('estatura'),
            "imc"=>$this->request->getPost('imc'),
            "asistencia"=>$this->request->getPost('asistencia')
        ];
        
        $id =$this->model->insert($data);
        if($id){
            return $this->respond($this->model->find($id));
        }else{
            return $this->respond(["error"=> "El seguimiento no se agrego correctamente!"]);
        }
    }

    public function update($id=null){

        $data = [];
        if(!empty($this->request->getPost('cliente_id')))
            $data["cliente_id"] = $this->request->getPost('cliente_id');
        if(!empty($this->request->getPost('mes')))
            $data["mes"] = $this->request->getPost('mes');
        if(!empty($this->request->getPost('fecha')))
            $data["fecha"] = $this->request->getPost('fecha');
        if(!empty($this->request->getPost('peso')))
            $data["peso"] = $this->request->getPost('peso');
        if(!empty($this->request->getPost('estatura')))
            $data["estatura"] = $this->request->getPost('estatura');
        if(!empty($this->request->getPost('imc')))
            $data["imc"] = $this->request->getPost('imc');
        if(!empty($this->request->getPost('asistencia')))
            $data["asistencia"] = $this->request->getPost('asistencia');

        $result = $this->model->update($id,$data);

        if($result){
            $rutina = $this->model->find($id);
            return $this->respond(["result"=> "El registro se editó correctamente!","data"=>$rutina]);
        }else{
            return $this->respond(["error"=> "El seguimiento no se editó correctamente!"]);
        }
    }

    public function delete($id=null){
        $result= $this->model->delete($id);
        if($result){
            return $this->respond(["result"=> "El registro se elimino correctamente!"]);
        }else{
            return $this->respond(["error"=> "El seguimiento no se elimino correctamente"]);
        }
    }
}
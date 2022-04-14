<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

Class PagoCliente extends ResourceController{

    protected $modelName = 'App\Models\PagoClienteModel';
    protected $format = 'json';

    public function index(){
        $data =[
            "pagoClientes"=> $this->model->FindAll()
        ];

        return $this->respond($data);
    }

    public function show($id=NULL){
        $data=[
            "pagoCliente" => $this->model->find($id)
        ];
        return $this->respond($data);
    }

    public function create(){

        $data = [
            "entrenador_id"=>$this->request->getPost('entrenador_id'),
            "pago"=>$this->request->getPost('pago'),
            "comision"=>$this->request->getPost('comision'),
            "fecha_pago"=>$this->request->getPost('fecha_pago'),
            "mes"=>$this->request->getPost('mes'),
            "anio"=>$this->request->getPost('anio')
        ];
        
        $id =$this->model->insert($data);
        if($id){
            return $this->respond($this->model->find($id));
        }else{
            return $this->respond(["error"=> "El pago del cliente no se agrego correctamente!"]);
        }
    }

    public function update($id=null){

        $data = [];
        if(!empty($this->request->getPost('entrenador_id')))
            $data["entrenador_id"] = $this->request->getPost('entrenador_id');
        if(!empty($this->request->getPost('pago')))
            $data["pago"] = $this->request->getPost('pago');
        if(!empty($this->request->getPost('comison')))
            $data["comision"] = $this->request->getPost('comision');
        if(!empty($this->request->getPost('fecha_pago')))
            $data["fecha_pago"] = $this->request->getPost('fecha_pago');
        if(!empty($this->request->getPost('mes')))
            $data["mes"] = $this->request->getPost('mes');
        if(!empty($this->request->getPost('anio')))
            $data["anio"] = $this->request->getPost('anio');

        $result = $this->model->update($id,$data);

        if($result){
            $pagoCliente = $this->model->find($id);
            return $this->respond(["result"=> "El registro se editó correctamente!","data"=>$pagoCliente]);
        }else{
            return $this->respond(["error"=> "El pago del entrenador no se agrego correctamente!"]);
        }
    }

    public function delete($id=null){
        $result= $this->model->delete($id);
        if($result){
            return $this->respond(["result"=> "El registro se elimino correctamente!"]);
        }else{
            return $this->respond(["error"=> "El pago del entrenador no se agrego correctamente"]);
        }


    }

}
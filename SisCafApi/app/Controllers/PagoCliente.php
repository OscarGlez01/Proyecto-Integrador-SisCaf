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
            "cliente_id"=>$this->request->getPost('cliente_id'),
            "entrenador_id"=>$this->request->getPost('entrenador_id'),
            "mes"=>$this->request->getPost('mes'),
            "fecha_pago"=>$this->request->getPost('fecha_pago'),
            "cobro"=>$this->request->getPost('cobro')
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
        if(!empty($this->request->getPost('cliente_id')))
            $data["cliente_id"] = $this->request->getPost('cliente_id');
        if(!empty($this->request->getPost('entrenador_id')))
            $data["entrenador_id"] = $this->request->getPost('entrenador_id');
        if(!empty($this->request->getPost('mes')))
            $data["mes"] = $this->request->getPost('mes');
        if(!empty($this->request->getPost('fecha_pago')))
            $data["fecha_pago"] = $this->request->getPost('fecha_pago');
        if(!empty($this->request->getPost('cobro')))
            $data["cobro"] = $this->request->getPost('cobro');

        $result = $this->model->update($id,$data);

        if($result){
            $pagoCliente = $this->model->find($id);
            return $this->respond(["result"=> "El registro se editó correctamente!","data"=>$pagoCliente]);
        }else{
            return $this->respond(["error"=> "El pago del cliente no se agrego correctamente!"]);
        }
    }

    public function delete($id=null){
        $result= $this->model->delete($id);
        if($result){
            return $this->respond(["result"=> "El registro se elimino correctamente!"]);
        }else{
            return $this->respond(["error"=> "El pagoCliente no se agrego correctamente:("]);
        }


    }

}
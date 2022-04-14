<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

Class Gimnasio extends ResourceController{

    protected $modelName = 'App\Models\GimnasioModel';
    protected $format = 'json';

    public function index(){
        $data =[
            "gimnasios"=> $this->model->FindAll()
        ];

        return $this->respond($data);
    }

    public function show($id=NULL){
        $data=[
            "gimnasio" => $this->model->find($id)
        ];
        return $this->respond($data);
    }

    public function create(){

        $data = [
            "nombre"=>$this->request->getPost('nombre'),
            "estado"=>$this->request->getPost('estado'),
            "ciudad"=>$this->request->getPost('ciudad'),
            "colonia"=>$this->request->getPost('colonia'),
            "calle"=>$this->request->getPost('calle'),
            "numero_exterior"=>$this->request->getPost('numero_exterior'),
            "numero_interior"=>$this->request->getPost('numero_interior'),
            "codigo_postal"=>$this->request->getPost('codigo_postal'),
            "telefono"=>$this->request->getPost('telefono'),
            "correo"=>$this->request->getPost('correo'),
            "horarios"=>$this->request->getPost('horarios'),
            "latitud"=>$this->request->getPost('latitud'),
            "longitud"=>$this->request->getPost('longitud'),
            "status"=>$this->request->getPost('status')
        ];
        
        $id =$this->model->insert($data);
        if($id){
            return $this->respond($this->model->find($id));
        }else{
            return $this->respond(["error"=> "El gimnasio no se agrego correctamente!"]);
        }
    }

    public function update($id=null){

        $data = [];
        if(!empty($this->request->getPost('nombre')))
            $data["nombre"] = $this->request->getPost('nombre');
        if(!empty($this->request->getPost('estado')))
            $data["estado"] = $this->request->getPost('estado');
        if(!empty($this->request->getPost('ciudad')))
            $data["ciudad"] = $this->request->getPost('ciudad');
        if(!empty($this->request->getPost('colonia')))
            $data["colonia"] = $this->request->getPost('colonia');
        if(!empty($this->request->getPost('calle')))
            $data["calle"] = $this->request->getPost('calle');
        if(!empty($this->request->getPost('numero_exterior')))
            $data["numero_exterior"] = $this->request->getPost('numero_exterior');
        if(!empty($this->request->getPost('numero_interior')))
            $data["numero_interior"] = $this->request->getPost('numero_interior');
        if(!empty($this->request->getPost('codigo_postal')))
            $data["codigo_postal"] = $this->request->getPost('codigo_postal');
        if(!empty($this->request->getPost('telefono')))
            $data["telefono"] = $this->request->getPost('telefono');
        if(!empty($this->request->getPost('correo')))
            $data["correo"] = $this->request->getPost('correo');
        if(!empty($this->request->getPost('horarios')))
            $data["horarios"] = $this->request->getPost('horarios');
        if(!empty($this->request->getPost('latitud')))
            $data["latitud"] = $this->request->getPost('latitud');
        if(!empty($this->request->getPost('longitud')))
            $data["longitud"] = $this->request->getPost('longitud');
        if(!empty($this->request->getPost('status')))
            $data["status"] = $this->request->getPost('status');

        $result = $this->model->update($id,$data);

        if($result){
            $gimnasio = $this->model->find($id);
            return $this->respond(["result"=> "El registro se editó correctamente!","data"=>$gimnasio]);
        }else{
            return $this->respond(["error"=> "El gimnasio no se agrego correctamente!"]);
        }
    }

    public function delete($id=null){
        $result= $this->model->delete($id);
        if($result){
            return $this->respond(["result"=> "El registro se elimino correctamente!"]);
        }else{
            return $this->respond(["error"=> "El gimnasio no se agrego correctamente:("]);
        }


    }

}
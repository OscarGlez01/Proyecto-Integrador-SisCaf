<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model{

    protected $table = 'clientes';
    protected $primaryKey= 'id';

    protected $allowedFields = [
        "id",
        "nombre",
        "apellidos",
        "telefono",
        "correo",
        "contrasena",
        "entrenador_id",
        "gimnasio_id",
        "dia_pago",
        "fecha_inicio",
        "estado"
    ];

    public function login($user, $password){
        $result = $this->asArray()->
            where([
                "telefono"=>$user,
                "contrasena"=>$password
            ]) ->orWhere([
                "correo"=>$user,
                "contrasena"=>$password
            ])->first();
            
            return $result;
    }
}
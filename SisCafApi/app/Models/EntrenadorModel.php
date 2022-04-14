<?php

namespace App\Models;

use CodeIgniter\Model;

class EntrenadorModel extends Model{

    protected $table = 'entrenadores';
    protected $primaryKey= 'id';

    protected $allowedFields = [
        "id",
        "nombre",
        "apellidos",
        "telefono",
        "correo",
        "contrasena",
        "gimnasio_id",
        "hora_inicio",
        "hora_fin",
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
<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model{

    protected $table = 'clientes';
    protected $primaryKey= 'id';

    protected $allowedFields = [
        "id",
        "nombre",
        "correo",
        "contrasena"
    ];

    public function login($user, $password){
        $result = $this->asArray()->
            where([
                "correo"=>$user,
                "contrasena"=>$password
            ]) ->orWhere([
                "nombre"=>$user,
                "contrasena"=>$password
            ])->first();
            
            return $result;
    }
}
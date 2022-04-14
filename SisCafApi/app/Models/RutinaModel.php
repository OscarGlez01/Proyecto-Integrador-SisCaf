<?php

namespace App\Models;

use CodeIgniter\Model;

class RutinaModel extends Model{

    protected $table = 'rutinas';
    protected $primaryKey= 'id';

    protected $allowedFields = [
        "id",
        "cliente_id",
        "entrenador_id",
        "mes",
        "anio",
        "rutina"
    ];
}
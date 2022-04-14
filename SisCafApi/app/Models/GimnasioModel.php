<?php

namespace App\Models;

use CodeIgniter\Model;

class GimnasioModel extends Model{

    protected $table = 'gimnasios';
    protected $primaryKey= 'id';

    protected $allowedFields = [
        "id",
        "nombre",
        "estado",
        "ciudad",
        "colonia",
        "calle",
        "numero_exterior",
        "numero_interior",
        "codigo_postal",
        "telefono",
        "correo",
        "horarios",
        "latitud",
        "longitud",
        "status"
    ];
}
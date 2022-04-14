<?php

namespace App\Models;

use CodeIgniter\Model;

class SeguimientoModel extends Model{

    protected $table = 'seguimientos';
    protected $primaryKey= 'id';

    protected $allowedFields = [
        "id",
        "cliente_id",
        "mes",
        "fecha",
        "peso",
        "estatura",
        "imc",
        "asistencia"
    ];
}
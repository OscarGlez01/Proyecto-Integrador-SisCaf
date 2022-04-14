<?php

namespace App\Models;

use CodeIgniter\Model;

class PagoEntrenadorModel extends Model{

    protected $table = 'pago_entrenadores';
    protected $primaryKey= 'id';

    protected $allowedFields = [
        "id",
        "entrenador_id",
        "pago",
        "comision",
        "fecha_pago",
        "mes",
        "anio"
    ];
}
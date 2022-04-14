<?php

namespace App\Models;

use CodeIgniter\Model;

class PagoClienteModel extends Model{

    protected $table = 'pago_clientes';
    protected $primaryKey= 'id';

    protected $allowedFields = [
        "id",
        "cliente_id",
        "entrenador_id",
        "mes",
        "fecha_pago",
        "cobro"
    ];
}
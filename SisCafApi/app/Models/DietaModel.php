<?php

namespace App\Models;

use CodeIgniter\Model;

class DietaModel extends Model{

    protected $table = 'dietas';
    protected $primaryKey= 'id';

    protected $allowedFields = [
        "id",
        "cliente_id",
        "entrenador_id",
        "mes",
        "dieta"
    ];
}
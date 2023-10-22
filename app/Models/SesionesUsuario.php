<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionesUsuario extends Model
{
    protected $table='sesiones_usuario';
    protected $primaryKey = 'id_sesion';
    public $timestamps=false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table='publicacion';
    protected $primaryKey = 'id_publicacion';
    public $timestamps=false;
}

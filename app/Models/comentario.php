<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table='comentario';
    protected $primaryKey = 'id_comentario';
    public $timestamps=false;
}

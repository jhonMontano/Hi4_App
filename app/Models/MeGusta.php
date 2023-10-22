<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeGusta extends Model
{
    protected $table='me_gusta';
    protected $primaryKey = 'id_megusta';
    public $timestamps=false;
}

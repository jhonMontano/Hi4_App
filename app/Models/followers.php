<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    protected $table='followers';
    protected $primaryKey = 'id_followers';
    public $timestamps=false;
}

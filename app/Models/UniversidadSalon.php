<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversidadSalon extends Model
{
    use HasFactory;
    protected $table = 'universidades_salones';
    protected $primaryKey = 'id';
}

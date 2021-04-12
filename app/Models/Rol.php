<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'roles'; //La tabla es roles y el modelo Rol
    protected $fillable = ['nombre', 'descripcion', 'condicion']; //Atributos de la tabla
    public $timestamps = false; //No hay timestamps
}

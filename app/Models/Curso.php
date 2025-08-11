<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    //
    use HasFactory;

    protected $table = 'cursos';
    protected $fillable = ['nombre', 'descripcion'];      
    public function cuestionarios()
    {
        return $this->hasOne(Cuestionarios::class, 'curso_id');
    }


    /*protected $table = "users";*/
}

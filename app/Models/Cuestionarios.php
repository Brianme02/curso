<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuestionarios extends Model
{
    //
    use HasFactory;
    protected $table = 'cuestionarios';
    protected $fillable = ['titulo', 'curso_id'];
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
    
    public function preguntas()
    {
        return $this->hasMany(Preguntas::class, 'cuestionario_id');
    }
}

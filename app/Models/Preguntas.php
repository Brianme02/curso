<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preguntas extends Model
{
    //
    use HasFactory;

    protected $table = 'preguntas';
    protected $fillable = ['pregunta', 'cuestionario_id'];  

    public function cuestionario()
    {
        return $this->belongsTo(Cuestionarios::class, 'cuestionario_id');
    }

}

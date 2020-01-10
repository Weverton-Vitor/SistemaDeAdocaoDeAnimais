<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';
    protected $fillable = ['nome', 'updated_at', 'created_up'];

    public function animais()
    {
        return $this->hasMany('\App\Models\Animal', 'tipo_id');
    }

}
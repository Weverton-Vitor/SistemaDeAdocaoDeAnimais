<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['nome','peso','altura','tipo_id','raca',
                           'situacao_medica', 'situacao_adocao',
                           'updated_at', 'created_up'
                          ];

    protected $table = 'animais';

    public function tipo()
    {
        return $this->belongsTo('\App\Models\Tipo', 'tipo_id');
    }

    public function pedidoAdocao()
    {
        return $this->hasOne('\App\Models\PedidoAdocao', 'animal_id');
    }
}

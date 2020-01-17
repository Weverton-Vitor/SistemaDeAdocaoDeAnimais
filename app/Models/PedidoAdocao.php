<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoAdocao extends Model
{
    protected $table = 'pedido_adocao';
    protected $fillable = ['user_id', 'data_pedido', 'situacao', 'informacoes_adicionais', 'dados_adotante_id', 'animal_id', 'updated_at', 'created_up'];
        
    public function animal()
    {
        return $this->belongsTo('\App\Models\Animal');
    }

    public function dadosAdotante()
    {
       return $this->belongsTo('\App\Models\DadosAdotante', 'dados_adotante_id');
    }
}

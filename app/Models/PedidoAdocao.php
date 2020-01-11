<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoAdocao extends Model
{
    protected $table = 'pedido_adocao';
    protected $fillable = ['nome_adotador', 'cpf_adotador', 'telefone_adotador',
                           'email_adotador', 'endereco_adotador_id', 'situacao', 
                           'informacoes_adicionais', 'animal_id', 'updated_at', 'created_up'];
        
    public function animal()
    {
        return $this->belongsTo('\App\Models\Animal');
    }

    public function enderecoAdotador()
    {
       return $this->belongsTo('\App\Models\EnderecoAdotador', 'endereco_adotador_id');
    }


}

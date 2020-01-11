<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoAdocao extends Model
{
    protected $table = 'pedido_adocao';
    protected $fillable = ['nome_adotante', 'cpf_adotante', 'telefone_adotante',
                           'email_adotante', 'endereco_adotante_id', 'situacao', 
                           'informacoes_adicionais', 'animal_id', 'updated_at', 'created_up'];
        
    public function animal()
    {
        return $this->belongsTo('\App\Models\Animal');
    }

    public function enderecoAdotante()
    {
       return $this->belongsTo('\App\Models\EnderecoAdotante', 'endereco_adotante_id');
    }


}

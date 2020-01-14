<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadosAdotante extends Model
{
    protected $table = 'dados_adotante';
    protected $fillable = ['nome_adotante', 'cpf_adotante', 'telefone_adotante',
                           'email_adotante', 'endereco_adotante_id', 'cidade', 
                           'cep', 'bairro', 'rua', 'numero_casa', 'updated_at',
                           'created_up'];

    public function pedidoAdocao()
    {
        return $this->hasOne('\App\Models\PedidoAdocao', 'endereco_adotante_id');
    }


}

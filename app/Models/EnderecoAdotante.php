<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnderecoAdotante extends Model
{
    protected $table = 'endereco_adotante';
    protected $fillable = ['cidade', 'cep', 'bairro', 'rua', 'numero_casa', 'updated_at', 'created_at'];

    public function pedidoAdocao()
    {
        return $this->hasOne('\App\Models\PedidoAdocao', 'endereco_adotante_id');
    }

    public function dadosAdontante()
    {
        return $this->hasOne('\App\Models\DadosAdotante', 'endereco_adotante_id');
    }
    
}

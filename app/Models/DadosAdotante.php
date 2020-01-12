<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadosAdotante extends Model
{
    protected $table = 'dados_adotante';
    protected $fillable = ['nome_adotante', 'cpf_adotante', 'telefone_adotante',
                           'email_adotante', 'endereco_adotante_id', 'updated_at', 'created_up'];

    public function enderecoAdotante()
    {
       return $this->belongsTo('\App\Models\EnderecoAdotante', 'endereco_adotante_id');
    }


}

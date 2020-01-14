<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnderecoAdotante extends Model
{
    protected $table = 'endereco_adotante';
    protected $fillable = ['updated_at', 'created_at'];


    public function dadosAdontante()
    {
        return $this->hasOne('\App\Models\DadosAdotante', 'endereco_adotante_id');
    }
    
}

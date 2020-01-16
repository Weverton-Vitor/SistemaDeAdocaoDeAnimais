<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\PedidoAdocao;

class SiteController extends Controller
{
    private $total_page = 10;
    private $cvData;    

    function __construct()
    {        
        $this->cvData['cvRoute'] = 'Site';
        $this->cvData['cvViewDirectory'] = 'Site';
        $this->cvData['cvHeaderPage'] = "Adoção de animal";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
    }
    
    public function index()
    {
        return view('Site.index', $this->cvData);
    }

    public function adoteUmAnimal()
    {
        $this->cvData['animais'] = Animal::orderby('nome')->where('situacao_adocao', "N")->with('tipo')->paginate(6);                
        $this->cvData['cvHeaderPage'] = "Adote um animal";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        return view('Site.adoteUmAnimal', $this->cvData);
    }

    public function contato()
    {
        $this->cvData['cvHeaderPage'] = "Contatos";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        return view('Site.contato', $this->cvData);
    }

    public function sobre()
    {
        $this->cvData['cvHeaderPage'] = "Sobre";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        return view('Site.sobre', $this->cvData);
    }

   
}

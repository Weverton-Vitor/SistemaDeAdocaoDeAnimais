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


   
}

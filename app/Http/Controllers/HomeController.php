<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $cvData;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->cvData['cvHeaderPage'] = "Adoção de animal";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        return view('Site.index', $this->cvData);
    }
}

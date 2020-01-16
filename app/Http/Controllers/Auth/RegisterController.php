<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
USE App\Models\DadosAdotante;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        if(isset($data['adotante']))
        {//Adotante
            if(!is_null($data['cpf_adotante']) || !is_null($data['telefone_adotante']) || !is_null($data['cidade']) || !is_null($data['cep']) || !is_null($data['bairro']) || !is_null($data['rua']) || !is_null($data['numero_casa']))
            {//Segunda verificação de segurança
                return Validator::make($data, [
                    'name' => ['required', 'string', 'max:40'],
                    'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'cpf_adotante' => ['required', 'max:14'],
                    'telefone_adotante' => ['required', 'max:11'],            
                    'cidade' => ['required' ,'max:70'],
                    'cep' => ['required' ,'max:9'],
                    'bairro' => ['required', 'max:70'],
                    'rua' => ['required', 'max:70'],
                    'numero_casa' => ['required', 'max:3']
                ]);
            }

        } else { //Funcionário
            
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:40'],
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],                
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(isset($data['adotante']))
        {// Adotante
            $data['nome_adotante'] = $data['name'];
            $data['email_adotante'] = $data['email']; 
            $dadosAdotante = DadosAdotante::create($data);
            $data['dados_adotante_id'] = $dadosAdotante->id;            

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'dados_adotante_id' => $data['dados_adotante_id'],
                'password' => Hash::make($data['password']),
            ]);

        } else{// Funcionário            
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),                
            ]);
        }

    }
}

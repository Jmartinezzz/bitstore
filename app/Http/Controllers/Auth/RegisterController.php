<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{  

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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'clave' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }  

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['nombre'],
            'email' => $data['email'],
            'password' => Hash::make($data['clave']),
        ]);

        /*para el bot*/ 
        try {
            $botToken="1155339999:AAGBYb3Pu9dpScI5JxK-AyJLACOKmaZbD1c";
            $website="https://api.telegram.org/bot".$botToken;
            $fecha = date('d-m-Y h:i:s');

            $tex=urlencode("⚠Nuevo Usuario registrado: \n ✔️ Usuario: $user->name\n Fecha y hora: $fecha"); 
          
            file_get_contents($website."/sendmessage?chat_id=768944027&text=$tex");
        } catch (Exception $e) {
                
        }
        /*final del bot*/   
        return $user;
    }     
}

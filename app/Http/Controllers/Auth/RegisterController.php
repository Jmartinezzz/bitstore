<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Traits\Bot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use Bot;
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
    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->clave),
        ]);

        $botMsgContent = "⚠Nuevo Usuario registrado: \n ✔️ Usuario: $user->name\n Fecha y hora: " . date('d-m-Y h:i:s');
        $this->sendInteraction($botMsgContent);

        $this->guard()->login($user);

        return response()->json(['mensaje' => 'creado']);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubscribersRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\Bot;

class SubscribersController extends Controller
{
    use Bot;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscribersRequest $request)
    {
        if ($request->ajax()) {
            DB::insert('insert into subscriptions (email) values (?)', [$request->email]);

            return response()->json(['mensaje' => 'guardado']);
        }
    }

    public function contactus(Request $request)
    {
        $request->validate([
        'email' => 'required|email',
        'mensaje' => 'required|max:300',
        ]);
        if ($request->ajax()) {
            DB::insert('insert into contactus (name,phone,email,mensaje) values (?,?,?,?)', [$request->name,$request->phone,$request->email,$request->mensaje]);

            $botMsgContent = "⚠Nuevo Correo de contacto: \n Remitente: $request->name, ($request->email) \n Mensaje: $request->mensaje\n Fecha y hora: date('d-m-Y h:i:s')";
            $this->sendInteraction($botMsgContent);
        try {
            // envio de mensajes a cuenta de correo
            $to = "contacto@bitstoresv.com";
            $subject = "Mensaje desde sitio web";
            $message = $request->mensaje;
            $headers = "From: $request->email";
             
            mail($to, $subject, $message, $headers);
            // envio de mensajes a cuenta de correo
        } catch (Exception $e) {
                
        }
        /*final del bot*/   
            return response()->json(['mensaje' => 'guardado']);
        }
    }
}

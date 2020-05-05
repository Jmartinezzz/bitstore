<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubscribersRequest;
use Illuminate\Support\Facades\DB;

class SubscribersController extends Controller
{
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
            /*para el bot*/ 
        try {
            $botToken="1155339999:AAGBYb3Pu9dpScI5JxK-AyJLACOKmaZbD1c";
            $website="https://api.telegram.org/bot".$botToken;
            $fecha = date('d-m-Y h:i:s');

            $tex=urlencode("⚠Nuevo Correo de contacto: \n Remitente: $request->name, ($request->email) \n Mensaje: $request->mensaje\n Fecha y hora: $fecha");   
            file_get_contents($website."/sendmessage?chat_id=768944027&text=$tex");

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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

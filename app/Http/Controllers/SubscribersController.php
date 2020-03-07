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

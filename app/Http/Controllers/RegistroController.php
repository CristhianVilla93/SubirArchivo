<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Registro;
use Exception;

class RegistroController extends Controller
{
    public function Insertar(Request $request){
        // dd($request);
        try {
            DB::beginTransaction();
            $reg = new Registro;
            $reg ->nombre = $request->get('nombre');
            $reg ->apellido = $request->get('apellido');
            $reg ->descripcion = $request->get('descripcion');
            $reg ->city = $request->get('city');
           
            if($request->hasFile('avatar')){
                $archivo = $request->file('avatar');
                $archivo->move(public_path().'/Archivos/',$archivo->getClientOriginalName());
                $reg->documento=$archivo->getClientOriginalName();
            }
            $reg->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}

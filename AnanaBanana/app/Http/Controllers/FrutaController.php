<?php

namespace App\Http\Controllers;

use App\Models\Fruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Recogemos el ID del usuario autenticado
        $usuarioId = $request->user()->id;
        
        // Recogemos cuantos elementos por página quiere
        $perPage = $request->query('per_page', 10);
        // Recogemos el número de la página que verá
        $page = $request->query('page', 1);
        
        // Creamos un paginado con los elementos del usuario y con el paginado ya configurado
        $frutas = Fruta::where('proveedor_id', '=', $usuarioId)->paginate($perPage, "*", "", $page);
        
        // Si la lista tiene más de un elemento, guardamos "exito" en una variable
        // en caso contrario, guardamos "vacio" para poder controlar en la vista
        if (count($frutas) > 0) $mensaje = "exito";
        else $mensaje = "vacio";
        
        // Forma alternativa usando operador ternario
        // count($frutas) > 0 ? $mensaje = "exito" : $mensaje = "vacio";
        
        // Devolvemos la vista con la lista y el mensaje
        return view('listaFrutas', compact('mensaje', 'frutas'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Recogemos el ID del usuario autenticado
        $usuarioId = Auth::id();
        $fruta = Fruta::find($id);
        
        if ($fruta != null & $usuarioId != $fruta->proveedor_id) {
            return redirect()->route('fruta.index');
        }
        
        $mensaje = 'Se ha cargado la fruta';
        if ($fruta == null) {
            $mensaje = 'No existe la fruta';
        }
        
        return view('detallesFruta', compact('mensaje', 'fruta'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fruta $fruta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fruta $fruta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}

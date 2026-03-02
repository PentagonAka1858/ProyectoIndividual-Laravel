<?php

namespace App\Http\Controllers;

use App\Models\Fruta;
use App\Models\User;
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
        if ($request->user()->isAdmin()) {
            $frutas = Fruta::paginate($perPage)->withQueryString();
        } else {
            $frutas = Fruta::where('proveedor_id', '=', $usuarioId)->paginate($perPage)->withQueryString();
        }
            
        // Si la lista tiene más de un elemento, guardamos "exito" en una variable
        // en caso contrario, guardamos "vacio" para poder controlar en la vista
        if (count($frutas) > 0) $mensaje = "exito";
        else $mensaje = "vacio";
        
        // Forma alternativa usando operador ternario
        // count($frutas) > 0 ? $mensaje = "exito" : $mensaje = "vacio";
        
        // Devolvemos la vista con la lista y el mensaje
        return view('frutas.listaFrutas', compact('mensaje', 'frutas'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        // Recogemos el ID del usuario autenticado
        $usuarioId = Auth::id();
        $fruta = Fruta::find($id);
        
        if ($fruta != null && $usuarioId != $fruta->proveedor_id && !$request->user()->isAdmin()) {
            return redirect()->route('frutas.index');
        }
        
        $mensaje = 'Se ha cargado la fruta';
        if ($fruta == null) {
            $mensaje = 'No existe la fruta';
        }
        
        return view('frutas.detallesFruta', compact('mensaje', 'fruta'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = User::all();
        return view('frutas.formularioFruta', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'            => 'required|string|max:100',
            'fecha_recoleccion' => 'required|date',
            'fecha_caducidad'   => 'required|date|after:fecha_recoleccion',
            'conservacion'      => 'required|in:Frio,Ambiente',
            'origen'            => 'required|string',
            'kg_totales'        => 'required|numeric|min:0',
            'precio_kg'         => 'required|numeric|min:0',
            'proveedor_id'      => 'required|exists:users,id',
        ]);

        Fruta::create($validated);

        return redirect()->route('frutas.index')->with('success', 'Fruta creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $fruta = Fruta::findOrFail($id);
        $proveedores = User::all();

        if (!$request->user()->isAdmin() && $fruta->proveedor_id !== $request->user()->id) {
            return redirect()->route('frutas.index');
        }

        return view('frutas.editarFruta', compact('fruta' ,'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fruta = Fruta::findOrFail($id);

        if (!$request->user()->isAdmin() && $fruta->proveedor_id !== $request->user()->id) {
            return redirect()->route('frutas.index');
        }

        $validated = $request->validate([
            'nombre'            => 'required|string|max:100',
            'fecha_recoleccion' => 'required|date',
            'fecha_caducidad'   => 'required|date|after:fecha_recoleccion',
            'conservacion'      => 'required|in:Frio,Ambiente',
            'origen'            => 'required|string',
            'kg_totales'        => 'required|numeric|min:0',
            'precio_kg'         => 'required|numeric|min:0',
            'proveedor_id'      => 'required|exists:users,id',
        ]);

        $fruta->update($validated);

        return redirect()->route('frutas.index')->with('success', 'Fruta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $fruta = Fruta::findOrFail($id);

        if (!$request->user()->isAdmin() && $fruta->proveedor_id !== $request->user()->id) {
            return redirect()->route('frutas.index');
        }

        $fruta->delete();

        return redirect()->route('frutas.index')->with('success', 'Fruta eliminada correctamente.');
    }
}

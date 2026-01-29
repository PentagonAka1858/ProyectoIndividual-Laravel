<?php

namespace App\Http\Controllers;

use App\Models\Fruta;
use Illuminate\Http\Request;

class FrutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);
        $frutas = Fruta::paginate($perPage, "*", "", $page);
        
        if (count($frutas) > 0) $mensaje = "exito";
        else $mensaje = "vacio";
        
        // count($frutas) > 0 ? $mensaje = "exito" : $mensaje = "vacio";
        
        return view('listaFrutas', compact('mensaje', 'frutas'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
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

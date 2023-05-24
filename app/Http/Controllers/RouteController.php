<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //
    public function index()
    {
        $routes = Route::all();
        return view('admin.rutas.index', compact('routes'));
    }

    public function create()
    {
        return view('admin.rutas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'origen' => 'required',
            'destino' => 'required',
            'tiempo_estimado' => 'required|date_format:H:i',
        ]);

        $Route = new Route();
        $Route->nombre = $request->input('nombre');
        $Route->origen = $request->input('origen');
        $Route->destino = $request->input('destino');
        $Route->tiempo_estimado = $request->input('tiempo_estimado');
        $Route->save();

        return redirect()->route('rutas.index')->with('success', 'Ruta creado con éxito');
    }

    public function show($id)
    {
        $Route = Route::findOrFail($id);
        return view('Routes.show', compact('Route'));
    }

    public function edit($id)
    {
        $Route = Route::find($id);

        return view('admin.rutas.edit', compact('Route'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'origen' => 'required',
            'destino' => 'required',
            'tiempo_estimado' => 'required',
        ]);

        $Route = Route::find($id);
        $Route->nombre = $request->input('nombre');
        $Route->origen = $request->input('origen');
        $Route->destino = $request->input('destino');
        $Route->tiempo_estimado = $request->input('tiempo_estimado');
        $Route->save();
        return redirect()->route('rutas.index')->with('success', 'Ruta actualizada con éxito');
    }

    public function destroy($id)
    {
        $Route = Route::find($id);

        if ($Route) {
            $Route->delete();
            return redirect()->back()->with('success', '¡Rutas eliminado correctamente!');
        } else {
            return redirect()->back()->with('error', '¡No se pudo eliminar el conductor!');
        }
    }
}

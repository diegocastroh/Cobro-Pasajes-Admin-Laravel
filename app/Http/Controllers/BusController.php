<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Driver;
use App\Models\Insurance;
use App\Models\Route;
use Illuminate\Http\Request;

class BusController extends Controller
{
    //
    public function index()
    {
        $buses = Bus::all();
        $drivers = Driver::all();
        $insurances = Insurance::all();
        $routes = Route::all();
        return view('admin.buses.index', compact('buses', 'drivers', 'insurances', 'routes'));
    }

    public function create()
    {
        $conductores = Driver::all();
        $rutas = Route::all();
        return view('buses.buses.create', compact('conductores', 'rutas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required',
            'chofer_id' => 'required',
            'ruta_id' => 'required',
            'capacidad_pasajeros' => 'required',
            'modelo' => 'required',
            'marca' => 'required',
            'fecha_registro' => 'required|date',
            'fecha_vencimiento_revision_tecnica' => 'required|date',
        ]);

        $Bus = new Bus();
        $Bus->placa = $request->input('placa');
        $Bus->chofer_id = $request->input('chofer_id');
        $Bus->ruta_id = $request->input('ruta_id');
        $Bus->capacidad_pasajeros = $request->input('capacidad_pasajeros');
        $Bus->modelo = $request->input('modelo');
        $Bus->marca = $request->input('marca');
        $Bus->fecha_registro = $request->input('fecha_registro');
        $Bus->fecha_vencimiento_revision_tecnica = $request->input('fecha_vencimiento_revision_tecnica');
        $Bus->save();

        return redirect()->route('buses.index')->with('success', 'Bus creado con éxito');
    }

    public function show($id)
    {
        $bus = Bus::findOrFail($id);
        return view('buses.show', compact('bus'));
    }

    public function edit($id)
    {

        $Bus = Bus::find($id);
        $Driver = Driver::all();
        $Insurances = Insurance::all();
        $Routes = Route::all();
        return view('admin.buses.edit', ['bus'=>$Bus,'driver' => $Driver, 'insurance' => $Insurances, 'route'=>$Routes]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'placa' => 'required',
            'chofer_id' => 'required',
            'ruta_id' => 'required',
            'capacidad_pasajeros' => 'required',
            'modelo' => 'required',
            'marca' => 'required',
            'fecha_registro' => 'required|date',
            'fecha_vencimiento_revision_tecnica' => 'required|date',
        ]);

        $Bus = Bus::find($id);
        $Bus->placa = $request->input('placa');
        $Bus->chofer_id = $request->input('chofer_id');
        $Bus->ruta_id = $request->input('ruta_id');
        $Bus->capacidad_pasajeros = $request->input('capacidad_pasajeros');
        $Bus->modelo = $request->input('modelo');
        $Bus->marca = $request->input('marca');
        $Bus->fecha_registro = $request->input('fecha_registro');
        $Bus->fecha_vencimiento_revision_tecnica = $request->input('fecha_vencimiento_revision_tecnica');
        $Bus->save();
        return redirect()->route('buses.index')->with('success', 'Bus actualizado con éxito');;
    }

    public function destroy($id)
    {
        $Bus = Bus::find($id);

        if ($Bus) {
            $Bus->delete();
            return redirect()->back()->with('success', '¡Bus eliminado correctamente!');
        } else {
            return redirect()->back()->with('error', '¡No se pudo eliminar el conductor!');
        }
    }
}

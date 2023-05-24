<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Insurance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DriverController extends Controller
{
    //
    public function index()
    {
        $drivers = Driver::all();
        $insurances = Insurance::all();
        return view('admin.conductores.index', compact('drivers'), compact('insurances'));
    }

    public function create()
    {
        $insurances = Insurance::all();
        return view('admin.conductores.create', compact('insurances'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required',
            'dni' => 'required',
            'tipo_seguro_id' => 'required',
            'tipo_licencia' => 'required',
            'licencia_conducir' => 'required',
            'fecha_vencimiento_licencia' => 'required|date',
            'hora_ingreso' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i',
            'password' => 'required',
        ]);

        $drivers = new Driver();
        $drivers->nombre = $request->input('nombre');
        $drivers->dni = $request->input('dni');
        $drivers->password = Crypt::encrypt($request->input('password'));
        $drivers->tipo_seguro_id = $request->input('tipo_seguro_id');
        $drivers->tipo_licencia = $request->input('tipo_licencia');
        $drivers->licencia_conducir = $request->input('licencia_conducir');
        $drivers->fecha_vencimiento_licencia = $request->input('fecha_vencimiento_licencia');
        $drivers->hora_ingreso = $request->input('hora_ingreso');
        $drivers->hora_salida = $request->input('hora_salida');
        $drivers->save();

        return redirect()->route('conductores.index')->with('success', 'Conductor creado con éxito');
    }

    public function show($id)
    {
        $Driver = Driver::findOrFail($id);
        return view('Driveres.show', compact('Driver'));
    }

    public function edit($id)
    {
        $Driver = Driver::find($id);

        $insurances = Insurance::all();
        return view('admin.conductores.edit', ['driver' => $Driver, 'insurance' => $insurances]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'dni' => 'required',
            'tipo_seguro_id' => 'required',
            'tipo_licencia' => 'required',
            'licencia_conducir' => 'required',
            'fecha_vencimiento_licencia' => 'required|date',
            'hora_ingreso' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i',
            'password' => 'required',
        ]);

        $drivers = Driver::find($id);
        $drivers->nombre = $request->input('nombre');
        $drivers->dni = $request->input('dni');
        $drivers->password = Crypt::encrypt($request->input('password'));
        $drivers->tipo_seguro_id = $request->input('tipo_seguro_id');
        $drivers->tipo_licencia = $request->input('tipo_licencia');
        $drivers->licencia_conducir = $request->input('licencia_conducir');
        $drivers->fecha_vencimiento_licencia = $request->input('fecha_vencimiento_licencia');
        $drivers->hora_ingreso = $request->input('hora_ingreso');
        $drivers->hora_salida = $request->input('hora_salida');
        $drivers->save();
        return redirect()->route('conductores.index');

    }

    public function destroy($id)
    {
        /* $Driver = Driver::find($id);
        $Driver->delete();
        return redirect()->route('conductores.index'); */
        $driver = Driver::find($id);

        if ($driver) {
            $driver->delete();
            return redirect()->back()->with('success', '¡Conductor eliminado correctamente!');
        } else {
            return redirect()->back()->with('error', '¡No se pudo eliminar el conductor!');
        }
    }
}

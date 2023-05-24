<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    //
    public function index()
    {
        $insurances = Insurance::all();
        return view('admin.seguros.index', compact('insurances'));
    }

    public function create()
    {
        return view('admin.seguros.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required',
            'entidad' => 'required',
            'cobertura' => 'required',
            'exclusiones' => 'required',
            'costo' => 'required',
        ]);

        $insurances = new Insurance();
        $insurances->nombre = $request->input('nombre');
        $insurances->entidad = $request->input('entidad');
        $insurances->cobertura = $request->input('cobertura');
        $insurances->exclusiones = $request->input('exclusiones');
        $insurances->costo = $request->input('costo');
        $insurances->save();

        return redirect()->route('seguros.index')->with('success', 'Conductor creado con éxito');
    }

    public function show($id)
    {
        $Insurance = Insurance::findOrFail($id);
        return view('Insurances.show', compact('Insurance'));
    }

    public function edit($id)
    {
        $Insurance = Insurance::find($id);
        return view('admin.seguros.edit', compact('Insurance'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'entidad' => 'required',
            'cobertura' => 'required',
            'exclusiones' => 'required',
            'costo' => 'required',
        ]);

        $insurances = Insurance::find($id);
        $insurances->nombre = $request->input('nombre');
        $insurances->entidad = $request->input('entidad');
        $insurances->cobertura = $request->input('cobertura');
        $insurances->exclusiones = $request->input('exclusiones');
        $insurances->costo = $request->input('costo');
        $insurances->save();
        return redirect()->route('seguros.index')->with('success', 'Seguro modificado con éxito');
    }

    public function destroy($id)
    {
        $Insurance = Insurance::find($id);

        if ($Insurance) {
            $Insurance->delete();
            return redirect()->back()->with('success', 'Seguro eliminado correctamente!');
        } else {
            return redirect()->back()->with('error', '¡No se pudo eliminar el Seguro!');
        }
    }
}

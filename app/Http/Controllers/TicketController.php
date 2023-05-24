<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $routes = Route::all();
        $tickets = Ticket::all();
        return view('admin.boletos.index', compact('routes'), compact('tickets'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.boletos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'ruta_id' => 'required',
            'precio' => 'required',
            'tipo' => 'required',
        ]);

        $Ticket = new Ticket();
        $Ticket->ruta_id = $request->input('ruta_id');
        $Ticket->precio = $request->input('precio');
        $Ticket->tipo = $request->input('tipo');
        $Ticket->save();

        return redirect()->route('boletos.index')->with('success', 'Boletos creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //

        return view('admin.boletos.edit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //

        return view('admin.boletos.create');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'ruta_id' => 'required',
            'precio' => 'required',
            'tipo' => 'required',
        ]);

        $Ticket = Ticket::find($id);
        $Ticket->ruta_id = $request->input('ruta_id');
        $Ticket->precio = $request->input('precio');
        $Ticket->tipo = $request->input('tipo');
        $Ticket->save();
        return redirect()->route('boletos.index')->with('success','Boleto actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $Ticket = Ticket::find($id);

        if ($Ticket) {
            $Ticket->delete();
            return redirect()->back()->with('success', 'Boleto eliminado correctamente!');
        } else {
            return redirect()->back()->with('error', '¡No se pudo eliminar el Boleto!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function index(Request $request)
    {
        switch ($request->query('data')) {
            case 'verification':
                $data = $this->verification($request);
                break;
            case 'driver':
                $data = $this->getdriver($request);
                break;
            case 'bus':
                $data = $this->getbus($request);
                break;
            case 'tickets':
                $data = $this->gettickets($request);
                break;
            case 'route':
                $data = $this->getroute($request);
                break;
            case 'insurance':
                $data = $this->getinsurance($request);
                break;
            default:
                # code...
                break;
        }

        return response()->json($data);
    }

    public function verification(Request $request)
    {
        /* Obtengo los datos por el método GET */
        $dni = $request->query('dni');
        $placa = $request->query('placa');
        $password = $request->query('password');

        $acceso = ['acceso' => 'no_autorizado'];

        //Creo una consulta SQL para obtener y filtrar los datos de la tabla drivers
        $driver = DB::table('drivers')
            ->where('dni', $dni)
            ->first();

        //Creo una consulta SQL para obtener y filtrar los datos de la tabla buses
        $buses = DB::table('buses')
            ->join('drivers', 'buses.chofer_id', '=', 'drivers.id')
            ->join('routes', 'buses.ruta_id', '=', 'routes.id')
            ->join('insurances', 'drivers.tipo_seguro_id', '=', 'insurances.id')
            ->where('drivers.dni', $dni)
            ->where('buses.placa', $placa)
            ->select('buses.id as id', 'buses.chofer_id as driver_id', 'buses.ruta_id as route_id', 'drivers.tipo_seguro_id as insurance_id')
            ->first();

        if ($driver && Crypt::decrypt($driver->password) === $password && $buses) {
            //Unir los datos de ambas tablas en un solo objeto
            $acceso = ['acceso' => 'autorizado'];
            $data = (object) array_merge((array) $acceso, (array) $buses);
            return $data;
        }
        return $acceso;
    }
    public function getdriver(Request $request)
    {
        /* Obtengo los datos por el método GET */
        $id = $request->query('id');
        $bus = DB::table('drivers')
            ->where('id', $id)
            ->first();
        $data = (object) array_merge((array) $bus);
        return $data;
    }
    public function getbus(Request $request)
    {
        $id = $request->query('id');
        $bus = DB::table('buses')
            ->where('id', $id)
            ->first();
        $data = (object) array_merge((array) $bus);
        return $data;
    }
    public function gettickets(Request $request)
    {
        $id = $request->query('id');
        $tickets = DB::table('tickets')
            ->where('ruta_id', $id)
            ->get();
        return $tickets;
    }
    public function getroute(Request $request)
    {
        $id = $request->query('id');
        $bus = DB::table('routes')
            ->where('id', $id)
            ->first();
        $data = (object) array_merge((array) $bus);
        return $data;
    }
    public function getinsurance(Request $request)
    {
        $id = $request->query('id');
        $bus = DB::table('insurances')
            ->where('id', $id)
            ->first();
        $data = (object) array_merge((array) $bus);
        return $data;
    }
}

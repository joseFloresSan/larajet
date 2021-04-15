<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Empleado;
use App\Models\Historial;
use App\Models\Reportes;
use Illuminate\Support\Facades\DB;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $empleados = Empleado::all();
        $productos = Producto::all();
        $historial = DB::table('historial as h')
        ->join('producto as p','p.id_producto','=','h.id_producto')
        ->join('empleados as e','e.id_empleado','=','h.id_empleado')
        ->select('h.id_producto','p.nombre as producto','h.id_empleado','e.nombre as empleado','h.unidadesRetiradas','h.created_at','h.id_historial','h.created_at')
        ->get();

        return view('historial.retiro.index', compact('historial','empleados','productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $productos = Producto::all();
        $empleados = Empleado::all();
        return view('historial.retiro.create', compact('productos', 'empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $historial = new Historial();

        $historial->id_producto = $request->get('id_producto');
        $historial->id_empleado = $request->get('id_empleado');
        $historial->unidadesRetiradas = $request->get('unidadesRetiradas');
        $historial->save();

        $reporte = Reportes::where('id_producto','=',$historial->id_producto)->orderBy('created_at','desc')->first();

        $reporte->stockTeorico -= $historial->unidadesRetiradas;

        $reporte->update();
        return redirect('/historial');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleados = Empleado::all();
        $productos = Producto::all();
        $historial = Historial::find($id);

        return view('historial.retiro.edit', compact('empleados', 'historial', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $historial = Historial::find($id);

        
        $reporte = Reportes::where('id_producto','=',$historial->id_producto)->first();
        $reporte->stockTeorico = $reporte->updateStockTeoricRemoved($reporte->stockTeorico, $historial->unidadesRetiradas, $request->get('unidadesRetiradas'));
        $historial->id_producto = $request->get('id_producto');
        $historial->id_empleado = $request->get('id_empleado');
        $historial->unidadesRetiradas = $request->get('unidadesRetiradas');
        $historial->save();
        $reporte->update();
        return redirect('/historial');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $historial  = Historial::find($id);
        $historial->delete($id);

        return redirect('/historial');
    }
}

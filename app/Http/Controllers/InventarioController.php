<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Reportes;
use Illuminate\Support\Facades\DB;


class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportes = DB::table('reportes as r')
        ->join('producto as p', 'p.id_producto','=','r.id_producto')
        ->select('p.nombre','p.codigo','r.id_reportes', 'r.costoPorOrden', 'r.costoDeMantenimiento',
                 'r.unidadesAnuales', 'r.unidadesMensuales','r.stockTeorico',
                 'r.stockReal','r.precio','r.inventarioPromedio','r.costoConservacion',
                 'r.costoPedido','r.indiceExactitud')
        ->get();
        return view('inventario.index')->with('reportes', $reportes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos  = Producto::all();
        return view('inventario.create')->with('productos', $productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reporte = new Reportes();
        $reporte->id_producto = $request->get('id_producto');
        $reporte->costoPorOrden = $request->get('costopororden');
        $reporte->costoDeMantenimiento = $request->get('costodemantenimiento');
        $reporte->unidadesAnuales = $request->get('unidadesanuales');
        $reporte->unidadesMensuales = $request->get('unidadesmensuales');
        $reporte->stockTeorico = $request->get('stock');
        $reporte->stockReal = 0;
        $reporte->precio = $request->get('precio');
        $reporte->inventarioPromedio = $reporte->promedioInventario($reporte->unidadesAnuales, $reporte->unidadesMensuales);
        $reporte->costoConservacion = $reporte->calculateCostoConservacion($reporte->costoDeMantenimiento, $reporte->precio, $reporte->inventarioPromedio);
        $reporte->costoPedido = $reporte->calculateCostoPedido($reporte->costoPorOrden, $reporte->unidadesAnuales, $reporte->inventarioPromedio);
        $reporte->indiceExactitud = 0;

        $reporte->save();
        
        return redirect('/inventario');
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
        $producto  = Producto::find($id);
        return view('inventario.edit')->with('producto', $producto);
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
        $reporte_id = DB::table('producto as p')
        ->join('reportes as r', 'r.id_producto', '=', 'p.id_producto')
        ->select('p.id_producto', 'r.id_reportes')
        ->where('p.id_producto', '=', $id)
        ->first();

        $producto  = Producto::find($id);
        $producto->codigo = $request->get('codigo');
        $producto->nombre = $request->get('nombre');
        $producto->costoPorOrden = $request->get('costopororden');
        $producto->costoDeMantenimiento = $request->get('costodemantenimiento');
        $producto->unidadesAnuales = $request->get('unidadesanuales');
        $producto->unidadesMensuales = $request->get('unidadesmensuales');
        $producto->stockTeorico = $request->get('stock');
        $producto->precio = $request->get('precio');

        $producto->update();

        //$reportes = new Reportes();
        $reportes = Reportes::find($reporte_id->id_reportes);
        //$reportes = Reportes::where("id_producto","=",$producto->id_producto);
        $reportes->id_producto = $producto->id_producto;
        $reportes->inventarioPromedio = $reportes->promedioInventario($producto->unidadesAnuales, $producto->unidadesMensuales);
        $reportes->costoConservacion = $reportes->calculateCostoConservacion($producto->costoDeMantenimiento, $producto->precio, $reportes->inventarioPromedio);
        $reportes->costoPedido = $reportes->calculateCostoPedido($producto->costoPorOrden, $producto->unidadesAnuales, $reportes->inventarioPromedio);
        $reportes->indiceExactitud = 0;
        $reportes->update();

        return redirect('/inventario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto  = Producto::find($id);
        $producto->delete($id);


        return redirect('/inventario');
    }
}

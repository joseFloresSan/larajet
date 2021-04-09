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

    public function getStockAnualUnits(Request $request)
    {
        $datosProducto = DB::table('reportes as r')
                         ->join('producto as p','p.id_producto','=','r.id_producto')
                         ->select('r.stockTeorico','r.unidadesAnuales')
                         ->where('r.id_producto','=',$request->get('id'))
                         ->orderByDesc('r.created_at')
                         ->first();
        return response(json_encode($datosProducto),200)->header('content-type','text/plain');
        
    }

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
        $reporte->stockTeorico = $request->get('stock') + $reporte->unidadesMensuales;
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
        // $reporte  = Reportes::find($id);
        $productos = Producto::all();
        $reporte = DB::table('reportes as r')
        ->join('producto as p', 'p.id_producto','=','r.id_producto')
        ->select('p.nombre','p.codigo','r.id_reportes', 'r.costoPorOrden', 'r.costoDeMantenimiento',
                 'r.unidadesAnuales', 'r.unidadesMensuales','r.stockTeorico','r.precio', 'r.id_producto')
        ->where('id_reportes','=',$id)
        ->first();

        return view('inventario.edit', compact('productos', 'reporte'));
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
        $reporte = Reportes::findOrFail($id);
        $reporte->id_producto = $request->get('id_producto');
        $reporte->costoPorOrden = $request->get('costopororden');
        $reporte->costoDeMantenimiento = $request->get('costodemantenimiento');
        $reporte->unidadesAnuales = $request->get('unidadesanuales');
        $reporte->stockTeorico = $reporte->updateStockTeoric($reporte->stockTeorico, $reporte->unidadesMensuales,$request->get('unidadesmensuales'));
        $reporte->unidadesMensuales = $request->get('unidadesmensuales');
        $reporte->stockReal = 0;
        $reporte->precio = $request->get('precio');
        $reporte->inventarioPromedio = $reporte->promedioInventario($reporte->unidadesAnuales, $reporte->unidadesMensuales);
        $reporte->costoConservacion = $reporte->calculateCostoConservacion($reporte->costoDeMantenimiento, $reporte->precio, $reporte->inventarioPromedio);
        $reporte->costoPedido = $reporte->calculateCostoPedido($reporte->costoPorOrden, $reporte->unidadesAnuales, $reporte->inventarioPromedio);
        $reporte->indiceExactitud = 0;

        $reporte->update();

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
        $reportes  = Reportes::find($id);
        $reportes->delete($id);


        return redirect('/inventario');
    }
}

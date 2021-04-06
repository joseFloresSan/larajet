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
       
        $productos  = Producto::all();
        return view('inventario.index')->with('productos', $productos);

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
        $productos = new Producto();
        $productos->codigo = $request->get('codigo');
        $productos->nombre = $request->get('nombre');
        $productos->costoPorOrden = $request->get('costopororden');
        $productos->costoDeMantenimiento = $request->get('costodemantenimiento');
        $productos->unidadesAnuales = $request->get('unidadesanuales');
        $productos->unidadesMensuales = $request->get('unidadesmensuales');
        $productos->stockTeorico = $request->get('stock');
        $productos->stockReal = 0;
        $productos->precio = $request->get('precio');

        $productos->save();

        $reportes = new Reportes();
        $reportes->id_producto = $productos->id_producto;
        $reportes->inventarioPromedio = $reportes->promedioInventario($productos->unidadesAnuales, $productos->unidadesMensuales);
        $reportes->costoConservacion = $reportes->calculateCostoConservacion($productos->costoDeMantenimiento, $productos->precio, $reportes->inventarioPromedio);
        $reportes->costoPedido = $reportes->calculateCostoPedido($productos->costoPorOrden, $productos->unidadesAnuales, $reportes->inventarioPromedio);
        $reportes->indiceExactitud = 0;
        $reportes->save();
        
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

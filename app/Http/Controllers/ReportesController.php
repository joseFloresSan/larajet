<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Costodeconservacion;
use App\Models\Producto;
use App\Models\Reportes;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        return view('costodeconservacion.index', compact('productos'));
    }

    public function showCostoConservacion()
    {
        $costosConservacion = DB::table('producto as p')
            ->join('reportes as r', 'r.id_producto', '=', 'p.id_producto')
            ->select('p.id_producto', 'p.codigo', 'p.nombre', 'p.costoPorOrden', 
                     'p.costoDeMantenimiento', 'p.unidadesAnuales', 'p.unidadesMensuales', 
                     'p.precio', 'p.created_at', 'r.id_reportes', 'r.inventarioPromedio', 
                     'r.costoConservacion')
            ->get();

        return view('costodeconservacion.index', compact('costosConservacion'));
    }

    public function showCostoPedido()
    {
        $costosPedido = DB::table('producto as p')
            ->join('reportes as r', 'r.id_producto', '=', 'p.id_producto')
            ->select('p.id_producto', 'p.codigo', 'p.nombre', 'p.costoPorOrden', 
                     'p.costoDeMantenimiento', 'p.unidadesAnuales', 'p.unidadesMensuales', 
                    'p.precio', 'p.created_at', 'r.id_reportes', 'r.inventarioPromedio', 
                     'r.costoPedido')
            ->get();

        return view('costoPedido.index', compact('costosPedido'));
    }

    public function showIndiceExactitud()
    {
        $indiceExactitud = DB::table('producto as p')
            ->join('reportes as r', 'r.id_producto', '=', 'p.id_producto')
            ->select('p.id_producto', 'p.codigo', 'p.nombre', 'p.costoPorOrden', 
                     'p.costoDeMantenimiento', 'p.unidadesAnuales', 'p.unidadesMensuales', 
                     'p.stockTeorico', 'p.stockReal', 'p.precio', 'p.created_at', 'r.id_reportes', 'r.inventarioPromedio', 
                     'r.indiceExactitud')
            ->get();

        return view('indiceExactitud.index', compact('indiceExactitud'));
    }

    public function updateStockReal(Request $request, $id_reportes)
    {
        $reportes = Reportes::findOrFail($id_reportes);
        $producto = Producto::findOrFail($reportes->id_producto);
        
        $producto->stockReal = $request->get('stockReal'); 
        $reportes->indiceExactitud = $reportes->calculateIndiceExactitud($producto->stockReal, $producto->stockTeorico);;
        $reportes->update();
        
        $producto->update();
        

        return Redirect::to ('/reportes/indiceExactitud');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $costodeconservacion  = Reportes::find($id);
        $costodeconservacion->delete($id);


        return redirect('/costodeconservacions');
    }
}

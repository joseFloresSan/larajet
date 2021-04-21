<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Reportes;


class DashboardController extends Controller
{
    public function index(){

        $sumProductos = Producto::count();
        $sumEmpleados = Empleado::count();
        $countReportes = Reportes::count();
        
        
        $alerta = DB::table('reportes as r')
            ->join('producto as p', 'p.id_producto','=','r.id_producto')
		    ->select('p.nombre','r.stockTeorico')
		    ->where('stockTeorico','<',100)
            ->orderby('stockTeorico','asc')
        
		    ->get();    

        return view('dash.index', compact('sumProductos','sumEmpleados', 'countReportes','alerta'));
        
	    

            
      
    }


    public function getCostoConservacion(Request $request)
    {
        $ctmReporte = DB::table('reportes as r')
                         ->join('producto as p', 'p.id_producto','=','r.id_producto')
                         ->select('p.nombre','r.stockTeorico')  
                         ->get();                       
                         
        return response(json_encode($ctmReporte))->header('content-type','text/plain');
    }

}
 
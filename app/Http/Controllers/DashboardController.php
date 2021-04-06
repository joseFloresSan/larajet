<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Empleado;
use App\Models\Reportes;


class DashboardController extends Controller
{
    public function index(){

        $sumProductos = DB::table('producto')->sum("stockReal");
        $sumEmpleados = Empleado::count();
        $countReportes = Reportes::count();

        return view('dash.index', compact('sumProductos','sumEmpleados', 'countReportes'));

    }
}
 
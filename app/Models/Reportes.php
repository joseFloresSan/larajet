<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reportes extends Model
{
    use HasFactory;
    protected $table = "reportes";
    protected $primaryKey = "id_reportes";
    protected $fillable = [
        'id_producto',
        'inventarioPromedio',
        'costoConservacion',
        'costoPedido',
        'indiceExactitud',
    ];
    public function promedioInventario($unidadesAnuales, $unidadesMensuales)
    {
        return $promedio = ($unidadesAnuales / $unidadesMensuales) / 2;
    }
    public function calculateCostoPedido($costoFijo, $unidadesAnuales, $inventarioPromedio)
    {
      return $cto =  $costoFijo * ($unidadesAnuales/( 2 * $inventarioPromedio));
    }

    public function calculateCostoConservacion( $costoMantenimiento, $precio, $inventarioPromedio)
    {
        return $ctm = ($costoMantenimiento / 100 )* $precio * $inventarioPromedio;
    }

    public function calculateIndiceExactitud($stockReal, $stockTeorico){
        return $indiceExactitud = (($stockTeorico - $stockReal) / $stockReal) * 100; 
    }
}

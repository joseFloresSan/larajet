@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<!DOCTYPE html>
<html lang="en">
    <!-- Main content -->
        
        
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Graficas de PASTEL</title>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js"></script>
</head>
<body>
        <!-- cards de resumen -->
        <section class="content">      
        <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-sm-4" style="padding: 10px 10px;">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $sumProductos }}</h3>    <!--capturar productos existentes-->
                  <p>Productos</p>
                </div>
                <div class="icon">
                  <i class="fab fa-product-hunt"></i>
                </div>
                <a href="productos" class="small-box-footer">Ver m&aacute;s  <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-sm-4"style="padding: 10px 10px;" >
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $sumEmpleados }}</h3>
                  <p>Empleados</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
                <a href="empleados" class="small-box-footer">Ver m&aacute;s  <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-sm-4" style="padding: 10px 10px;">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $countReportes }}</h3>

                  <p>Reportes</p>
                </div>
                <div class="icon">
                <i class="fas fa-file-medical-alt"></i>
                </div>
                <a href="#" class="small-box-footer">Ver m&aacute;s <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>  
          </div>
        </section>
      
        <!-- canvas de graficos -->
        <section>
          <div class="row" >
            <div class="col-sm-4">
              <div style="padding: 10px 25px;">
                  <canvas id="costodeconservacion" style=" background: LightSeaGreen; border-radius:10px; " ></canvas>    
              </div>
              <script>
                  var costodeconservacion = document.getElementById("costodeconservacion");
                  var myPieChart = new Chart(costodeconservacion, {
                      type: 'doughnut',
                      data:  {
                              labels:['Primer Año', 'Segundo Año', 'Tercer Año'],
                              datasets: [{
                                  label: "Resultadossss",
                                  data:[450,250,300],
                                  backgroundColor:["#ff6384","#36a2eb","#ffcd56"]
                              }]
                      },
                      options: {
                        plugins: {
                            title: {
                              display: true,
                                text: 'Costo De Conservacion'
                                    }
                                }
                              }
                      });      
              </script>
            </div>
            <div class="col-sm-4">
              <div style="padding: 10px 25px;">
              <canvas id="costodepedido" style="background: burlywood; border-radius:10px;" ></canvas>
              <a href="#" class="btn btn-primary">Detalles</a>
              </div>
              <script>
                var costodepedido = document.getElementById("costodepedido");
                  
                var myPieChart = new Chart(costodepedido, {
                      type: 'pie',
                      data:  {
                              labels:['Primer Año', 'Segundo Año', 'Tercer Año'],
                              
                              datasets: [{
                                  label: "Resultadossss",
                                  data:[450,250,300],
                                  backgroundColor:["#ff6384","#36a2eb","#ffcd56"]
                              }]
                              
                      },
                      options: {
                        plugins: {
                            title: {
                              display: true,
                                text: 'Costo De Pedido'
                                    }
                                  }
              
                              }
                      
                      });    
              </script> 
            </div>

            <div class="col-sm-4">
              <div  style="padding: 10px 25px;">
              <canvas id="incidedeexactitud" style="background-color:aquamarine; border-radius:10px;" ></canvas>
              </div>
              <script> 
                var incidedeexactitud = document.getElementById("incidedeexactitud");
                var myPieChart = new Chart(incidedeexactitud, {
                  type: 'polarArea',
                  data:  {
                          labels:['Primer Año', 'Segundo Año', 'Tercer Año'],
                          
                          datasets: [{
                              label: "Resultadossss",
                              data:[450,250,300],
                              backgroundColor:["#ff6384","#36a2eb","#ffcd56"]
                          }]
                  },
                  options: {
                    plugins: {
                        title: {
                          display: true,
                            text: 'Indice de Exactitud'
                              }
                            }
                          }
                  });    

                  
              </script> 
            </div>
          </div>
          
    
           
        
          
        </section>
         
    </body>
</html>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
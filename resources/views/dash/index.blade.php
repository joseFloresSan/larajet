@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<!DOCTYPE html>
<html lang="en">
    <!-- Main content -->
    <section class="content">      
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>    <!--capturar productos existentes-->
                <p>Productos</p>
              </div>
              <div class="icon">
                <i class="fab fa-product-hunt"></i>
              </div>
              <a href="productos" class="small-box-footer">Ver Productos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Empleados</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="empleados" class="small-box-footer">Ver Empleados <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>Reportes</p>
              </div>
              <div class="icon">
              <i class="fas fa-file-medical-alt"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Ultima Conexion</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        </section>
        
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Graficas de PASTEL</title>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js"></script>
</head>
<body>

    <div width='50px'>
        <canvas id="costodeconservacion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 50%; background: LightSeaGreen; border-radius:10px; " ></canvas>
        
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
    
      <div width='50px'>
      <canvas id="costodepedido" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 50%;; background: burlywood; border-radius:10px;" ></canvas>
       
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
        
      <div width='50px'>
        <canvas id="incidedeexactitud" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 50%;; background: white; border-radius:10px;" ></canvas>
       
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
    
    </body>

    <script>
    
    

        

</body>
</html>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
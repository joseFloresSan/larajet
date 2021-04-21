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

<body >
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
        <!-- Alerta de Stock -->
        <div class="row" >
          <div class="col-lg-5">
            <div class="card">
                <div class="card-header"  style="background: #e02b2b !important; color: white !important">
                  ALERTA DE STOCK
                    </div>
                      <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                          <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Producto</th>
                                <th scope="col" class="text-center">Stock</th>                    
                           
                            </tr>
                          </thead>
                          
                            @foreach($alerta as $DataAlertas)
                              <tr>                            
                                <td>{{$DataAlertas->nombre}} </td>
                                <td>{{$DataAlertas->stockTeorico}} </td>
                            
                              </tr> 
                            @endforeach
                           

                        </table>
                      </div>
                    </div>
                </div>
            </div>
          </div>          
        </div> 
        <!-- canvas de graficos -->

          <div class="row" >
            <div class="col-sm-4">
              <div  style="padding: 10px 25px;">
              <canvas id="myChart" style="background-color:aquamarine; border-radius:10px;" ></canvas>
              </div>
              <script> 
              var producto  = [];
              var valores   = [];
              $(document).ready(function(){ 
              
	                $.ajax({
	                  url:'/dash/getCostoConservacion',
	                  method:'POST',
                    data:{
                      id:1,
                      _token:$('input[name="_token"]').val()

                    }
                  }).done function(res){
                    
                    var ctmReporte = JSON.parse(res);

                    for (var i=0; i<ctmReporte.length;i++){

                      producto.push(ctmReporte[i].nombre);
                      valores.push(ctmReporte[i].stockTeorico);

                    }
                    GenerarGrafica();
                  });

                  function GenerarGrafica(){
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: producto,
                            datasets: [{
                                label: '# of Votes',
                                data:  valores,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                  }  
		
              </script> 
            </div>
            
            <div class="col-sm-4">
              <div style="padding: 10px 25px;">
              <canvas id="costodepedido" style="background: burlywood; border-radius:10px;" ></canvas>
              
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
              <canvas id="incidedeexactitudd" style="background-color:aquamarine; border-radius:10px;" ></canvas>
              </div>
              <script> 
                var incidedeexactitudd = document.getElementById("incidedeexactitudd");
                var myPieChart = new Chart(incidedeexactitudd, {
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
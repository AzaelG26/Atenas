@extends('layout.sidebar')    
@section('title', 'Añadir datos personales')
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> <!-- Instalacion de ApexCharts para las gráficas -->

@push('styles')
    <style>
        body{
            background-color:#0C1011;
        }
        
        .title-ingresos{
                border-bottom: 1px solid #ce9d22;
        }
        .subtitle-ingresos{
            color: white;
        }
        .subtitle-ingresos:hover{
            color: #ce9d22;
            filter: drop-shadow(0px 0px 5px #ce9d22);
        }

    /* Estilos de las pestañas y contenedor */
    
        .btn-sections{
            transition: all 0.1s ease;
            color: white;
            background-color: #131718;
            
        }
        .btn-sections:hover{
            color:#be952c;
            background-color: #212529;
            border:1px solid #212529 !important;

        }
        .nav-link.active{
            background-color: #212529 !important;
            color: #be952c !important;
            border:1px solid #212529 !important;

        }
       
        /* Tabla  */
        .table .head{
            color: white;
            /* border: 1px solid rgb(41, 40, 40); */
            background-color: rgb(22, 22, 22);
        }
        .table tbody tr td:hover{
            background-color: #131718;
        }

        .filter-button{
            display: flex; 
            flex-direction:column; 
        }



        /* cards */
        .card-total, #filtrar{
            box-shadow: 0px 3px 3px rgb(0, 0, 0);
            transition: all 0.4s ease;
        }
        .card-total:hover, #filtrar:hover{
            box-shadow: 0px 1px 13px rgb(0, 0, 0);
            transform: scale(1.04);
            /* transform: translateY(2px;) */
        }


        /* Gráficas */
        #graficaOne { 
            transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out; 
            opacity: 1; visibility: visible; 
        } 
        #graficaOne.hidden { 
            opacity: 0; 
            visibility: hidden;
        }
        

        
    </style>
@endpush
@section('content')
    
    <div class="py-4" style="width: 100vw; display:flex; flex-direction:column; align-items:center;">
        <div class="pb-3 mb-4 title-ingresos" style="display: flex; justify-content:space-between; width:90vw">
            <span class="fs-4 subtitle-ingresos">&nbsp; &nbsp;Ingresos financieros</span>             
        </div>
            
        <div class="filter-container " style="width: 90vw; display: flex; justify-content:space-between;">
            <section style="display: flex;">
                <div>
                    <label for="mes" style="color: white;">Selecciona mes:</label> <br>
                    <select id="mes" name="mes" class="form-select" style="width: auto;">
                        <option value="" selected disabled></option>
                        <option value="">ninguno</option>
                        <option value="01" {{request('mes') == '01' ? 'selected' : ''}}>Enero</option>
                        <option value="02" {{request('mes') == '02' ? 'selected' : ''}}>Febrero</option>
                        <option value="03" {{request('mes') == '03' ? 'selected' : ''}}>Marzo</option>
                        <option value="04" {{request('mes') == '04' ? 'selected' : ''}}>Abril</option>
                        <option value="05" {{request('mes') == '05' ? 'selected' : ''}}>Mayo</option>
                        <option value="06" {{request('mes') == '06' ? 'selected' : ''}}>Junio</option>
                        <option value="07" {{request('mes') == '07' ? 'selected' : ''}}>Julio</option>
                        <option value="08" {{request('mes') == '08' ? 'selected' : ''}}>Agosto</option>
                        <option value="09" {{request('mes') == '09' ? 'selected' : ''}}>Septiembre</option>
                        <option value="10" {{request('mes') == '10' ? 'selected' : ''}}>Octubre</option>
                        <option value="11" {{request('mes') == '11' ? 'selected' : ''}}>Noviembre</option>
                        <option value="12" {{request('mes') == '12' ? 'selected' : ''}}>Diciembre</option>
                    </select>
                </div> 
                &nbsp;
                &nbsp;
                &nbsp;
                <div>
                    <label for="anio" style="color: white;">Selecciona año</label>
                    <select id="anio" name="anio" class="form-select" style="width: auto;"> 
                        <option value="" selected disabled></option>
                        <option value="">ninguno</option>
                        @foreach ($anios as $year)
                            <option value="{{$year}}" {{ $year == request('anio') ? 'selected' : '' }}>{{$year}}</option>
                        @endforeach
                    </select>
                </div>
            </section>
            <section class="filter-button">
                <br>
                
                <button class="btn btn-outline-warning" id="filtrar" onclick="filtrarPorMes()"><i class="bi bi-funnel"></i> Buscar</button>
            </section>   
        </div>
        <br>

        <div class="card text-center" style="width: 95vw; border:none">                    
            <div class="card-header" style="background-color: #131718;">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist" style="display:flex; justify-content:space-between">
                    <section style="display: flex">
                        <li>
                            <a class="nav-link active order btn-sections"  id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="ocultarSeleccionPlatillo()">En físico</a>
                        </li>
                        <li>
                            <a class="nav-link btn-sections" id="menu-tab" data-bs-toggle="tab" href="#menu" role="tab" aria-controls="menu" aria-selected="false" onclick="ocultarSeleccionPlatillo()">En línea</a>
                        </li>     
                    </section>
                </ul>
            </div>
            <div class="card-body" style="background-color: #212529;">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div style="display: flex; justify-content:space-between; width:100%;">
                            <section class="filter-button">
                                <br>
                                <button class="btn btn-warning" id="grafica-fisico" onclick="mostrarGraficaFisico()">Ver gráfica</button>
                            </section>

                            <div class="card mb-3 card-total" style="width: 15rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Total</h5>
                                    <p class="card-text">${{$totalFisico}}.</p>
                                </div>
                            </div>
                        </div>


                        <div class="card text-center" id="graficaOne" style="background-color: #131718; width:100%">
                            <div class="card-header" style="color:white" >
                                Ingresos
                            </div>

                            <div class="card-body">
                                <div id="grafica"></div>
                            </div>

                        </div>  


                        <table class="table table-bordered border-dark">
                            <thead style="border: 1px solid gray;">
                                <tr>
                                    <th class="head">Nombre de comensal</th>
                                    <th class="head">Platillos</th>
                                    <th class="head">Cantidad</th>
                                    {{-- <th class="head">Precio total</th> --}}
                                    <th class="head">Última modificación</th>
                                </tr>
                            </thead>
                            <tbody class="table-dark">
                                @foreach($ventas as $ventas)
                                    @foreach ($ventas->orderDetail as $item)                                        
                                    <tr>
                                        <td>{{ $ventas->diner_name }}</td>
                                        <td>{{ $item->menu->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        {{-- <td>{{ $ventas->total_price }}</td> --}}
                                        <td>{{ $ventas->updated_at }}</td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>                                                  
                    </div>
                    
                    <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab" style="display: flex; flex-wrap:wrap; justify-content:center">
                        <div style="display: flex; justify-content:space-between; width:100%;">

                            <section class="filter-button">
                                <br>
                                <button class="btn btn-warning" id="grafica-fisico" onclick="mostrarGraficaOnline()">Ver gráfica</button>
                            </section>

                            <div class="card mb-3 card-total" style="width: 15rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Total</h5>
                                    <p class="card-text">${{$totalOnline}}.</p>
                                </div>
                            </div>
                        </div>                        
                        
                        <div class="card text-center" id="graficaTwo" style="background-color: #131718; width:100%">
                            <div class="card-header" style="color:white" >
                                Ingresos en línea
                            </div>

                            <div class="card-body">
                                <div id="graficaOnline"></div>
                            </div>
                            
                        </div>

                        <table class="table table-bordered border-dark">
                            <thead style="border: 1px solid gray;">
                                <tr>
                                    <th class="head">Nombre de orden</th>
                                    <th class="head">Platillos</th>
                                    <th class="head">Cantidad</th>
                                    {{-- <th class="head">Precio total</th> --}}
                                    <th class="head">Última modificación</th>
                                </tr>
                            </thead>
                            <tbody class="table-dark">
                                @foreach($ventasOnline as $online)
                                    @foreach ($online->OnlineOrderDetails as $item)                                        
                                    <tr>
                                        <td>{{ $online->order_name }}</td>
                                        <td>{{ $item->menu->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        {{-- <td>{{ $online->total_price }}</td> --}}
                                        <td>{{ $online->updated_at }}</td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>  
                        
                    </div>
                </div>
            </div>
        </div> 

    </div>   
   

    <script>
        let contenedorGraficaFisico = document.getElementById('graficaOne');
        contenedorGraficaFisico.style.display = 'none'

        function mostrarGraficaFisico(){
            if(contenedorGraficaFisico.style.display === 'none'){
                contenedorGraficaFisico.style.display = 'block'
            }
            else if(contenedorGraficaFisico.style.display === 'block'){
                contenedorGraficaFisico.style.display = 'none'
            }
            

            let FisicoDatosGrafica = @json($FisicoDatosGrafica);
            // console.log(FisicoDatosGrafica);

            var options = {                
                series: [{
                    name: 'Ventas',
                    data: FisicoDatosGrafica.seriesFisico
                }],            
                
                chart: {
                    height: 300,
                    type: 'bar',
                    events: {
                        click: function(chart, w, e){
                            // console.log(chart, w, e)
                        }
                    },
                },
                colors: ['#40E0D0', '#FF6178', '#FEBC3B', '#6D848E', '#266BA3','#D830EB','#26E7A6'],
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true
                    }
                },
                dataLabels: {
                    enabled: true
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: FisicoDatosGrafica.categoriesFisico, // Usamos las categorías de ventas
                    labels: {
                        style: {
                            fontSize: '12px',
                            colors: '#808080'
                        }
                    },
                    title: {
                        text: 'Periodo',
                        style: {
                            fontSize: '14px',
                            fontWeight: 'bold'
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Cantidad de ganancias'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Pesos";
                        }
                    }
                }
            };


            var show = new ApexCharts(document.getElementById('grafica'), options);
            show.render();
        };



        let contenedorGraficaOnline = document.getElementById('graficaTwo');
        contenedorGraficaOnline.style.display = 'none'

        function mostrarGraficaOnline(){
            if(contenedorGraficaOnline.style.display === 'none'){
                contenedorGraficaOnline.style.display = 'block'
            }
            else if (contenedorGraficaOnline.style.display = 'block'){
                contenedorGraficaOnline.style.display = 'none'
            }


            let datosGrafica = @json($datosGrafica);
            // console.log(datosGrafica.categories); 
            
            var options = {                
                series: [{
                    name: 'Ventas en línea',
                    data: datosGrafica.seriesOnline
                }],            
                
                chart: {
                    height: 300,
                    type: 'bar',
                    events: {
                        click: function(chart, w, e){
                            // console.log(chart, w, e)
                        }
                    },
                },
                colors: ['#40E0D0', '#FF6178', '#FEBC3B', '#6D848E', '#266BA3','#D830EB','#26E7A6'],
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true
                    }
                },
                dataLabels: {
                    enabled: true
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: datosGrafica.categories, // Usamos las categorías de ventas
                    labels: {
                        style: {
                            fontSize: '12px',
                            colors: '#808080'
                        }
                    },
                    title: {
                        text: 'Periodo',
                        style: {
                            fontSize: '14px',
                            fontWeight: 'bold'
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Cantidad de ganancias'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Pesos";
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.getElementById('graficaOnline'), options);
            chart.render();


        }




        function filtrarPorMes(){
            let mesSeleccionado = document.getElementById('mes').value;
            let yearSeleccionado = document.getElementById('anio').value;
            window.location.href=`?mes=${mesSeleccionado}&anio=${yearSeleccionado}`
        }


        let menuElement = document.getElementById('menu');
        let btnEnviar = document.getElementById('btn-enviar')

        menu.style.display = 'none'
        btnEnviar.style.display = 'none'
        function ocultarSeleccionPlatillo() {
            if (menuElement.style.display === 'none') {
                menuElement.style.display = 'flex';
                btnEnviar.style.display = 'block'

            } else if(menuElement.style.display === 'flex') {
                menuElement.style.display = 'none';
                btnEnviar.style.display = 'none'

            }
        }

        
        
        

        

    </script>
@endsection
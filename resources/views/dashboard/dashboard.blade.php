@extends('master') 

@section('content')
<div class="container">
    <div class="row-sm-12">
        <div class="card ">
            <div class="card-status bg-purple"></div>



            <div class="card-body">
                <div class="text-center">
                    Kegiatan yang Sedang Berlangsung
                </div>
                <hr class="mb-4 mt-2">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kegiatan</th>
                                <th>Seksi</th>
                                <th>Pelatihan</th>
                                <th>Pelaksanaan</th>
                                <th>Jumlah Mitra</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row-sm-12 mb-5 mt-5">
        <div class="text-center">
        <h2>{{$kegiatan->nama_kegiatan}}</h2>
        </div>
    </div>
    <div class="row-sm-12">
        <div class="col-sm-6">
            <div class="card">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
</div>
<!--canvas id="myChart"></!--canvas>-->
@endsection @section('script')
<script src="{{ asset('assets/leafletJS/leaflet.js') }}"></script> 
  
<script>
     var kecamatan_bar=@json($kecamatan_bar,JSON_PRETTY_PRINT);
     var count_bar=@json($count_bar,JSON_PRETTY_PRINT);

     
     var col=['#f6e58d','#ffbe76','#ff7979','#686de0','#badc58']
     var max_count=Math.max.apply(Math, count_bar);
    var ctx = document.getElementById('barChart').getContext('2d');
    var bar_chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'horizontalBar',

       
        // The data for our dataset
        data: {
            labels: kecamatan_bar,
            datasets: [{
                label: 'Jumlah Mitra',
                backgroundColor: col,
                borderColor: col,
                data: count_bar
            }]
        },


        // Configuration options go here
        options: {

            scales: {
                xAxes: [{
                    ticks: {
                        max: max_count + 0.5,
                        min: 0,
                        stepSize: 1
                    }
                }]
            }
        }
    });


    var canvas = document.getElementById('barChart');
canvas.onclick = function (evt) {
    var activePoints = bar_chart.getElementsAtEvent(evt);
    var cdata = activePoints[0]['_chart'].config.data;
    var idx = activePoints[0]['_index'];
    var label = cdata.datasets[idx].label;
    var value = cdata.datasets[0].data[idx];

    console.log(label);
}
</script>
@endsection
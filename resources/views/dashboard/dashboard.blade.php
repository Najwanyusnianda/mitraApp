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
    <div class="row row-cards">
        <div class="col-sm-6 col-lg-6">
            <div class="card p-3">
              <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-blue mr-3">
                  <i class="fe fe-user"></i>
                </span>
                <div>
                  <h4 class="m-0"><a href="{{route('get_mitra',['kegiatan_id'=>$kegiatan->id])}}" id="mitra_count">{{ $mitra_count ? $mitra_count : '0' }} <small>Orang Mitra</small></a></h4>
                  <small class="text-muted">Jumlah Mitra</small>
                </div>
              </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6">
            <div class="card p-3">
              <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-green mr-3">
                    <i class="fe fe-book-open" ></i>
                </span>
                <div>
                  <h4 class="m-0"><a href="{{route('get_mitra_nilai',['kegiatan_id'=>$kegiatan->id])}}" id="mitra_nilai">{{ $mitra_count_nilai ? $mitra_count_nilai : '0' }} <small> Mitra yang dinilai</small></a></h4>
                  <small class="text-muted">Jumlah Mitra yang Dinilai</small>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Rata Rata Kinerja Mitra Mitra Per Kecamatan
                </div>
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="col-sm-6 ">
            <div class="card">
                <div class="card-header">
                    Jumlah Mitra Per Kecamatan
                </div>
                <canvas id="barChartM"></canvas>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="detailMitra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>-->
        </div>
        <div class="modal-body" id="detailBody">
            
        </div>

      </div>
    </div>
  </div>
<!--canvas id="myChart"></!--canvas>-->
@endsection @section('script')
<script src="{{ asset('assets/leafletJS/leaflet.js') }}"></script> 
  
<script>
     var kecamatan_bar = @json($kecamatan_bar, JSON_PRETTY_PRINT);
     var count_bar = @json($count_bar, JSON_PRETTY_PRINT);


     var col = ['#f6e58d', '#ffbe76', '#ff7979', '#686de0', '#badc58']
     var max_count = Math.max.apply(Math, count_bar);
     var ctx = document.getElementById('barChart').getContext('2d');
     var bar_chart = new Chart(ctx, {
         // The type of chart we want to create
         type: 'horizontalBar',


         // The data for our dataset
         data: {
             labels: kecamatan_bar,
             datasets: [{
                 label: 'Rata - Rata Nilai ',
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
                         max: 5,
                         min: 0,
                         stepSize: 0.5
                     }
                 }]
             }
         }
     });


     var canvas = document.getElementById('barChart');
     canvas.onclick = function (evt, element) {
         console.log(element);
     }
</script>

<script>
    var kecamatanx_bar = @json($kecamatanx_bar, JSON_PRETTY_PRINT);
    var countx_bar = @json($countx_bar, JSON_PRETTY_PRINT);

    console.log(countx_bar);
    var colz = ['#fab1a0', '#81ecec', '#74b9ff', '#0984e3', '#ffeaa7']
    var max_count = Math.max.apply(Math, countx_bar);
    var ctx = document.getElementById('barChartM').getContext('2d');
    var bar_chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',


        // The data for our dataset
        data: {
            labels: kecamatanx_bar,
            datasets: [{
                label: 'Jumlah Mitra ',
                backgroundColor: colz,
                borderColor: colz,
                data: countx_bar
            }]
        },


        // Configuration options go here
        options: {

            scales: {
                xAxes: [{
                    ticks: {
                        max: max_count+0.5,
                        min: 0,
                        stepSize: 5
                    }
                }]
            }
        }
    });


    var canvas = document.getElementById('barChart');
    canvas.onclick = function (evt, element) {
        console.log(element);
    }
</script>

<script>
    $(document).ready(function(){
        
        $('#mitra_count').click(function(e){
            e.preventDefault();
            var url= $(this).attr('href');
            //var url="{{url('/get_mitra/').$kegiatan->id}}";
            $.ajax({

                url: url,
                dataType: 'html',
                global: false,
                success: function (response) {
                    //console.log("Data: " + response);

                    $('#detailBody').html(response);
                    
                    handleFileInput();
                },
                error: function (e) {

                }
            });
            $('#detailMitra').modal('show');  

        })
       
    })
</script>


<script>
    $(document).ready(function(){
        
        $('#mitra_nilai').click(function(e){
            e.preventDefault();
            var url= $(this).attr('href');
            //var url="{{url('/get_mitra/').$kegiatan->id}}";
            $.ajax({

                url: url,
                dataType: 'html',
                global: false,
                success: function (response) {
                    //console.log("Data: " + response);

                    $('#detailBody').html(response);
                    
                    handleFileInput();
                },
                error: function (e) {

                }
            });
            $('#detailMitra').modal('show');  

        })
       
    })
</script>
@endsection
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
                <div class="card-header">
                    Jumlah Mitra Per Kecamatan
                </div>
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="col-sm-6 affix">
            <div class="card ">
                <div class="card-body mt-5">
                    @if ($mitras->isEmpty())
                    <div class="alert alert-primary mt-5 mb-6">
                      <div>Tidak ada mitra yang tersedia pada kegiatan ini</div>
                    </div>
                    @else
                    <table class="table table-condensed">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama</th>
                              <th>NIK</th>
                              <th>Kecamatan</th>
    
                              <th></th>
            
            
                          </tr>
                      </thead>
                      <tbody>
                          <?php $no=0; ?>
                          @foreach ($mitras as $mitra)
                          <?php $no++; ?>
                          <tr>
                          <th scope="row">{{$no}}</th>
                              <td><strong>{{$mitra->name}}</strong></td>
                              <td>{{$mitra->nik ?? 'tidak ada'}}</td>
                              <td>{{$mitra->kecamatan}}</td>
        
                              <td class="text-right">
                         
                                @if (empty($mitra->avg_evaluasi))
                                <button class="btn btn-secondary btn-sm" disabled="disabled">
                                  @if (empty($mitra->avg_pelatihan))
                                    Belum dinilai
                                  @else
                                    @if (empty($mitra->avg_pelaksanaan))
                                      Pelatihan:  {{$mitra->avg_pelatihan}}
                                    @else
                                      Pelaksanaan Lapangan: {{$mitra->avg_pelaksanaan}}
                                    @endif
                                  @endif
                                  
                                  </button>
                                @else
                                    <button disabled="disabled" class="btn btn-success btn-sm"><strong class="h5"> Nilai Rata - Rata :{{ $mitra->total_nilai }}</strong></button>
                                @endif
          
              
                              </td>
    
                            
                          </tr> 
                          @endforeach
              
                          
                      </tbody>
                    
                    </table>
                    <!--{{$mitras->links()}}-->
                    @endif
            
                </div>
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
canvas.onclick = function (evt,element) {
    console.log(element);
}
</script>
@endsection
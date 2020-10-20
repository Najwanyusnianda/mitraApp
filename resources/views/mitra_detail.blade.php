<div class="card-body">
   
    @if ($mitras->isEmpty())
    <div class="alert alert-primary mt-5 mb-6">
      <div>Tidak ada mitra yang tersedia pada kegiatan ini</div>
    </div>
    @else
    <table class="table card-table table-vcenter text-nowrap table-hover" style="vertical-align: middle;">
      <thead>
          <tr style="">
              <th scope="col">#</th>
              <th scope="col">Nama</th>
             
              <th scope="col">No. HP</th>
              <th scope="col">Kecamatan</th>



          </tr>
      </thead>
      <tbody>
          <?php $no=0; ?>
          @foreach ($mitras as $key=>$mitra)
          <?php $no++; ?>
          <tr>
          <th scope="row">{{$no}}</th>
              <td>
                <strong></strong>
                <div>{{$mitra->name}}</div>
                <div class="small text-muted">
                  {{$mitra->nik}}
                </div>
              </td>
           
              <td>{{$mitra->phone}}</td>
              <td>
                @if ($mitra->kecamatan=='010')
                    Simpang Kiri
                @else
                    @if ($mitra->kecamatan=='020')
                        Penanggalan
                    @else
                        @if ($mitra->kecamatan=='030')
                           Rundeng 
                        @else
                            @if ($mitra->kecamatan=='040')
                                Sultan Daulat
                            @else
                                @if ($mitra->kecamatan=='050')
                                    Longkib
                                @else
                                    {{ $mitra->kecamatan }}
                                @endif
                            @endif
                        @endif
                    @endif
                @endif
               <!-- <strong>{{$mitra->kecamatan}}</strong>--> 
              </td>

          </tr> 
          @endforeach

          
      </tbody>
    
    </table>
  <!--{{$mitras->links()}}-->
    @endif

  </div>
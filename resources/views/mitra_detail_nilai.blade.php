@if ($mitras->isEmpty())
<div class="alert alert-primary mt-5 mb-6">
  <div>Tidak ada mitra yang tersedia pada kegiatan ini</div>
</div>
@else
<table class="table card-table table-vcenter text-nowrap table-hove">
  <thead>
      <tr>
          <th>#</th>
          <th>Nama</th>
         
          <th>Kecamatan</th>

          <th>Kinerja</th>


      </tr>
  </thead>
  <tbody>
      <?php $no=0; ?>
      @foreach ($mitras as $mitra)
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
          </td>

          <td class="text-center">
     
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
                @if ($mitra->total_nilai > 4)
                    <span class="tag tag-green"> Baik</span>
                @else    
                <span class="tag tag-lime"> Sangat Baik</span>
                @endif
              
            @endif


          </td>

        
      </tr> 
      @endforeach

      
  </tbody>

</table>

@endif
